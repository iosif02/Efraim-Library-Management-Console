<?php

namespace App\Repositories;

use App\Models\Author;

class AuthorRepository implements IAuthorRepository
{
    public function SearchAuthors($filters) {
        $query = Author::select('id', 'name');

        if(isset($filters['name']) && $filters['name'] != '') {
            $query->where('name', 'like', '%'.$filters['name'].'%');
        }

        return $query->paginate($filters['pagination']['per_page'], null, null, $filters['pagination']['page']);
    }
}
