<?php

namespace App\Repositories;

use App\Models\Book;
use App\Models\BookAuthor;
use App\Models\Transactions;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class BookRepository implements IBookRepository
{
    /**
     * @throws Exception
     */
    public function AddBook($fields) {
        try {
            DB::beginTransaction();

            $book = Book::create($fields);

            $book->Authors()->attach($fields['authors']);

            DB::commit();
        } catch (Exception $exception) {
            DB::rollBack();

            Log::error('Add book error: ' . $exception->getMessage());
            return false;
        }
        return true;
    }

    public function UpdateBook($fields)
    {
        try {
            DB::beginTransaction();

            $book = Book::find($fields['bookId']);
            $book->fill($fields);
            $book->update();

            $book->Authors()->sync($fields['authors']);

            DB::commit();
        } catch (Exception $exception) {
            DB::rollBack();

            Log::error('Add book error: ' . $exception->getMessage());
            return false;
        }
        return true;
    }

    public function DeleteBook($bookId)
    {
        try {
            DB::beginTransaction();

            Book::find($bookId)->Authors()->detach();
            Book::destroy($bookId);

            DB::commit();
        } catch (Exception $exception) {
            DB::rollBack();

            Log::error('Delete book error: ' . $exception->getMessage());
            return false;
        }
        return true;
    }

    public function GetBookById($bookId) {
        return Book::with('Category')->find($bookId);
    }

    public function SearchBooks($filters)
    {
        $book = Book::select('id', 'title', 'category_id', 'quantity', 'image')
            ->with([
                'Category' => fn($query) => $query->select('id', 'name', 'number'),
                'Authors' => fn($query) => $query->select('name')
            ])
            ->withCount([
                'Transaction' => fn($query) => $query->where('is_returned', 0)
            ]);

        if(isset($filters['title']) && $filters['title'] != '') {
            $book->where('title', 'like', '%'.$filters['title'].'%');
        }

        $books = $book->paginate($filters['pagination']['per_page'], null, null, $filters['pagination']['page']);

        $books->getCollection()->transform(function ($book) {
            $book->append('status');
            return $book;
        });
        return $books;
    }

    public function SearchDelayedBooks($filters)
    {
        $transaction =  Transactions::select('id', 'borrow_date', 'return_date', 'user_id', 'book_id')
            ->where('return_date', '<', date('y-m-d'))->where('is_returned', 0)
            ->with([
                'Book' => fn($query) => $query->select('id', 'title', 'category_id', 'image'),
                'User' => fn($query) => $query->select('id', 'name'),
                'Book.Category' => fn($query) => $query->select('id', 'name', 'number', 'description')
            ])
            ->whereHas('Book', function ($query) use ($filters) {
                if(isset($filters['title']) && $filters['title'] != '') {
                    $query->where('title', 'like', '%'.$filters['title'].'%');
                }
            })
            ->paginate($filters['pagination']['per_page'], null, null, $filters['pagination']['page']);

        $transaction->getCollection()->transform(function ($book) {
            $book->append('delayed');
            return $book;
        });

        return $transaction;
    }

    public function SearchPopularBooks($filters)
    {
        $query = Book::select('id', 'title', 'category_id', 'image')->withCount('Transaction')
            ->with([
                'Category' => fn($query) => $query->select('id', 'name', 'number'),
                'Authors' => fn($query) => $query->select('name')
            ])->orderBy('transaction_count', 'desc');

        if(isset($filters['title']) && $filters['title'] != '') {
            $query->where('title', 'like', '%'.$filters['title'].'%');
        }

        return $query->paginate($filters['pagination']['per_page'], null, null, $filters['pagination']['page']);

    }

    public function SearchRecommendedBooks($filters)
    {
        $query = Book::select('id', 'title', 'category_id', 'image')
            ->with([
                'Category' => fn($query) => $query->select('id', 'name', 'number'),
                'Authors' => fn($query) => $query->select('name'),
            ])
            ->where('is_recommended', true)->orderBy('order', 'asc');

        if(isset($filters['title']) && $filters['title'] != '') {
            $query->where('title', 'like', '%'.$filters['title'].'%');
        }

        return $query->paginate($filters['pagination']['per_page'], null, null, $filters['pagination']['page']);
    }

    public function BorrowBook($fields)
    {
        return Transactions::create($fields);
    }

    public function ReturnBook($fields)
    {
        $transaction = Transactions::where('user_id', $fields['user_id'])
            ->where('book_id', $fields['book_id'])->first();
        $transaction->is_returned = true;
        $transaction->update();
        return $transaction;
    }
}
