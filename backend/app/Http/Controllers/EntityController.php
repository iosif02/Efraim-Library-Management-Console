<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddAuthorRequest;
use App\Http\Requests\AddCategoryRequest;
use App\Http\Requests\AddPublisherRequest;
use App\Http\Requests\AuthorSearchRequest;
use App\Http\Requests\UpdateAuthorRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Http\Requests\UpdatePublisherRequest;
use App\Interfaces\IEntityService;
use App\Models\Author;
use App\Models\Category;
use App\Models\Publisher;
use App\Policies\AuthorPolicy;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Gate;


class EntityController extends Controller
{
    private IEntityService $entityService;
    public function __construct(IEntityService $entityService) {
        $this->entityService = $entityService;
    }

    public function GetEntities(): JsonResponse
    {
        $result = $this->entityService->GetEntities();
        return response()->json($result);
    }
    public function GetAuthor(int $authorId): JsonResponse
    {
        $result = $this->entityService->GetAuthorById($authorId);
        return response()->json($result);
    }
    public function SearchAuthors(AuthorSearchRequest $request): JsonResponse
    {
//        Gate::authorize('viewAny', Author::class);

        $validated = $request->validated();
        $result = $this->entityService->SearchAuthors($validated);

        return response()->json($result);
    }

    public function AddAuthor(AddAuthorRequest $request): JsonResponse
    {
//        Gate::authorize('create', Author::class);

        $validated = $request->validated();
        $result = $this->entityService->AddAuthor($validated);

        return response()->json($result);
    }

    public function UpdateAuthor(UpdateAuthorRequest $request): JsonResponse
    {
//        Gate::authorize('update', Author::class);

        $validated = $request->validated();
        $result = $this->entityService->UpdateAuthor($validated);

        return response()->json($result);
    }

    public function DeleteAuthor(int $authorId): JsonResponse
    {
//        Gate::authorize('delete', Author::class);

        $result = $this->entityService->DeleteAuthor($authorId);
        return response()->json($result);
    }

    public function GetPublisher(int $publisherId): JsonResponse
    {
        $result = $this->entityService->GetPublisherById($publisherId);
        return response()->json($result);
    }

    public function SearchPublisher(AuthorSearchRequest $request): JsonResponse
    {
//        Gate::authorize('viewAny', Publisher::class);

        $validated = $request->validated();
        $result = $this->entityService->SearchPublisher($validated);

        return response()->json($result);
    }

    public function AddPublisher(AddPublisherRequest $request): JsonResponse
    {
//        Gate::authorize('create', Publisher::class);

        $validated = $request->validated();
        $result = $this->entityService->AddPublisher($validated);

        return response()->json($result);
    }

    public function UpdatePublisher(UpdatePublisherRequest $request): JsonResponse
    {
//        Gate::authorize('update', Publisher::class);

        $validated = $request->validated();
        $result = $this->entityService->UpdatePublisher($validated);

        return response()->json($result);
    }

    public function DeletePublisher(int $publisherId): JsonResponse
    {
//        Gate::authorize('delete', Publisher::class);

        $result = $this->entityService->DeletePublisher($publisherId);
        return response()->json($result);
    }

    public function GetCategory(int $categoryId): JsonResponse
    {
        $result = $this->entityService->GetCategoryById($categoryId);
        return response()->json($result);
    }

    public function SearchCategories(AuthorSearchRequest $request): JsonResponse
    {
//        Gate::authorize('viewAny', Category::class);

        $validated = $request->validated();
        $result = $this->entityService->SearchCategories($validated);

        return response()->json($result);
    }

    public function AddCategory(AddCategoryRequest $request): JsonResponse
    {
//        Gate::authorize('create', Category::class);

        $validated = $request->validated();
        $result = $this->entityService->AddCategory($validated);

        return response()->json($result);
    }

    public function UpdateCategory(UpdateCategoryRequest $request): JsonResponse
    {
//        Gate::authorize('update', Category::class);

        $validated = $request->validated();
        $result = $this->entityService->UpdateCategory($validated);

        return response()->json($result);
    }

    public function DeleteCategory(int $categoryId): JsonResponse
    {
//        Gate::authorize('delete', Category::class);

        $result = $this->entityService->DeleteCategory($categoryId);
        return response()->json($result);
    }
}
