<?php

namespace App\Services;

use App\Exceptions\CustomException;
use App\Interfaces\IEntityService;
use App\Models\Author;
use App\Models\Category;
use App\Models\Publisher;
use App\Repositories\IEntityRepository;
use Exception;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Log;

class EntityService implements IEntityService
{
    private IEntityRepository $entityRepository;

    public function __construct(IEntityRepository $entityRepository)
    {
        $this->entityRepository = $entityRepository;
    }

    public function GetEntities(): array
    {
        $publishers = $this->entityRepository->GetPublishers();
        $authors = $this->entityRepository->GetAuthors();
        $categories = $this->entityRepository->GetCategories();

        return [
            "publishers" => $publishers,
            "authors" => $authors,
            "categories" => $categories
        ];
    }

    /**
     * @throws CustomException
     */
    public function GetAuthorById(int $authorId): Author
    {
        $author = $this->entityRepository->GetAuthorById($authorId);
        if(!$author)
            throw new CustomException('Author not found!');
        return $author;
    }

    public function SearchAuthors(array $filters): ?LengthAwarePaginator
    {
        return $this->entityRepository->SearchAuthors($filters);
    }

    public function AddAuthor(array $fields): Author
    {
        return $this->entityRepository->AddAuthor($fields);
    }

    /**
     * @throws CustomException
     */
    public function UpdateAuthor(array $fields): Author
    {
        $author = $this->entityRepository->GetAuthorById($fields['authorId']);
        if(!$author)
            throw new CustomException('Author not found!');
        return $this->entityRepository->UpdateAuthor($fields);
    }

    /**
     * @throws CustomException
     */
    public function DeleteAuthor(int $authorId): int
    {
        $author = $this->entityRepository->GetAuthorById($authorId);
        if(!$author)
            throw new CustomException('Author not found!');
        return $this->entityRepository->DeleteAuthor($authorId);
    }

    /**
     * @throws CustomException
     */
    public function GetPublisherById(int $publisherId): Publisher
    {
        $publisher = $this->entityRepository->GetPublisherById($publisherId);
        if(!$publisher)
            throw new CustomException('Publisher not found');
        return $publisher;
    }

    public function SearchPublisher(array $filters): ?LengthAwarePaginator
    {
        return $this->entityRepository->SearchPublisher($filters);
    }

    public function AddPublisher(array $fields): Publisher
    {
        return $this->entityRepository->AddPublisher($fields);
    }

    /**
     * @throws CustomException
     */
    public function UpdatePublisher(array $fields): Publisher
    {
        $publisher = $this->entityRepository->GetPublisherById($fields['publisherId']);
        if(!$publisher)
            throw new CustomException('Publisher not found');
        return $this->entityRepository->UpdatePublisher($fields);
    }

    /**
     * @throws CustomException
     */
    public function DeletePublisher(int $publisherId): int
    {
        $publisher = $this->entityRepository->GetPublisherById($publisherId);
        if(!$publisher)
            throw new CustomException('Publisher not found');
        return $this->entityRepository->DeletePublisher($publisherId);
    }

    /**
     * @throws CustomException
     */
    public function GetCategoryById(int $categoryId): Category
    {
        $category = $this->entityRepository->GetCategoryById($categoryId);
        if(!$category)
            throw new CustomException('Category not found');
        return $category;
    }

    public function SearchCategories(array $filters): ?LengthAwarePaginator
    {
        return $this->entityRepository->SearchCategories($filters);
    }

    public function AddCategory(array $fields): Category
    {
        return $this->entityRepository->AddCategory($fields);
    }

    /**
     * @throws CustomException
     */
    public function UpdateCategory(array $fields): Category
    {
        $category = $this->entityRepository->GetCategoryById($fields['categoryId']);
        if(!$category)
            throw new CustomException('Category not found');
        return $this->entityRepository->UpdateCategory($fields);
    }

    /**
     * @throws CustomException
     */
    public function DeleteCategory(int $categoryId): bool
    {
        $category = $this->entityRepository->GetCategoryById($categoryId);
        if(!$category)
            throw new CustomException('Category not found');
        return $this->entityRepository->DeleteCategory($categoryId);
    }
}
