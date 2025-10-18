<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    //
    use HasFactory, SoftDeletes;

    // mass assigment
    protected $fillable = [
        'name',
        'slug',
        'icon'
    ];

    public function tickets(): HasMany {
        return $this->hasMany(Ticket::class);
    }
}