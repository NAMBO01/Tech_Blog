<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'summary',
        'content',
        'cover_image_url',
        'video_media_id',
        'category_id',
        'field_id',
        'author_id',
        'status',
        'published_at',
        'view_count'
    ];

    protected $casts = [
        'status' => 'string',
        'published_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'view_count' => 'integer'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function field()
    {
        return $this->belongsTo(Field::class);
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function languages()
    {
        return $this->belongsToMany(Language::class, 'post_languages');
    }

    public function revisions()
    {
        return $this->hasMany(PostRevision::class);
    }

    public function video()
    {
        return $this->belongsTo(Media::class, 'video_media_id');
    }

    public function getVideoUrlAttribute()
    {
        return $this->video ? $this->video->file_url : null;
    }

    public function getVideoEmbedUrlAttribute()
    {
        return $this->video ? $this->video->file_url : null;
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }

    public function bookmarks()
    {
        return $this->belongsToMany(User::class, 'bookmarks', 'post_id', 'user_id')->withTimestamps();
    }

    public function getAverageRatingAttribute()
    {
        return $this->ratings()->avg('rating');
    }

    public function getRatingsCountAttribute()
    {
        return $this->ratings()->count();
    }

    public function getIsBookmarkedAttribute()
    {
        if (!auth()->check()) {
            return false;
        }
        return $this->bookmarks()->where('user_id', auth()->id())->exists();
    }
}
