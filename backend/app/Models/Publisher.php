<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Publisher extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'city'];
    protected $dates = ['deleted_at'];

    public function Book(): HasOne
    {
        return $this->hasOne(Book::class);
    }

    public function getDisplayNameAttribute(): string
    {
        return $this->attributes['name'] .', '. $this->attributes['city'];
    }
}
