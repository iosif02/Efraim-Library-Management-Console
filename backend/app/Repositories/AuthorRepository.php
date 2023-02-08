<?php

namespace App\Repositories;

use App\Models\Author;
use App\Models\Publisher;

class AuthorRepository implements IAuthorRepository
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
}
