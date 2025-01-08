<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'post_id',
        'content',
        'author',
        'photo',
        'name',
        'email',
        'phone',
        'address',
        'review',
    ];
     // Relasi ke Post
     public function post()
     {
         return $this->belongsTo(Post::class);
     }
}
