<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    protected $table = 'languages';

    protected $fillable = [
        'name',
        'code',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean'
    ];

    // Relationships
    public function posts()
    {
        return $this->belongsToMany(Post::class, 'post_languages');
    }
}
