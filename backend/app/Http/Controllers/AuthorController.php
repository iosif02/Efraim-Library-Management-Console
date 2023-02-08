<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthorSearchRequest;
use App\Interfaces\IAuthorService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;


class AuthorController extends Controller
{
    private IAuthorService $authorService;
    public function __construct(IAuthorService $authorService) {
        $this->authorService = $authorService;
    }

    public function SearchAuthors(AuthorSearchRequest $request): Response|Application|ResponseFactory
    {
        $validated = $request->validated();
        $result = $this->authorService->SearchAuthors($validated);
        if(!$result) {
            return response(false, 400);
        }

        return response($result, 200);
    }
}
