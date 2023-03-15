<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddBookRequest;
use App\Http\Requests\BookCategorySearchRequest;
use App\Http\Requests\BookSearchRequest;
use App\Http\Requests\BorrowBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Interfaces\IBookService;
use Illuminate\Http\JsonResponse;

class BookController extends Controller
{
    private IBookService $bookService;

    public function __construct(IBookService $bookService) {
        $this->bookService = $bookService;
    }

    public function GetHomepage(): JsonResponse
    {
        $result = $this->bookService->GetHomepage();
        if(!$result) {
            return response()->json(['message' => 'Failed to load homepage. Please contact the administrator!'], 500);
        }

        return response()->json($result, 200);
    }

    public function SearchDelayedBooks(BookSearchRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $result = $this->bookService->SearchDelayedBooks($validated);
        if(!$result) {
            return response()->json(['message' => 'Failed to search delayed books. Please contact the administrator!'], 500);
        }
        return response()->json($result, 200);
    }

    public function SearchRecommendedBooks(BookSearchRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $result = $this->bookService->SearchRecommendedBooks($validated);
        if(!$result) {
            return response()->json(['message' => 'Failed to search recommended books. Please contact the administrator!'], 500);
        }
        return response()->json($result, 200);
    }

    public function SearchPopularBooks(BookSearchRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $result = $this->bookService->SearchPopularBooks($validated);
        if(!$result) {
            return response()->json(['message' => 'Failed to search popular books. Please contact the administrator!'], 500);
        }
        return response()->json($result, 200);
    }

    public function AddBook(AddBookRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $result = $this->bookService->AddBook($validated);
        if(!$result) {
            return response()->json(['message' => 'Failed to create the new book. Please contact the administrator!'], 500);
        }

        return response()->json(true, 200);
    }

    public function UpdateBook(UpdateBookRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $result = $this->bookService->UpdateBook($validated);
        if(!$result) {
            return response()->json(['message' => 'Failed to update the book. Please contact the administrator!'], 500);
        }

        return response()->json(true, 200);
    }

    public function DeleteBook(int $bookId): JsonResponse
    {
        $result = $this->bookService->DeleteBook($bookId);
        if(!$result) {
            return response()->json(['message' => 'Failed to delete the book. Please contact the administrator!'], 500);
        }

        return response()->json(true, 200);
    }

    public function GetBook(int $bookId): JsonResponse
    {
        $result = $this->bookService->GetBookById($bookId);
        if(!$result) {
            return response()->json(['message' => 'Failed to get the book. Please contact the administrator!'], 500);
        }

        return response()->json($result, 200);
    }

    public function SearchBooks(BookCategorySearchRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $result = $this->bookService->SearchBooks($validated);
        if(!$result) {
            return response()->json(['message' => 'Failed to search the book. Please contact the administrator!'], 500);
        }

        return response()->json($result, 200);
    }

    public function BorrowBook(BorrowBookRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $result = $this->bookService->BorrowBook($validated);
        if(!$result) {
            return response()->json(['message' => 'Failed to borrow the book. Please contact the administrator!'], 500);
        }

        return response()->json(true, 200);
    }

    public function ReturnBook(int $transactionId): JsonResponse
    {
        $result = $this->bookService->ReturnBook($transactionId);
        if(!$result) {
            return response()->json(['message' => 'Failed to return the book. Please contact the administrator!'], 500);
        }

        return response()->json(true, 200);
    }
}
