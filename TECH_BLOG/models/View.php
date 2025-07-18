<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class View extends Model
{
    protected $table = 'views';

    protected $fillable = [
        'post_id',
        'ip_address',
        'user_agent',
        'viewed_at'
    ];

    protected $casts = [
        'viewed_at' => 'datetime'
    ];

    // Relationships
    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
