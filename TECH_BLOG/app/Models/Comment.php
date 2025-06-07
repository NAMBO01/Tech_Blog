<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $table = 'comments';

    protected $fillable = [
        'post_id',
        'user_id',
        'parent_id',
        'content',
        'status',
        'created_at',
        'updated_at'
    ];

    // Quan hệ với bài viết
    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    // Quan hệ với người dùng
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Quan hệ với comment cha
    public function parent()
    {
        return $this->belongsTo(Comment::class, 'parent_id');
    }

    // Quan hệ với các comment con
    public function replies()
    {
        return $this->hasMany(Comment::class, 'parent_id');
    }
}
