<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    protected $table = 'media';

    protected $fillable = [
        'file_url',
        'file_type',
        'uploaded_by'
    ];

    protected $casts = [
        'uploaded_at' => 'datetime'
    ];

    // Relationships
    public function uploader()
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }
}
