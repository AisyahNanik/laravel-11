<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() : View
    {
        //get all posts
        $posts = Post::paginate(10);

        //render view with posts
        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() : View
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request): RedirectResponse
    {
        

        //upload image
        $image = $request->file('image');
        $image->storeAs('public/post', $image->hashName());

        //create post
        Post::create([
            'image'    => $image->hashName(),
            'title'    => $request->title,
            'content'  => $request->content,
            'reporter' => $request->reporter,
            'source'   => $request->source
        ]);

        //redirect to index
        return redirect()->route('posts.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    
    /**
     * Display the specified resource.
     */
    public function show(Post $id) : View
    {
        //get post by id
        $post = Post::findorFail($id);

        //render view with post
        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //
    }
}
