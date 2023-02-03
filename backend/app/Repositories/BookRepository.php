<?php

namespace App\Repositories;

use App\Models\Book;
use App\Models\Category;
use App\Models\Transactions;
use Exception;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Config;

class BookRepository implements IBookRepository
{
    /**
     * @throws Exception
     */
    public function AddBook($fields) {
        return Book::create($fields);
    }

    public function GetBookById($bookId) {
        return Book::find($bookId);
    }

    public function SearchBooks($filters): LengthAwarePaginator
    {
        $queryBook = Book::query();
        if(!is_null($filters['title'])) {
            $queryBook->where('title', 'like', '%'.$filters['title'].'%');
        }

        return $queryBook->paginate(Config::get('app.paginate_per_page'));
    }
    public function SearchDelayedBooks($filters)
    {
        return Transactions::select('id', 'borrow_date', 'return_date', 'user_id', 'book_id')
            ->where('return_date', '<', date('Y-m-d'))
            ->with([
                'Book' => fn($query) => $query->select('id', 'title', 'category_id', 'image'),
                'User' => fn($query) => $query->select('id', 'name'),
                'Book.Category' => fn($query) => $query->select('id', 'name', 'number', 'description')
            ])
            ->whereHas('book', function ($query) use ($filters) {
                if($filters['title']) {
                    $query->where('title', 'like', '%'.$filters['title'].'%');
                }
            })
            ->paginate($filters['pagination']['perPage'], null, null, $filters['pagination']['page']);
    }

    public function GetCategories($fields)
    {
        return Category::select('name')->withCount('Book')
            ->paginate($fields['perPage'], null, null, $fields['page']);
//        return Book::withCount('Transaction')->with('category')->orderBy('transaction_count', 'desc')->get();
    }

    public function GetPopularBooks($fields)
    {
        return Book::select('id', 'title', 'category_id')
            ->with([
                'Category' => fn($query) => $query->select('id', 'name', 'number'),
                'bookAuthor' => fn($query) => $query->select('author_id', 'book_id'),
                'bookAuthor.author' => fn($query) => $query->select('id', 'name')
            ])
            ->where('is_recommended', 1)->orderBy('order', 'asc')
//            ->paginate($fields['perPage'], null, null, $fields['page']);
        ->take(1)->get();
    }
}
