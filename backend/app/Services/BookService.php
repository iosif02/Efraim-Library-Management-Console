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

    public function SearchBooks($filters)
    {
        try {
            $result = $this->bookRepository->SearchBooks($filters);
        } catch (Exception $exception) {
            Log::error('Search book error: ' . $exception->getMessage());
            return null;
        }

        return $result;
    }

    public function SearchDelayedBooks($filters) {
        try {
            $result = $this->bookRepository->SearchDelayedBooks($filters);
        } catch (Exception $exception) {
            Log::error('Search book error: ' . $exception->getMessage());
            return null;
        }

//        $result = collect($result);
//        $result['data'] = collect($result['data'])->map(function ($entry) {
//            return [
//                'transaction_id' => $entry['id'],
//                'book_title' => $entry['book']['title'],
//                'category' => $entry['book']['category'],
//                'image' => $entry['book']['image'],
//                'user_name' => $entry['user']['name']
//            ];
//        });

        return $result;
    }

    public function SearchCategories($filters)
    {
        try {
            $result = $this->bookRepository->SearchCategories($filters);
        } catch (Exception $exception) {
            Log::error('Search book error: ' . $exception->getMessage());
            return null;
        }
        return $result;
    }

    public function SearchPopularBooks($filters)
    {
        try {
            $result = $this->bookRepository->SearchPopularBooks($filters);
        } catch (Exception $exception) {
            Log::error('Search book error: ' . $exception->getMessage());
            return null;
        }
        return $result;
    }

    public function GetDelayedBooks()
    {
        try {
            $result = $this->bookRepository->GetDelayedBooks();
        } catch (Exception $exception) {
            Log::error('Search book error: ' . $exception->getMessage());
            return null;
        }
        return $result;
    }

    public function GetPopularBooks()
    {
        try {
            $result = $this->bookRepository->GetPopularBooks();
        } catch (Exception $exception) {
            Log::error('Search book error: ' . $exception->getMessage());
            return null;
        }
        return $result;
    }

    public function GetCategoryBooks()
    {
        try {
            $result = $this->bookRepository->GetCategoryBooks();
        } catch (Exception $exception) {
            Log::error('Search book error: ' . $exception->getMessage());
            return null;
        }
        return $result;
    }

}
