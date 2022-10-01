<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transactions extends Model
{
    use HasFactory;

    protected $fillable = ['borrow_date', 'is_returned', 'return_date', 'book', 'reader'];

    public function Book()
    {
        return $this->hasOne(Book::class);
    }

    public function Reader()
    {
        return $this->hasOne(User::class);
    }
}
