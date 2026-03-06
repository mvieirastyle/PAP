<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Comment extends Model
{

    protected $fillable = [
        'user_id',
        'post_id',
        'reply_id',
        'content',
    ];

    public static function createComment(array $data = [])
    {
        return Comment::create([
            'user_id' => $data['user_id'],
            'post_id' => $data['post_id'],
            'reply_id' => $data['reply_id'],
            'content' => $data['content'],
        ]);
    }

    public function user()
    {
        // Using the `belongsTo` relationship to get the user who created the post
        return $this->belongsTo(User::class);
    }

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function replies()
    {
        return $this->hasMany(Comment::class, 'reply_id');
    }

    public function parent()
    {
        return $this->belongsTo(Comment::class, 'reply_id');
    }
}
