<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Events\NewPost;

class Reactions extends Model
{
    protected $guarded = [];

    use HasFactory;
    protected $fillable = [
        'user_id',
        'post_id',
        'comment_id',
        'like_dislike'
    ];

}
