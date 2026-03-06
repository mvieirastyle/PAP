<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Storage;

class Post extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'content',
        'description',
        'created_at',
        'updated_at',
    ];

    public static function createNew(array $data = [], int $id)
    {
        $user = User::findOrFail($id);

        return self::create([
            'user_id' => $user->id,
            'title' => $data['title'],
            'description' => $data['description'],
            'content' => $data['content'],
        ]);
    }

    public static function deletePost(int $id)
    {

        $post = self::findOrFail($id);
        $comments = Comment::where('post_id', $id)->latest()->get();

        foreach ($comments as $comment) {
            $comment->delete();
        }

        $post->delete();
    }

    public static function updatePost(int $id, array $data)
    {
        $post = self::findOrFail($id);

        return $post->update([
            'title' => $data['title'],
            'content' => $data['content'],
            'description' => $data['description'],
        ]);
    }

    public function user()
    {
        // Using the `belongsTo` relationship to get the user who created the post
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        // Using the `hasMany` relationship to get all comments for a post
        return $this->hasMany(Comment::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function tags()
    {
        // Using the `belongsToMany` relationship to get all tags associated with a post
        return $this->belongsToMany(Tag::class);
    }

    public function isLikedByUser()
    {
        if (!Auth::check()) {
            return false;
        }

        return $this->likes()
            ->where('user_id', Auth::id())
            ->exists();
    }
}
