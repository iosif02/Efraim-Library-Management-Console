<?php

namespace App\Repositories;

use App\Models\Book;
use App\Models\Transactions;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class BookRepository implements IBookRepository
{
    /**
     * @throws Exception
     */
    public function AddBook(array $fields): bool
    {
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

    public function UpdateBook(array $fields): bool
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

    public function DeleteBook(int $bookId): bool
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

    public function GetBookById(int $bookId): ?Model
    {
        return Book::with([
            'Category' => fn($query) => $query->select('id', 'name', 'number'),
            'Authors' => fn($query) => $query->select('name'),
            'Publisher' => fn($query) => $query->select('id', 'name'),
            'Transaction' => function ($query){
                $query->select('id', 'book_id', 'user_id', 'borrow_date', 'return_date', 'is_returned')
                    ->where('is_returned', false);
            },
            'Transaction.UserDetails' => fn($query) => $query->select('id', 'user_id', 'first_name', 'last_name')
        ])
        ->withCount([
            'Transaction' => function ($query){
                $query->where('is_returned', false);
            }
        ])->find($bookId)?->append('status');
    }

    public function SearchBooks(array $filters): ?LengthAwarePaginator
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

        // TODO: get delayed directly from query, do not manipulate the data
        $books->getCollection()->transform(function ($book) {
            $book->append('status');
            return $book;
        });

        return $books;
    }

    public function SearchDelayedBooks(array $filters): ?LengthAwarePaginator
    {
        $transaction =  Transactions::select('id', 'borrow_date', 'return_date', 'user_id', 'book_id')
            ->where('return_date', '<', date('y-m-d'))->where('is_returned', false)
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

        // TODO: get delayed directly from query, do not manipulate the data
        $transaction->getCollection()->transform(function ($book) {
            $book->append('delayed');
            return $book;
        });

        return $transaction;
    }

    public function SearchPopularBooks(array $filters): ?LengthAwarePaginator
    {
        $query = Book::select('id', 'title', 'category_id', 'image')
            ->withCount([
                'Transaction' => fn($query) => $query->where('is_returned', false),
            ])->has('Transaction', '>', 0) //in loc de has pot folosi si having('transaction_count', '>', 0), ca un where
            ->with([
                'Category' => fn($query) => $query->select('id', 'name', 'number'),
                'Authors' => fn($query) => $query->select('name')
            ])->orderBy('transaction_count', 'desc');

        if(isset($filters['title']) && $filters['title'] != '') {
            $query->where('title', 'like', '%'.$filters['title'].'%');
        }

        return $query->paginate($filters['pagination']['per_page'], null, null, $filters['pagination']['page']);

    }

    public function SearchRecommendedBooks(array $filters): ?LengthAwarePaginator
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

    public function BorrowBook(array $fields): bool
    {
        try {
            Transactions::create($fields);
        } catch (Exception $exception) {
            Log::error('Borrow book error: ' . $exception->getMessage());
            return false;
        }
        return true;
    }

    public function ReturnBook(int $transactionId): bool
    {
        try {
            $transaction = Transactions::find($transactionId);
            $transaction->is_returned = true;
            $transaction->update();
        } catch (Exception $exception) {
            Log::error('Return book error: ' . $exception->getMessage());
            return false;
        }
        return true;
    }
}
