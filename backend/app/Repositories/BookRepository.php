<?php

namespace App\Repositories;

use App\Models\Book;
use App\Models\Transactions;
use Exception;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
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

    public function GetDelayedBooks(): array|Collection
    {
        return Transactions::query()->where('return_date', '<', 'get_date()')->get();
    }
}
