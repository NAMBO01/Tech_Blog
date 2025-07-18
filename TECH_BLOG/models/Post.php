<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Post extends Model
{
    protected $table = 'posts';

    protected $fillable = [
        'title',
        'slug',
        'summary',
        'content',
        'cover_image_url',
        'category_id',
        'field_id',
        'author_id',
        'status',
        'published_at',
        'view_count'
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'view_count' => 'integer'
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function field(): BelongsTo
    {
        return $this->belongsTo(Field::class);
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class, 'post_tag');
    }

    public function languages(): BelongsToMany
    {
        return $this->belongsToMany(Language::class, 'post_languages');
    }

    public function revisions(): HasMany
    {
        return $this->hasMany(PostRevision::class);
    }

    public function views(): HasMany
    {
        return $this->hasMany(View::class);
    }
}
