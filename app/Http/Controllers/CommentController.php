<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class CommentController extends Controller
{
     /**
     * index
     *
     * @return void
     */
    public function index() : View
    {
        //get all comments
        $comments = Comment::paginate(10);

        //render view with comments
        return view('comments.index', compact('comments'));
    }
      /**
     * create
     *
     * @return View
     */
    public function create(): View
    {
        return view('comments.create');
    }

    /**
     * store
     *
     * @param  mixed $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        //validate form
        $request->validate([
            'photo'        => 'required|image|mimes:jpeg,jpg,png|max:2048',
            'name'         => 'required|min:5',
            'email'        => 'required|min:10',
            'phone'        => 'required|numeric',
            'address'      => 'required|min:5',
            'review'       => 'required|min:5'
        ]);

        //upload photo
        $photo = $request->file('photo');
        $photo->storeAs('public/comments', $photo->hashName());

        //create comment
        Comment::create([
            'photo'        => $photo->hashName(),
            'name'         => $request->name,
            'email'        => $request->email,
            'phone'        => $request->phone,
            'address'      => $request->address,
            'review'       => $request->review
        ]);

        //redirect to index
        return redirect()->route('comments.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

     /**
     * show
     *
     * @param  mixed $id
     * @return View
     */
    public function show(string $id): View
    {
        //get comment by ID
        $comment = Comment::findOrFail($id);

        //render view with comment
        return view('comments.show', compact('comment'));
    }

    /**
     * edit
     *
     * @param  mixed $id
     * @return View
     */
    public function edit(string $id): View
    {
        //get comment by ID
        $comment = Comment::findOrFail($id);

        //render view with comment
        return view('comments.edit', compact('comment'));
    }
        
    /**
     * update
     *
     * @param  mixed $request
     * @param  mixed $id
     * @return RedirectResponse
     */
    public function update(Request $request, $id): RedirectResponse
    {
        //validate form
        $request->validate([
            'photo'        => 'required|image|mimes:jpeg,jpg,png|max:2048',
            'name'         => 'required|min:5',
            'email'        => 'required|min:10',
            'phone'        => 'required|numeric',
            'address'      => 'required|min:5',
            'review'       => 'required|min:5'
        ]);

        //get  by ID
        $comment = Comment::findOrFail($id);

        //check if photo is uploaded
        if ($request->hasFile('photo')) {

            //upload new photo
            $photo = $request->file('photo');
            $photo->storeAs('public/comments', $photo->hashName());

            //delete old photo
            Storage::delete('public/comments/'.$comment->photo);

            //update comment with new photo
            $comment->update([
                'photo'        => $photo->hashName(),
                'name'         => $request->name,
                'email'        => $request->email,
                'phone'        => $request->phone,
                'address'      => $request->address,
                'review'       => $request->review
            ]);

        } else {

            //update comment without photo
            $comment->update([
                'name'         => $request->name,
                'email'        => $request->email,
                'phone'        => $request->phone,
                'address'      => $request->address,
                'review'       => $request->review
            ]);
        }

        //redirect to index
        return redirect()->route('comments.index')->with(['success' => 'Data Berhasil Diubah!']);
    }
    /**
     * destroy
     *
     * @param  mixed $id
     * @return RedirectResponse
     */
    public function destroy($id): RedirectResponse
    {
        //get comment by ID
        $comment = Comment::findOrFail($id);

        //delete photo
        Storage::delete('public/comments/'. $comment->photo);

        //delete comment
        $comment->delete();

        //redirect to index
        return redirect()->route('comments.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
