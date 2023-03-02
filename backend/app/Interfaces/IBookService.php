<?php

namespace App\Interfaces;

interface IBookService
{
    public function GetHomepage();
    public function AddBook(array $fields);
    public function UpdateBook(array $fields);
    public function DeleteBook(int $bookId);
    public function GetBookById(int $bookId);
    public function SearchBooks(array $filters);
    public function SearchDelayedBooks(array $filters);
    public function SearchPopularBooks(array $filters);
    public function SearchRecommendedBooks(array $filters);
    public function BorrowBook(array $fields);
    public function ReturnBook(int $transactionId);
}
