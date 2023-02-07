<?php

namespace App\Repositories;

interface IBookRepository
{
    public function AddBook($fields);
    public function GetBookById($bookId);
    public function SearchBooks($filters);
    public function SearchDelayedBooks($filters);
    public function SearchCategories($filters);
    public function SearchPopularBooks($filters);
    public function SearchRecommendedBooks($filters);
}
