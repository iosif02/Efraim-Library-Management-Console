<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Transactions extends Model
{
    use HasFactory;

    protected $fillable = ['borrow_date', 'is_returned', 'return_date', 'book_id', 'user_id'];

    public function Book(): BelongsTo
    {
        return $this->belongsTo(Book::class);
    }

    public function User(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

}
