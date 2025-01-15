<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
     /**
     * index
     *
     * @return void
     */
    public function index() : View
    {
        //get all review
        $reviews = Review::paginate(10);

        //render view with reviews
        return view('reviews.index', compact('reviews'));
    }
      /**
     * create
     *
     * @return View
     */
    public function create(): View
    {
        return view('reviews.create');
    }

    /**
     * store
     *
     * @param  mixed $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
       
        Review::create([
            'product_id'      => $request->product_id,           
            'content'         => $request->content,
            'user_id'         => Auth::id(),

        ]);
        
        //redirect to index
        return redirect()->route('products.show', $request->product_id)->with(['success' => 'Data Berhasil Disimpan!']);
    }
}
