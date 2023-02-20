<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddBookRequest;
use App\Http\Requests\BookSearchRequest;
use App\Http\Requests\BorrowBookRequest;
use App\Http\Requests\PaginateRequest;
use App\Http\Requests\UpdateBookRequest;
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

    public function UpdateBook(UpdateBookRequest $request): Response|Application|ResponseFactory
    {
        $validated = $request->validated();
        $result = $this->bookService->UpdateBook($validated);
        if(!$result) {
            return response(false, 400);
        }

        return response(true, 200);
    }

    public function DeleteBook($bookId): Response|Application|ResponseFactory
    {
        $result = $this->bookService->DeleteBook($bookId);
        if(!$result) {
            return response(false, 400);
        }

        return response(true, 200);
    }

    public function GetBook($bookId)
    {
        if(!$bookId) return null;

        return $this->bookService->GetBookById($bookId);
    }

    public function SearchBooks(BookSearchRequest $request)
    {
        $validated = $request->validated();
        $result = $this->bookService->SearchBooks($validated);
        if(!$result) {
            return response(false, 400);
        }

        return response($result, 200);
    }

    public function BorrowBook(BorrowBookRequest $request): Response|Application|ResponseFactory
    {
        $validated = $request->validated();
        $result = $this->bookService->BorrowBook($validated);
        if(!$result) {
            return response(false, 400);
        }

        return response(true, 200);
    }

    public function ReturnBook(BorrowBookRequest $request): Response|Application|ResponseFactory
    {
        $validated = $request->validated();
        $result = $this->bookService->ReturnBook($validated);
        if(!$result) {
            return response(false, 400);
        }

        return response(true, 200);
    }

}
