<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function create($id){
        $post = Post::findOrFail($id);
        $comment = request()->all();
        
        Comment::create($comment + ['user_id' => auth()->id(), 'post_id' => $post->id]);

        return back();
    }

    public function destroy(Comment $comment){
        $this->authorize('delete', $comment);
        $comment->delete();

        return back();
    }

    public function edit(Comment $comment){

        $this->authorize('view', $comment);
        
        return view('admin.comments.edit', ['comment' => $comment]);
    }

    public function update(Comment $comment){

        $inputs = request()->validate([
            'comment' => 'required|min:8|max:255',
        ]);

        $comment->title = $inputs['title'];

        $comment->save();

        return redirect()->route('post.index');

    }
}
