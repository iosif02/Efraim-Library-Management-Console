<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'author',
        'category',
        'year',
        'price',
        'image',
        'quantity',
        'publisher_id'
    ];
    public function Transaction(): HasMany
    {
        return $this->hasMany(Transactions::class);
    }
    public function Category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
    public function BookAuthor(): HasMany
    {
        return $this->hasMany(BookAuthor::class);
    }

    public function Author()
    {
        return $this->hasManyThrough(Author::class, BookAuthor::class);
    }
}

