<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'author',
        'category_id',
        'year',
        'price',
        'image',
        'quantity',
        'publisher_id',
        'is_recommended'
    ];

    protected $casts = [
        'is_recommended' => 'boolean',
    ];
    public function Transaction(): HasMany
    {
        return $this->hasMany(Transactions::class);
    }
    public function Category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function Authors(): BelongsToMany
    {
        return $this->belongsToMany(Author::class, 'book_authors');
    }
}

