<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PostRevision extends Model
{
    protected $table = 'post_revisions';
    public $timestamps = false;

    protected $fillable = [
        'post_id',
        'content',
        'revision_number',
        'edited_by',
        'edited_at'
    ];

    protected $casts = [
        'edited_at' => 'datetime'
    ];

    // Relationships
    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function editor()
    {
        return $this->belongsTo(User::class, 'edited_by');
    }
}
