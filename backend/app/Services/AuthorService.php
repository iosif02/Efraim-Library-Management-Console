<?php

namespace App\Services;

use App\Interfaces\IAuthorService;
use App\Repositories\IAuthorRepository;
use Exception;
use Illuminate\Support\Facades\Log;

class AuthorService implements IAuthorService
{
    private IAuthorRepository $authorRepository;

    public function __construct(IAuthorRepository $authorRepository)
    {
        $this->authorRepository = $authorRepository;
    }

    public function SearchAuthors($filters) {
        try {
            $result = $this->authorRepository->SearchAuthors($filters);
        } catch (Exception $exception) {
            Log::error('Search authors error: ' . $exception->getMessage());
            return null;
        }

        return $result;
    }

    public function SearchPublisher($filters)
    {
        try {
            $result = $this->authorRepository->SearchPublisher($filters);
        } catch (Exception $exception) {
            Log::error('Search authors error: ' . $exception->getMessage());
            return null;
        }

        return $result;
    }
}
