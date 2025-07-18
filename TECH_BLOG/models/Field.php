<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Field extends Model
{
    protected $table = 'fields';

    protected $fillable = [
        'name',
        'slug',
        'description',
        'status'
    ];

    protected $casts = [
        'status' => 'boolean'
    ];

    // Relationships
    public function categories()
    {
        return $this->hasMany(Category::class);
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
