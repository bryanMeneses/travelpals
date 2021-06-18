<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Post $post, Request $request)
    {

        // dd($request->all());

        // We are bringing in the post id to validate only the post to which the comment section belongs.
        // Otherwise it will validate all the forms with textarea name of "comment"
        $this->validate($request, [
            'comment-' . $post->id => 'required|max:255'
        ], [
            'required' => 'Cannot be empty.'
        ]);

        auth()->user()->comments()->create([
            'post_id' => $post->id,
            'comment' => $request['comment-' . $post->id]
        ]);

        return back()->with('success-msg', 'You succesfully commented on ' . ucwords($post->user->name) . '\'s post.');
    }

    public function destroy(Comment $comment, Request $request)
    {
        if ($comment->user_id == auth()->user()->id) {
            $comment->delete();
            return back()->with('success-msg', 'Comment was succesfully deleted.');
        } else {
            return back();
        }
    }
}
