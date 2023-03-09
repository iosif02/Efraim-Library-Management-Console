<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

interface IEntityRepository
{
    public function GetPublishers(): Collection;
    public function GetAuthors(): Collection;
    public function GetCategories(): Collection;
    public function SearchAuthors(array $filters): ?LengthAwarePaginator;
    public function AddAuthor(array $fields): bool;
    public function UpdateAuthor(array $fields): bool;
    public function DeleteAuthor(int $authorId): bool;
    public function SearchPublisher(array $filters): ?LengthAwarePaginator;
    public function AddPublisher(array $fields): bool;
    public function UpdatePublisher(array $fields): bool;
    public function DeletePublisher(int $publisherId): bool;
    public function SearchCategories(array $filters): ?LengthAwarePaginator;
    public function AddCategory(array $fields): bool;
    public function UpdateCategory(array$fields): bool;
    public function DeleteCategory(int $categoryId): bool;
}
