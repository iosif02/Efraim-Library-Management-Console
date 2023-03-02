<?php

namespace App\Repositories;

use App\Models\Author;
use App\Models\Category;
use App\Models\Publisher;
use Exception;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Log;

class EntityRepository implements IEntityRepository
{
    public function SearchAuthors($filters): ?LengthAwarePaginator
    {
        $query = Author::select('id', 'name');

        if(isset($filters['title']) && $filters['title'] != '') {
            $query->where('name', 'like', '%'.$filters['title'].'%');
        }

        if(isset($filters['getAll']) && $filters['getAll']) {
            $filters['pagination'] = ['per_page' => 9999999, 'page' => 1];
        }

        return $query->paginate($filters['pagination']['per_page'], null, null, $filters['pagination']['page']);
    }

    public function AddAuthor($fields): bool
    {
        try {
             Author::create($fields);
        } catch (Exception $exception) {
            Log::error('Return book error: ' . $exception->getMessage());
            return false;
        }
        return true;
    }

    public function UpdateAuthor($fields): bool
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

    public function DeleteAuthor($authorId): bool
    {
        try {
            Author::destroy($authorId);
        } catch (Exception $exception) {
            Log::error('Return book error: ' . $exception->getMessage());
            return false;
        }
        return true;
    }

    public function SearchPublisher($filters): ?LengthAwarePaginator
    {
        $query = Publisher::select('id', 'name');

        if(isset($filters['title']) && $filters['title'] != '') {
            $query->where('name', 'like', '%'.$filters['title'].'%');
        }

        if(isset($filters['getAll']) && $filters['getAll']) {
            $filters['pagination'] = ['per_page' => 9999999, 'page' => 1];
        }

        return $query->paginate($filters['pagination']['per_page'], null, null, $filters['pagination']['page']);
    }

    public function AddPublisher($fields): bool
    {
        try {
            Publisher::create($fields);
        } catch (Exception $exception) {
            Log::error('Return book error: ' . $exception->getMessage());
            return false;
        }
        return true;
    }

    public function UpdatePublisher($fields): bool
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

    public function DeletePublisher($publisherId): bool
    {
        try {
            Publisher::destroy($publisherId);
        } catch (Exception $exception) {
            Log::error('Return book error: ' . $exception->getMessage());
            return false;
        }
        return true;
    }

    public function SearchCategories($filters): ?LengthAwarePaginator
    {
        $query = Category::select('id', 'name', 'number')->withCount('Book');

        if(isset($filters['title']) && $filters['title'] != '') {
            $query->where('name', 'like', '%'.$filters['title'].'%');
        }

        if(isset($filters['getAll']) && $filters['getAll']) {
            $filters['pagination'] = ['per_page' => 9999999, 'page' => 1];
        }

        return $query->paginate($filters['pagination']['per_page'], null, null, $filters['pagination']['page']);
    }

    public function AddCategory($fields): bool
    {
        try {
            Category::create($fields);
        } catch (Exception $exception) {
            Log::error('Return book error: ' . $exception->getMessage());
            return false;
        }
        return true;
    }

    public function UpdateCategory($fields): bool
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

    public function DeleteCategory($categoryId): bool
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
