<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

interface IBookRepository
{
    public function AddBook(array $fields): bool;
    public function UpdateBook(array $fields): bool;
    public function DeleteBook(int $bookId): bool;
    public function GetBookById(int $bookId): ?Model;
    public function SearchBooks(array $filters): ?LengthAwarePaginator;
    public function SearchDelayedBooks(array $filters): ?LengthAwarePaginator;
    public function SearchPopularBooks(array $filters): ?LengthAwarePaginator;
    public function SearchRecommendedBooks(array $filters): ?LengthAwarePaginator;
    public function BorrowBook(array $fields): bool;
    public function ReturnBook(int $transactionId): bool;

}
