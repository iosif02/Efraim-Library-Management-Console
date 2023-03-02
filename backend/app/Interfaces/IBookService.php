<?php

namespace App\Interfaces;

interface IBookService
{
    public function GetHomepage();
    public function AddBook($fields);
    public function UpdateBook($fields);
    public function DeleteBook($bookId);
    public function GetBookById($bookId);
    public function SearchBooks($filters);
    public function SearchDelayedBooks($filters);
    public function SearchPopularBooks($filters);
    public function SearchRecommendedBooks($filters);
    public function BorrowBook($fields);
    public function ReturnBook($transactionId);
}
