<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddBookRequest;
use App\Http\Requests\BookSearchRequest;
use App\Http\Requests\PaginateRequest;
use App\Interfaces\IBookService;
use App\Models\Book;
use App\Models\Transactions;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;

class BookController extends Controller
{
    private IBookService $bookService;

    public function __construct(IBookService $bookService) {
        $this->bookService = $bookService;
    }

    public function GetHomepage(): Response|Application|ResponseFactory
    {
        $result = $this->bookService->GetHomepage();
        if(!$result) {
            return response(false, 400);
        }

        return response($result, 200);
    }

    public function SearchDelayedBooks(BookSearchRequest $request): Response|Application|ResponseFactory
    {
        $validated = $request->validated();
        $result = $this->bookService->SearchDelayedBooks($validated);
        if(!$result) {
            return response(false, 400);
        }

        return response($result, 200);
    }

    public function SearchRecommendedBooks(BookSearchRequest $request): Response|Application|ResponseFactory
    {
        $validated = $request->validated();
        $result = $this->bookService->SearchRecommendedBooks($validated);
        if(!$result) {
            return response(false, 400);
        }

        return response($result, 200);
    }

    public function SearchCategories(BookSearchRequest $request): Response|Application|ResponseFactory
    {
        $validated = $request->validated();
        $result = $this->bookService->SearchCategories($validated);
        if(!$result) {
            return response(false, 400);
        }
        return response($result, 200);
    }

    public function SearchPopularBooks(BookSearchRequest $request): Response|Application|ResponseFactory
    {
        $validated = $request->validated();
        $result = $this->bookService->SearchPopularBooks($validated);
        if(!$result) {
            return response(false, 400);
        }
        return response($result, 200);
    }

    public function AddBook(AddBookRequest $request): Response|Application|ResponseFactory
    {
        $validated = $request->validated();
        $result = $this->bookService->AddBook($validated);
        if(!$result) {
            return response(false, 400);
        }

        return response(true, 200);
    }

    public function GetBook($bookId):  ?Book
    {
        if(!$bookId) return null;

        return $this->bookService->GetBookById($bookId);
    }

    public function SearchBooks(BookSearchRequest $request): Response|Application|ResponseFactory
    {
        $validated = $request->validated();
        $result = $this->bookService->SearchBooks($validated);
        if(!$result) {
            return response(false, 400);
        }

        return response($result, 200);
    }
}
