<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserDetails extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'identity_number',
        'address',
        'phone',
        'occupation',
        'birth_date',
        'photo_url'
    ];
    public function User(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
