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

    public function GetHomepage()
    {
        $result1 = $this->bookService->GetDelayedBooks();
        $result2 = $this->bookService->GetPopularBooks();
        $result3 = $this->bookService->GetCategoryBooks();
        if(!$result1 || !$result2 || !$result3) {
            return response(false, 400);
        }

        return response(
            [
                'delayed' => $result1,
                'popular' => $result2,
                'category' => $result3,
            ],
            200
        );
    }

    public function GetDelayedBooks(BookSearchRequest $request)
    {
        $validated = $request->validated();
        $result = $this->bookService->SearchDelayedBooks($validated);
        if(!$result) {
            return response(false, 400);
        }

        return response($result, 200);
    }

    public function GetPopularBooks(BookSearchRequest $request)
    {
        $validated = $request->validated();
        $result = $this->bookService->SearchPopularBooks($validated);
        if(!$result) {
            return response(false, 400);
        }

        return response($result, 200);
    }

    public function GetCategories(BookSearchRequest $request) {
        $validated = $request->validated();
        $result = $this->bookService->SearchCategories($validated);
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

    public function SearchBooks(BookSearchRequest $request)
    {
        $validated = $request->validated();
        $result = $this->bookService->SearchBooks($validated);
        if(!$result) {
            return response(false, 400);
        }

        return response($result, 200);
    }
}
