<?php

namespace App\Http\Controllers;

use Jorenvh\Share\ShareFacade as Share;
use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class PostController extends Controller
{
    public function show(): View
    {
        $user = User::class;
        $posts = Post::All();
        return view('pages.blog.index', [
            'posts' => $posts,
            'user' => $user,
        ]);
    }

    public function showAdd(): View
    {
        return view('pages.blog.new_post');
    }

    public function showPost(int $id)
    {
        $comments = Comment::where('post_id', $id)->latest()->get();
        $post = Post::find($id);

        $url = url('/blog/post/' . $post->id);

        $shareLinks = Share::page(
            $url,
            $post->title
        )->facebook()->twitter()->whatsapp();



        return view('pages.blog.post', [
            'post' => $post,
            'comments' => $comments,
            'shareLinks' => $shareLinks,
        ]);
    }

    public function add(Request $request, int $id)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'description' => 'required',
        ]);

        Post::createNew($request->all(), $id);

        return redirect('/blog');
    }

    public function uploadImage(Request $request)
    {
        $request->validate([
            'image' => 'required | image | max: 2048',
        ]);

        $path = $request->file('image')->store('images', 'public');

        return response()->json([
            'url' => Storage::url($path),
        ]);
    }


    public function delete(int $id)
    {
        Post::deletePost($id);

        return redirect('/blog');
    }

    public function showEdit(int $postId)
    {
        $post = Post::all()->find($postId);
        return view('pages.blog.edit', [
            'post' => $post,
        ]);
    }

    public function edit(Request $request, int $id)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'description' => 'required',
        ]);

        Post::updatePost($id, $request->all());

        return redirect('/blog')->with('success', 'Sua publicação foi editada com sucesso');
    }
}
