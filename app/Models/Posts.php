<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Events\NewPost;

class Posts extends Model
{
    protected $guarded = [];

    protected $dispatchesEvents = [

      'created' => NewPost::class,

    ];
    use HasFactory;
    protected $fillable = [
        'user_id',
        'title',
        'description',
        'likes_count',
        'dislikes_count',
        'comments_count'
    ];

}
