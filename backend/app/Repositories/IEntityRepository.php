<?php

namespace App\Repositories;

use App\Models\Author;
use App\Models\Category;
use App\Models\Publisher;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

interface IEntityRepository
{
    public function GetPublishers(): Collection;
    public function GetAuthors(): Collection;
    public function GetCategories(): Collection;
    public function GetAuthorById(int $authorId): ?Author;
    public function SearchAuthors(array $filters): ?LengthAwarePaginator;
    public function AddAuthor(array $fields): bool;
    public function UpdateAuthor(array $fields): bool;
    public function DeleteAuthor(int $authorId): bool;
    public function GetPublisherById(int $publisherId): ?Publisher;
    public function SearchPublisher(array $filters): ?LengthAwarePaginator;
    public function AddPublisher(array $fields): bool;
    public function UpdatePublisher(array $fields): bool;
    public function DeletePublisher(int $publisherId): bool;
    public function GetCategoryById(int $categoryId): ?Category;
    public function SearchCategories(array $filters): ?LengthAwarePaginator;
    public function AddCategory(array $fields): bool;
    public function UpdateCategory(array$fields): bool;
    public function DeleteCategory(int $categoryId): bool;
}
