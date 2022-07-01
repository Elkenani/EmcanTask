<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Support\Facades\Session;

class PostController extends Controller
{
    //
    public function show(Post $post){
        $comments = Comment::all()->where('post_id',$post->id);
        return view('blog-post', ['post' => $post, 'comments' => $comments]);
    }

    public function create(){
        return view('admin.posts.create');
    }

    public function store(){
        $post = request()->validate([
            'title' => 'required|min:8|max:255',
            'post_image' => 'file',//mimes:jpeg,png this will restrict the file to be those extensions
            'body'  => 'required'
        ]);//saved data in $post array
        
        if(request('post_image')){
            $post['post_image'] = request('post_image')->store('images');//'image' is creating directory if we dont have one
        }

        auth()->user()->posts()->create($post);

        Session::flash('post-created-message', 'Post was created');//flash message

       // return back();//returns no the same page
       return redirect()->route('post.index');

    // dd(request()->all());

    }

    public function index(){
        $posts = auth()->user()->posts()->paginate(3);
        return view('admin.posts.index', ['posts' => $posts]);
    }

    public function AdminIndex(){
        $posts = Post::all()->paginate(3);
        return view('admin.posts.AdminIndex', ['posts' => $posts]);
    }

    public function destroy(Post $post){
        $this->authorize('delete', $post);
        $post->delete();
        Session::flash('message', 'Post was deleted');

        return back();
    }

    public function edit(Post $post){

        $this->authorize('view', $post);
        
        return view('admin.posts.edit', ['post' => $post]);
    }

    public function update(Post $post){

        $inputs = request()->validate([
            'title' => 'required|min:8|max:255',
            'post_image' => 'file',
            'body'  => 'required'
        ]);

        if(request('post_image')){
            $inputs['post_image'] = request('post_image')->store('images');
            $post->post_image = $inputs['post_image'];
        }

        $post->title = $inputs['title'];
        $post->body = $inputs['body'];

        $post->save();
        
        Session::flash('post-updated-message', 'Post was updated');

        return redirect()->route('post.index');

    }
}
