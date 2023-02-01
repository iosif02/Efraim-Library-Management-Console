<?php

namespace App\Services;

use App\Interfaces\IBookService;
use App\Interfaces\IFileService;
use App\Repositories\IBookRepository;
use Exception;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Log;

class BookService implements IBookService
{
    private IBookRepository $bookRepository;
    private IFileService $fileService;

    public function __construct(IBookRepository $bookRepository, IFileService $fileService)
    {
        $this->bookRepository = $bookRepository;
        $this->fileService = $fileService;
    }

    public function AddBook($fields): bool
    {
        try {
            $imageName = $this->fileService->StoreFile($fields['image']);
            $fields['image'] = $imageName;

            $result = $this->bookRepository->AddBook($fields);
        } catch (Exception $exception) {
            Log::error('Add book error: ' . $exception->getMessage());
            return false;
        }

        return (bool)$result;
    }

    public function GetBookById($bookId) {
        if(!$bookId) return null;

        return $this->bookRepository->GetBookById($bookId);
    }

    public function SearchBooks($filters): ?LengthAwarePaginator
    {
        try {
            $result = $this->bookRepository->SearchBooks($filters);
        } catch (Exception $exception) {
            Log::error('Search book error: ' . $exception->getMessage());
            return null;
        }

        return $result;
    }
}
