<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserDetails extends Model
{
    use HasFactory;


    protected $fillable = [
        'user_id',
        'identity_number',
        'first_name',
        'last_name',
        'address',
        'phone',
        'occupation',
        'birth_date',
    ];
    public function User(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
