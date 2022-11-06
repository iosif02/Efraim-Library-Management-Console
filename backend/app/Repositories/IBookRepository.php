<?php

namespace App\Repositories;

interface IBookRepository
{
    public function AddBook($fields);
    public function GetBookById($bookId);
    public function SearchBooks($filters);
}
