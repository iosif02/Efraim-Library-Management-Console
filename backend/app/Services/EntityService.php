<?php

namespace App\Services;

use App\Interfaces\IEntityService;
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

    public function SearchAuthors(array $filters): ?LengthAwarePaginator
    {
        try {
            $result = $this->entityRepository->SearchAuthors($filters);
        } catch (Exception $exception) {
            Log::error('Search authors error: ' . $exception->getMessage());
            return null;
        }

        return $result;
    }

    public function AddAuthor(array $fields): bool
    {
        try {
            $result = $this->entityRepository->AddAuthor($fields);
        } catch (Exception $exception) {
            Log::error('Add book error: ' . $exception->getMessage());
            return false;
        }

        return $result;
    }

    public function UpdateAuthor(array $fields): bool
    {
        try {
            $result = $this->entityRepository->UpdateAuthor($fields);
        } catch (Exception $exception) {
            Log::error('Add book error: ' . $exception->getMessage());
            return false;
        }

        return $result;
    }

    public function DeleteAuthor(int $authorId): bool
    {
        try {
            $result = $this->entityRepository->DeleteAuthor($authorId);
        } catch (Exception $exception) {
            Log::error('Add book error: ' . $exception->getMessage());
            return false;
        }

        return $result;
    }

    public function SearchPublisher(array $filters): ?LengthAwarePaginator
    {
        try {
            $result = $this->entityRepository->SearchPublisher($filters);
        } catch (Exception $exception) {
            Log::error('Search authors error: ' . $exception->getMessage());
            return null;
        }

        return $result;
    }

    public function AddPublisher(array $fields): bool
    {
        try {
            $result = $this->entityRepository->AddPublisher($fields);
        } catch (Exception $exception) {
            Log::error('Add book error: ' . $exception->getMessage());
            return false;
        }

        return $result;
    }

    public function UpdatePublisher(array $fields): bool
    {
        try {
            $result = $this->entityRepository->UpdatePublisher($fields);
        } catch (Exception $exception) {
            Log::error('Add book error: ' . $exception->getMessage());
            return false;
        }

        return $result;
    }

    public function DeletePublisher(int $publisherId): bool
    {
        try {
            $result = $this->entityRepository->DeletePublisher($publisherId);
        } catch (Exception $exception) {
            Log::error('Add book error: ' . $exception->getMessage());
            return false;
        }

        return $result;
    }

    public function SearchCategories(array $filters): ?LengthAwarePaginator
    {
        try {
            $result = $this->entityRepository->SearchCategories($filters);
        } catch (Exception $exception) {
            Log::error('Search book error: ' . $exception->getMessage());
            return null;
        }
        return $result;
    }

    public function AddCategory(array $fields): bool
    {
        try {
            $result = $this->entityRepository->AddCategory($fields);
        } catch (Exception $exception) {
            Log::error('Add book error: ' . $exception->getMessage());
            return false;
        }

        return $result;
    }

    public function UpdateCategory(array $fields): bool
    {
        try {
            $result = $this->entityRepository->UpdateCategory($fields);
        } catch (Exception $exception) {
            Log::error('Add book error: ' . $exception->getMessage());
            return false;
        }

        return $result;
    }

    public function DeleteCategory(int $categoryId): bool
    {
        try {
            $result = $this->entityRepository->DeleteCategory($categoryId);
        } catch (Exception $exception) {
            Log::error('Add book error: ' . $exception->getMessage());
            return false;
        }

        return $result;
    }
}
