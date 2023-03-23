<?php

namespace App\Repositories;

use App\Models\Author;
use App\Models\Category;
use App\Models\Publisher;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Log;

class EntityRepository implements IEntityRepository
{
    public function GetPublishers(): Collection
    {
        return Publisher::select('id', 'name')->get();
    }

    public function GetAuthors(): Collection
    {
        return Author::select('id', 'name')->get();
    }

    public function GetCategories(): Collection
    {
        return Category::select('id', 'name')->get();
    }

    public function GetAuthorById(int $authorId): ?Author
    {
        return Author::select('id', 'name')->find($authorId);
    }

    public function SearchAuthors(array $filters): ?LengthAwarePaginator
    {
        $query = Author::select('id', 'name')->withCount('Book');

        if(isset($filters['name']) && $filters['name'] != '') {
            $query->where('name', 'like', '%'.$filters['name'].'%');
        }

        return $query->paginate($filters['pagination']['per_page'], null, null, $filters['pagination']['page']);
    }

    public function AddAuthor(array $fields): bool
    {
        try {
             Author::create($fields);
        } catch (Exception $exception) {
            Log::error('Return book error: ' . $exception->getMessage());
            return false;
        }
        return true;
    }

    public function UpdateAuthor(array $fields): bool
    {
        try {
            $author = Author::find($fields['authorId']);
            $author->fill($fields);
            $author->update();
        } catch (Exception $exception) {
            Log::error('Return book error: ' . $exception->getMessage());
            return false;
        }
        return true;
    }

    public function DeleteAuthor(int $authorId): bool
    {
        try {
            Author::destroy($authorId);
        } catch (Exception $exception) {
            Log::error('Return book error: ' . $exception->getMessage());
            return false;
        }
        return true;
    }

    public function GetPublisherById(int $publisherId): ?Publisher
    {
        return Publisher::select('id', 'name', 'city')->find($publisherId);
    }

    public function SearchPublisher(array $filters): ?LengthAwarePaginator
    {
        $query = Publisher::select('id', 'name')->withCount('Book');

        if(isset($filters['name']) && $filters['name'] != '') {
            $query->where('name', 'like', '%'.$filters['name'].'%');
        }

        return $query->paginate($filters['pagination']['per_page'], null, null, $filters['pagination']['page']);
    }

    public function AddPublisher(array $fields): bool
    {
        try {
            Publisher::create($fields);
        } catch (Exception $exception) {
            Log::error('Return book error: ' . $exception->getMessage());
            return false;
        }
        return true;
    }

    public function UpdatePublisher(array $fields): bool
    {
        try {
            $publisher = Publisher::find($fields['publisherId']);
            $publisher->fill($fields);
            $publisher->update();
        } catch (Exception $exception) {
            Log::error('Return book error: ' . $exception->getMessage());
            return false;
        }
        return true;
    }

    public function DeletePublisher(int $publisherId): bool
    {
        try {
            Publisher::destroy($publisherId);
        } catch (Exception $exception) {
            Log::error('Return book error: ' . $exception->getMessage());
            return false;
        }
        return true;
    }

    public function GetCategoryById(int $categoryId): ?Category
    {
        return Category::select('id', 'name', 'description', 'number')->find($categoryId);
    }

    public function SearchCategories(array $filters): ?LengthAwarePaginator
    {
        $query = Category::select('id', 'name', 'number')->withCount('Book');

        if(isset($filters['name']) && $filters['name'] != '') {
            $query->where('name', 'like', '%'.$filters['name'].'%');
        }

        return $query->paginate($filters['pagination']['per_page'], null, null, $filters['pagination']['page']);
    }

    public function AddCategory(array $fields): bool
    {
        try {
            Category::create($fields);
        } catch (Exception $exception) {
            Log::error('Return book error: ' . $exception->getMessage());
            return false;
        }
        return true;
    }

    public function UpdateCategory(array $fields): bool
    {
        try {
            $category = Category::find($fields['categoryId']);
            $category->fill($fields);
            $category->update();
        } catch (Exception $exception) {
            Log::error('Return book error: ' . $exception->getMessage());
            return false;
        }
        return true;
    }

    public function DeleteCategory(int $categoryId): bool
    {
        try {
            Category::destroy($categoryId);
        } catch (Exception $exception) {
            Log::error('Return book error: ' . $exception->getMessage());
            return false;
        }
        return true;
    }
}
