<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class View extends Model
{
    use HasFactory;

    protected $table = 'views';

    protected $fillable = [
        'post_id',
        'view_count',
        'last_viewed_at',
    ];

    public $timestamps = false;
}
