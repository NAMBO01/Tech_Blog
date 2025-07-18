<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    use HasFactory;

    protected $table = 'media';

    protected $fillable = [
        'file_url',
        'file_type',
        'uploaded_by'
    ];

    protected $casts = [
        'uploaded_at' => 'datetime'
    ];

    public function uploader()
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }

    public function posts()
    {
        return $this->hasMany(Post::class, 'video_media_id');
    }
}
