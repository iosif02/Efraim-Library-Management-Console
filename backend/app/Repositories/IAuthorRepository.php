<?php

namespace App\Repositories;

interface IAuthorRepository
{
    public function SearchAuthors($filters);
    public function SearchPublisher($filters);
}
