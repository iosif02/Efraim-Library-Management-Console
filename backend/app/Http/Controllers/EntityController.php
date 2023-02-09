<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddAuthorRequest;
use App\Http\Requests\AddCategoryRequest;
use App\Http\Requests\AddPublisherRequest;
use App\Http\Requests\AuthorSearchRequest;
use App\Http\Requests\BookSearchRequest;
use App\Http\Requests\UpdateAuthorRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Http\Requests\UpdatePublisherRequest;
use App\Interfaces\IEntityService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;


class EntityController extends Controller
{
    private IEntityService $entityService;
    public function __construct(IEntityService $entityService) {
        $this->entityService = $entityService;
    }

    public function SearchAuthors(AuthorSearchRequest $request): Response|Application|ResponseFactory
    {
        $validated = $request->validated();
        $result = $this->entityService->SearchAuthors($validated);
        if(!$result) {
            return response(false, 400);
        }

        return response($result, 200);
    }

    public function AddAuthor(AddAuthorRequest $request): Response|Application|ResponseFactory
    {
        $validated = $request->validated();
        $result = $this->entityService->AddAuthor($validated);
        if(!$result) {
            return response(false, 400);
        }

        return response(true, 200);
    }

    public function UpdateAuthor(UpdateAuthorRequest $request): Response|Application|ResponseFactory
    {
        $validated = $request->validated();
        $result = $this->entityService->UpdateAuthor($validated);
        if(!$result) {
            return response(false, 400);
        }

        return response(true, 200);
    }

    public function DeleteAuthor($authorId): Response|Application|ResponseFactory
    {
        $result = $this->entityService->DeleteAuthor($authorId);
        if(!$result) {
            return response(false, 400);
        }

        return response(true, 200);
    }

    public function SearchPublisher(AuthorSearchRequest $request): Response|Application|ResponseFactory
    {
        $validated = $request->validated();
        $result = $this->entityService->SearchPublisher($validated);
        if(!$result) {
            return response(false, 400);
        }

        return response($result, 200);
    }

    public function AddPublisher(AddPublisherRequest $request): Response|Application|ResponseFactory
    {
        $validated = $request->validated();
        $result = $this->entityService->AddPublisher($validated);
        if(!$result) {
            return response(false, 400);
        }

        return response(true, 200);
    }

    public function UpdatePublisher(UpdatePublisherRequest $request): Response|Application|ResponseFactory
    {
        $validated = $request->validated();
        $result = $this->entityService->UpdatePublisher($validated);
        if(!$result) {
            return response(false, 400);
        }

        return response(true, 200);
    }

    public function DeletePublisher($publisherId): Response|Application|ResponseFactory
    {
        $result = $this->entityService->DeletePublisher($publisherId);
        if(!$result) {
            return response(false, 400);
        }

        return response(true, 200);
    }

    public function SearchCategories(AuthorSearchRequest $request): Response|Application|ResponseFactory
    {
        $validated = $request->validated();
        $result = $this->entityService->SearchCategories($validated);
        if(!$result) {
            return response(false, 400);
        }
        return response($result, 200);
    }

    public function AddCategory(AddCategoryRequest $request): Response|Application|ResponseFactory
    {
        $validated = $request->validated();
        $result = $this->entityService->AddCategory($validated);
        if(!$result) {
            return response(false, 400);
        }

        return response(true, 200);
    }

    public function UpdateCategory(UpdateCategoryRequest $request): Response|Application|ResponseFactory
    {
        $validated = $request->validated();
        $result = $this->entityService->UpdateCategory($validated);
        if(!$result) {
            return response(false, 400);
        }

        return response(true, 200);
    }

    public function DeleteCategory($categoryId): Response|Application|ResponseFactory
    {
        $result = $this->entityService->DeleteCategory($categoryId);
        if(!$result) {
            return response(false, 400);
        }

        return response(true, 200);
    }
}
