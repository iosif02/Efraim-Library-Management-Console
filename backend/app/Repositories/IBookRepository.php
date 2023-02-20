<?php

namespace App\Repositories;

interface IBookRepository
{
    public function AddBook($fields);
    public function UpdateBook($fields);
    public function DeleteBook($bookId);
    public function GetBookById($bookId);
    public function SearchBooks($filters);
    public function SearchDelayedBooks($filters);
    public function SearchPopularBooks($filters);
    public function SearchRecommendedBooks($filters);
    public function BorrowBook($fields);
    public function ReturnBook($fields);

}
