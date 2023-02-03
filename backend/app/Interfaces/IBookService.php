<?php

namespace App\Interfaces;

interface IBookService
{
    public function AddBook($fields);
    public function GetBookById($bookId);
    public function SearchBooks($filters);
    public function SearchDelayedBooks($filters);
    public function GetCategories($fields);
    public function GetPopularBooks($fields);
}
