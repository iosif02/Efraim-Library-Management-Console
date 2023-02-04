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
        return Book::select('id', 'title', 'category_id', 'quantity')->where('title', 'like', '%'.$filters['title'].'%')
            ->with([
                'Category' => fn($query) => $query->select('id', 'name', 'number')
            ])
            ->withCount([
                'Transaction' => fn($query) => $query->where('is_returned', 0)
            ])
            ->paginate($filters['pagination']['perPage'], null, null, $filters['pagination']['page']);
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
                if($filters['title']) {
                    $query->where('title', 'like', '%'.$filters['title'].'%');
                }
            })
            ->paginate($filters['pagination']['perPage'], null, null, $filters['pagination']['page']);
    }

    public function SearchCategories($filters)
    {
        return Category::select('name')
            ->where('name', 'like', '%'.$filters['title'].'%')
            ->withCount('Book')
            ->paginate($filters['pagination']['perPage'], null, null, $filters['pagination']['page']);

//        return Book::withCount('Transaction')->with('category')->orderBy('transaction_count', 'desc')->get();
    }

    public function SearchPopularBooks($filters)
    {
        return Book::select('id', 'title', 'category_id')
            ->where('title', 'like', '%'.$filters['title'].'%')
            ->with([
                'Category' => fn($query) => $query->select('id', 'name', 'number'),
                'BookAuthor' => fn($query) => $query->select('author_id', 'book_id'),
                'BookAuthor.Author' => fn($query) => $query->select('id', 'name')
            ])
            ->where('is_recommended', true)->orderBy('order', 'asc')
            ->paginate($filters['pagination']['perPage'], null, null, $filters['pagination']['page']);
    }

    public function GetDelayedBooks(){
        $delayed = Transactions::where('return_date', '<', date('y-m-d'))->where('is_returned', 0)->count();
        $transaction = Transactions::select('id', 'borrow_date', 'return_date', 'user_id', 'book_id')
            ->where('return_date', '<', date('y-m-d'))->where('is_returned', 0)
            ->with([
                'Book' => fn($query) => $query->select('id', 'title', 'category_id', 'image'),
                'User' => fn($query) => $query->select('id', 'name'),
                'Book.Category' => fn($query) => $query->select('id', 'name', 'number', 'description')
            ])
            ->take(3)->get();
        return [
            'TotalBooks' => $delayed,
            'Books' => $transaction
        ];
    }

    public function GetPopularBooks()
    {
        return Book::select('id', 'title', 'category_id')
            ->with([
                'Category' => fn($query) => $query->select('id', 'name', 'number'),
                'BookAuthor' => fn($query) => $query->select('author_id', 'book_id'),
                'BookAuthor.Author' => fn($query) => $query->select('id', 'name')
            ])
            ->where('is_recommended', true)->orderBy('order', 'asc')
            ->take(3)->get();
    }

    public function GetCategoryBooks()
    {
        return Category::select('name')
            ->withCount('Book')
            ->take(3)->get();
    }
}
