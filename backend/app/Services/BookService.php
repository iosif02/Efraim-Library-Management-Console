<?php

namespace App\Services;

use App\Interfaces\IBookService;
use App\Repositories\IBookRepository;
use Exception;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Log;

class BookService implements IBookService
{
    private IBookRepository $bookRepository;

    public function __construct(IBookRepository $bookRepository)
    {
        $this->bookRepository = $bookRepository;
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
