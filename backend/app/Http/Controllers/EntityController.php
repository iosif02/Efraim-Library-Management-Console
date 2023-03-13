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
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;


class EntityController extends Controller
{
    private IEntityService $entityService;
    public function __construct(IEntityService $entityService) {
        $this->entityService = $entityService;
    }

    public function GetEntities(): JsonResponse
    {
        $result = $this->entityService->GetEntities();
        if(!$result) {
            return response()->json(['message' => 'test'], 500);
        }

        return response()->json($result, 200);
    }

    public function SearchAuthors(AuthorSearchRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $result = $this->entityService->SearchAuthors($validated);
        if(!$result) {
            return response()->json(['message' => 'Failed to search the author. Please contact the administrator!'], 500);
        }

        return response()->json($result, 200);
    }

    public function AddAuthor(AddAuthorRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $result = $this->entityService->AddAuthor($validated);
        if(!$result) {
            return response()->json(['message' => 'Failed to add the author. Please contact the administrator!'], 500);
        }

        return response()->json(true, 200);
    }

    public function UpdateAuthor(UpdateAuthorRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $result = $this->entityService->UpdateAuthor($validated);
        if(!$result) {
            return response()->json(['message' => 'Failed to update the author. Please contact the administrator!'], 500);
        }

        return response()->json(true, 200);
    }

    public function DeleteAuthor(int $authorId): JsonResponse
    {
        $result = $this->entityService->DeleteAuthor($authorId);
        if(!$result) {
            return response()->json(['message' => 'Failed to delete the author. Please contact the administrator!'], 500);
        }

        return response()->json(true, 200);
    }

    public function SearchPublisher(AuthorSearchRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $result = $this->entityService->SearchPublisher($validated);
        if(!$result) {
            return response()->json(['message' => 'Failed to search the publisher. Please contact the administrator!'], 500);
        }

        return response()->json($result, 200);
    }

    public function AddPublisher(AddPublisherRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $result = $this->entityService->AddPublisher($validated);
        if(!$result) {
            return response()->json(['message' => 'Failed to add the publisher. Please contact the administrator!'], 500);
        }

        return response()->json(true, 200);
    }

    public function UpdatePublisher(UpdatePublisherRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $result = $this->entityService->UpdatePublisher($validated);
        if(!$result) {
            return response()->json(['message' => 'Failed to update the publisher. Please contact the administrator!'], 500);
        }

        return response()->json(true, 200);
    }

    public function DeletePublisher(int $publisherId): JsonResponse
    {
        $result = $this->entityService->DeletePublisher($publisherId);
        if(!$result) {
            return response()->json(['message' => 'Failed to delete the publisher. Please contact the administrator!'], 500);
        }

        return response()->json(true, 200);
    }

    public function SearchCategories(AuthorSearchRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $result = $this->entityService->SearchCategories($validated);
        if(!$result) {
            return response()->json(['message' => 'Failed to search the category. Please contact the administrator!'], 500);
        }
        return response()->json($result, 200);
    }

    public function AddCategory(AddCategoryRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $result = $this->entityService->AddCategory($validated);
        if(!$result) {
            return response()->json(['message' => 'Failed to add the category. Please contact the administrator!'], 500);
        }

        return response()->json(true, 200);
    }

    public function UpdateCategory(UpdateCategoryRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $result = $this->entityService->UpdateCategory($validated);
        if(!$result) {
            return response()->json(['message' => 'Failed to update the category. Please contact the administrator!'], 500);
        }

        return response()->json(true, 200);
    }

    public function DeleteCategory(int $categoryId): JsonResponse
    {
        $result = $this->entityService->DeleteCategory($categoryId);
        if(!$result) {
            return response()->json(['message' => 'Failed to delete the category. Please contact the administrator!'], 500);
        }

        return response()->json(true, 200);
    }
}
