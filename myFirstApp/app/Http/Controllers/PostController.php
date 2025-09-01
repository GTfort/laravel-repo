<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    //
    public function showCreatePostForm()
    {

        return view('create-post');
    }

    public function storeNewPost(Request $request)
    {
        $incomingFields = $request->validate([
            'title' => 'required|max:255',
            'body' => 'required'
        ]);
        $incomingFields['title'] = strip_tags($incomingFields['title']);
        $incomingFields['body'] = strip_tags($incomingFields['body']);
        $incomingFields['user_id'] = Auth::id();

        $newPost = Post::create($incomingFields);
        //
        return redirect("/post/{$newPost->id}")->with('success', 'New post successfully created.');
    }

    public function viewSinglePost($id)
    {

        $post = Post::find($id);
        if (!$post) {
            return redirect('/')->with('failure', 'Post not found.');
        }
        $post['body'] = Str::markdown($post->body);

        return view('single-post', ['post' => $post]);
    }
}
