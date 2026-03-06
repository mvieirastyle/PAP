<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Interaction extends Model
{
     protected $fillable = [
        'user_id', 
        'post_id',
        'type', 
    ];

     public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
