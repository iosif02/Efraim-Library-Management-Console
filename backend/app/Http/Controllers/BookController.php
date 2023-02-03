<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddBookRequest;
use App\Http\Requests\BookSearchRequest;
use App\Http\Requests\PaginateRequest;
use App\Interfaces\IBookService;
use App\Models\Book;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;
use JetBrains\PhpStorm\ArrayShape;

class BookController extends Controller
{
    private IBookService $bookService;

    public function __construct(IBookService $bookService) {
        $this->bookService = $bookService;
    }

    public function GetHomepage(): array
    {
        $date = date('d-m-y h:i:s');
        return [
            'DelayedBooks' => [
                'Total' => 23,
                'Books' => [
                    [
                        "UserName" => "Iosif Oprea",
                        "DueDate" => $date,
                        "title" => "Fram, ursul polar",
                        "PhotoUrl" => "https://i.guim.co.uk/img/media/51e82d1479c8bec3fbf6e620f44199490171ac66/433_134_1145_1723/master/1145.jpg?width=700&quality=85&auto=format&fit=max&s=ba7fd94e443ce0193c3a42095c9b4736"
                    ],
                    [
                        "UserName" => "Iosif Oprea",
                        "DueDate" => $date,
                        "title" => "Fram, ursul polar",
                        "PhotoUrl" => "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTvcq4KN4eIWKxk5vlSZH3Po_g2e9zPb8q_9g&usqp=CAU"
                    ],
                    [
                        "UserName" => "Iosif Oprea",
                        "DueDate" => $date,
                        "title" => "Fram, ursul polar",
                        "PhotoUrl" => "https://d1csarkz8obe9u.cloudfront.net/themedlandingpages/tlp_hero_book-cover-adb8a02f82394b605711f8632a44488b-1627474998.jpg"
                    ]
                ]
            ],
            "PopularBooks" => [
                [
                    "UserName" => "Iosif Oprea",
                    "title" => "Fram, ursul polar",
                    "AuthorName" => "Autor",
                    "CategoryNumber" => 4,
                    "CategoryName" => "Children",
                    "PhotoUrl" => "https://i.guim.co.uk/img/media/51e82d1479c8bec3fbf6e620f44199490171ac66/433_134_1145_1723/master/1145.jpg?width=700&quality=85&auto=format&fit=max&s=ba7fd94e443ce0193c3a42095c9b4736"
                ],
                [
                    "UserName" => "Iosif Oprea",
                    "AuthorName" => "Autor",
                    "title" => "Fram, ursul polar",
                    "CategoryNumber" => 4,
                    "CategoryName" => "Children",
                    "PhotoUrl" => "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTvcq4KN4eIWKxk5vlSZH3Po_g2e9zPb8q_9g&usqp=CAU"
                ],
                [
                    "UserName" => "Iosif Oprea",
                    "AuthorName" => "Autor",
                    "CategoryNumber" => 4,
                    "CategoryName" => "Children",
                    "title" => "Fram, ursul polar",
                    "PhotoUrl" => "https://d1csarkz8obe9u.cloudfront.net/themedlandingpages/tlp_hero_book-cover-adb8a02f82394b605711f8632a44488b-1627474998.jpg"
                ]
            ],
            "Categories" => [
                [
                    "Name" => "History",
                    "Books" => 4
                ],
                [
                    "Name" => "History",
                    "Books" => 4
                ],
                [
                    "Name" => "History",
                    "Books" => 4
                ]
            ]
        ];
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

    public function GetPopularBooks(PaginateRequest $request)
    {
        $validated = $request->validated();
        $result = $this->bookService->GetPopularBooks($validated);
        if(!$result) {
            return response(false, 400);
        }

        return response($result, 200);
    }

    public function GetCategories(PaginateRequest $request) {
        $validated = $request->validated();
        $result = $this->bookService->GetCategories($validated);
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
