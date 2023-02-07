<?php

namespace App\Repositories;

use App\Models\Book;
use App\Models\Category;
use App\Models\Transactions;
use Exception;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

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

    public function SearchBooks($filters)
    {
        $query = Book::select('id', 'title', 'category_id', 'quantity', 'image')
            ->with([
                'Category' => fn($query) => $query->select('id', 'name', 'number'),
                'Authors' => fn($query) => $query->select('name')
            ])
            ->withCount([
                'Transaction' => fn($query) => $query->where('is_returned', 0)
            ]);

        if(isset($filters['title']) && $filters['title'] != '') {
            $query->where('title', 'like', '%'.$filters['title'].'%');
        }

        return $query->paginate($filters['pagination']['per_page'], null, null, $filters['pagination']['page']);
    }

    public function SearchDelayedBooks($filters)
    {
        return Transactions::select('id', 'borrow_date', 'return_date', 'user_id', 'book_id')
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
    }

    public function SearchCategories($filters)
    {
        $query = Category::select('name', 'number')->withCount('Book');

        if(isset($filters['title']) && $filters['title'] != '') {
            $query->where('name', 'like', '%'.$filters['title'].'%');
        }

        return $query->paginate($filters['pagination']['per_page'], null, null, $filters['pagination']['page']);
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
}
