<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'number', 'description'];
    public function Book(): HasMany
    {
        return $this->hasMany(Book::class);
    }

    protected function name(): Attribute
    {
        return Attribute::make(
            get: fn (?string $value) => $value ? ucfirst($value) : "",
            set: fn (string $value) => strtolower($value),
        );
    }
}
