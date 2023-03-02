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

    public function SearchAuthors($filters): ?LengthAwarePaginator
    {
        try {
            $result = $this->entityRepository->SearchAuthors($filters);
        } catch (Exception $exception) {
            Log::error('Search authors error: ' . $exception->getMessage());
            return null;
        }

        return $result;
    }

    public function AddAuthor($fields): bool
    {
        try {
            $result = $this->entityRepository->AddAuthor($fields);
        } catch (Exception $exception) {
            Log::error('Add book error: ' . $exception->getMessage());
            return false;
        }

        return (bool)$result;
    }

    public function UpdateAuthor($fields): bool
    {
        try {
            if(!$fields['authorId'])
                throw new Exception('authorId is required!');

            $result = $this->entityRepository->UpdateAuthor($fields);
        } catch (Exception $exception) {
            Log::error('Add book error: ' . $exception->getMessage());
            return false;
        }

        return (bool)$result;
    }

    public function DeleteAuthor($authorId): bool
    {
        try {
            if(!$authorId)
                throw new Exception('authorId is required!');

            $result = $this->entityRepository->DeleteAuthor($authorId);
        } catch (Exception $exception) {
            Log::error('Add book error: ' . $exception->getMessage());
            return false;
        }

        return (bool)$result;
    }

    public function SearchPublisher($filters): ?LengthAwarePaginator
    {
        try {
            $result = $this->entityRepository->SearchPublisher($filters);
        } catch (Exception $exception) {
            Log::error('Search authors error: ' . $exception->getMessage());
            return null;
        }

        return $result;
    }

    public function AddPublisher($fields): bool
    {
        try {
            $result = $this->entityRepository->AddPublisher($fields);
        } catch (Exception $exception) {
            Log::error('Add book error: ' . $exception->getMessage());
            return false;
        }

        return (bool)$result;
    }

    public function UpdatePublisher($fields): bool
    {
        try {
            if(!$fields['publisherId'])
                throw new Exception('publisherId is required!');

            $result = $this->entityRepository->UpdatePublisher($fields);
        } catch (Exception $exception) {
            Log::error('Add book error: ' . $exception->getMessage());
            return false;
        }

        return (bool)$result;
    }

    public function DeletePublisher($publisherId): bool
    {
        try {
            if(!$publisherId)
                throw new Exception('publisherId is required!');

            $result = $this->entityRepository->DeletePublisher($publisherId);
        } catch (Exception $exception) {
            Log::error('Add book error: ' . $exception->getMessage());
            return false;
        }

        return (bool)$result;
    }

    public function SearchCategories($filters): ?LengthAwarePaginator
    {
        try {
            $result = $this->entityRepository->SearchCategories($filters);
        } catch (Exception $exception) {
            Log::error('Search book error: ' . $exception->getMessage());
            return null;
        }
        return $result;
    }

    public function AddCategory($fields): bool
    {
        try {
            $result = $this->entityRepository->AddCategory($fields);
        } catch (Exception $exception) {
            Log::error('Add book error: ' . $exception->getMessage());
            return false;
        }

        return (bool)$result;
    }

    public function UpdateCategory($fields): bool
    {
        try {
            if(!$fields['categoryId'])
                throw new Exception('categoryId is required!');

            $result = $this->entityRepository->UpdateCategory($fields);
        } catch (Exception $exception) {
            Log::error('Add book error: ' . $exception->getMessage());
            return false;
        }

        return (bool)$result;
    }

    public function DeleteCategory($categoryId): bool
    {
        try {
            if(!$categoryId)
                throw new Exception('categoryId is required!');

            $result = $this->entityRepository->DeleteCategory($categoryId);
        } catch (Exception $exception) {
            Log::error('Add book error: ' . $exception->getMessage());
            return false;
        }

        return (bool)$result;
    }
}
