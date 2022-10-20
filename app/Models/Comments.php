<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Events\GetComments;

class Comments extends Model
{
    protected $guarded = [];

    protected $dispatchesEvents = [

      'created' => GetComments::class,

    ];
    use HasFactory;
    protected $fillable = [
        'description',
        'user_id',
        'post_id',
        'reply_id',
        'likes_count',
        'dislikes_count'
    ];

}
