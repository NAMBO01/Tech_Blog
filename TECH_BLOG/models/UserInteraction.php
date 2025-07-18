<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserInteraction extends Model
{
    protected $table = 'user_interactions';

    protected $fillable = [
        'user_id',
        'post_id',
        'interaction_type',
        'created_at'
    ];

    protected $casts = [
        'created_at' => 'datetime'
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
