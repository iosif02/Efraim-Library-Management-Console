<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transactions extends Model
{
    use HasFactory;


    protected $casts = [
        'is_returned' => 'boolean',
    ];
    protected $fillable = ['borrow_date', 'is_returned', 'return_date', 'book_id', 'user_id', 'lender_name', 'receiver_name'];

    public function Book(): BelongsTo
    {
        return $this->belongsTo(Book::class);
    }

    public function User(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function UserDetails(): BelongsTo
    {
        return $this->belongsTo(UserDetails::class, 'user_id', 'user_id');
    }

    protected $appends = ['delayed'];

    protected function delayed(): Attribute
    {
        return Attribute::make(
            get: function() {
//                $start = strtotime($this->return_date);
//                $end = strtotime(now('Europe/Bucharest'));
//                return (int)(($start - $end)/86400);
//                return $this->return_date->diffInDays(Carbon::now('Europe/Bucharest'));
//                return Carbon::now('Europe/Bucharest')->diffInDays($this->return_date, false);

                $now = Carbon::now('Europe/Bucharest');
                return $now->diffInDays($this->return_date, false);

            },
        );
    }

}
