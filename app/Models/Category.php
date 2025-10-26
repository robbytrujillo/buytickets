<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
// use Illuminate\Support\Facades\Storage;
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
        'icon',
        'icon_white'
    ];

    public function setNameAttribute($value) {
        $this->attributes['name'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    // public function getIconUrlAttribute()
    // {
    //     return $this->icon ? Storage::disk('public')->url($this->icon) : null;
    // }

    public function tickets(): HasMany {
        return $this->hasMany(Ticket::class);
    }
}