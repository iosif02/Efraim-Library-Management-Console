<?php

namespace App\Repositories;

use App\Models\Book;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Config;

class BookRepository implements IBookRepository
{
    public function AddBook($fields) {
        try {
            \DB::beginTransaction();

            $book = Book::create($fields);

            \DB::commit();
        } catch (Exception $exception) {
            \DB::rollback();
            throw $exception;
        }

        return $book;
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
}
