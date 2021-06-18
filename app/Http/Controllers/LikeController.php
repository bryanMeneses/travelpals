<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Post $post, Request $request)
    {
        if ($post->likedBy(auth()->user())) {
            return back()->with('error-msg', 'You cannot like a post more than once.');
        }

        $post->likes()->create([
            'user_id' => auth()->user()->id,
        ]);

        return back()->with('success-msg', 'You liked ' . ucwords($post->user->name) . '\'s post!');
    }

    public function destroy(Post $post, Request $request)
    {
        auth()->user()->likes()->where('post_id', $post->id)->delete();

        return back()->with('success-msg', 'You disliked the post.');
    }
}
