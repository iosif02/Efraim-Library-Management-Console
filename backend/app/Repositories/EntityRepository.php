<?php

namespace App\Repositories;

use App\Models\Author;
use App\Models\Category;
use App\Models\Publisher;

class EntityRepository implements IEntityRepository
{
    public function SearchAuthors($filters) {
        $query = Author::select('id', 'name');

        if(isset($filters['name']) && $filters['name'] != '') {
            $query->where('name', 'like', '%'.$filters['name'].'%');
        }

        if(isset($filters['pagination']['per_page']) && isset($filters['pagination']['page']))
            return $query->paginate($filters['pagination']['per_page'], null, null, $filters['pagination']['page']);

        return $query->get();
    }

    public function AddAuthor($fields)
    {
        return Author::create($fields);
    }

    public function UpdateAuthor($fields)
    {
        $author = Author::find($fields['authorId']);
        $author->fill($fields);
        $author->update();
        return $author;
    }

    public function DeleteAuthor($authorId): int
    {
        return Author::destroy($authorId);
    }

    public function SearchPublisher($filters)
    {
        $query = Publisher::select('id', 'name');

        if(isset($filters['name']) && $filters['name'] != '') {
            $query->where('name', 'like', '%'.$filters['name'].'%');
        }

        if(isset($filters['pagination']['per_page']) && isset($filters['pagination']['page']))
            return $query->paginate($filters['pagination']['per_page'], null, null, $filters['pagination']['page']);

        return $query->get();
    }

    public function AddPublisher($fields)
    {
        return Publisher::create($fields);
    }

    public function UpdatePublisher($fields)
    {
        $publisher = Publisher::find($fields['publisherId']);
        $publisher->fill($fields);
        $publisher->update();
        return $publisher;
    }

    public function DeletePublisher($publisherId): int
    {
        return Publisher::destroy($publisherId);
    }

    public function SearchCategories($filters)
    {
        $query = Category::select('id', 'name', 'number')->withCount('Book');

        if(isset($filters['name']) && $filters['name'] != '') {
            $query->where('name', 'like', '%'.$filters['name'].'%');
        }

        if(isset($filters['pagination']['per_page']) && isset($filters['pagination']['page']))
            return $query->paginate($filters['pagination']['per_page'], null, null, $filters['pagination']['page']);

        return $query->get();
    }

    public function AddCategory($fields)
    {
        return Category::create($fields);
    }

    public function UpdateCategory($fields)
    {
        $category = Category::find($fields['categoryId']);
        $category->fill($fields);
        $category->update();
        return $category;
    }

    public function DeleteCategory($categoryId)
    {
        return Category::destroy($categoryId);
    }
}
