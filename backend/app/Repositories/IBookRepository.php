<?php

namespace App\Repositories;

use App\Models\Book;

interface IBookRepository
{
    public function AddBook($fields): bool;
    public function UpdateBook($fields): bool;
    public function DeleteBook($bookId): bool;
    public function GetBookById($bookId): ?Book;
    public function SearchBooks($filters);
    public function SearchDelayedBooks($filters);
    public function SearchPopularBooks($filters);
    public function SearchRecommendedBooks($filters);
    public function BorrowBook($fields): bool;
    public function ReturnBook($transactionId);

}
