<?php

namespace App\Interfaces;

interface IEntityService
{
    public function SearchAuthors($filters);
    public function SearchPublisher($filters);
    public function AddAuthor($fields);
    public function UpdateAuthor($fields);
    public function DeleteAuthor($authorId);
    public function AddPublisher($fields);
    public function UpdatePublisher($fields);
    public function DeletePublisher($publisherId);
    public function SearchCategories($filters);
    public function AddCategory($fields);
    public function UpdateCategory($fields);
    public function DeleteCategory($categoryId);
}
