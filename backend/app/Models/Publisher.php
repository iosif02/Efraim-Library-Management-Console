<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Publisher extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'city'];
    protected $dates = ['deleted_at'];

    public function getDisplayNameAttribute()
    {
        return $this->attributes['name'] .', '. $this->attributes['city'];
    }

    public function Books()
    {
        return $this->hasMany(Publisher::class);
    }
}
