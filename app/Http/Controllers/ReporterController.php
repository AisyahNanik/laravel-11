<?php

namespace App\Http\Controllers;

use App\Models\Reporter;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ReporterController extends Controller
{
    public function index() : view{
        $reporters = Reporter::paginate(10);

        return view('reporters.index', compact('reporters'));
    }
     /**
     * create
     *
     * @return View
     */
    public function create(): View
    {
        return view('reporters.create');
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
            'name'         => 'required|min:5',
            'email'        => 'required|min:10',
            'phone'        => 'required|numeric',
            'address'      => 'required|min:5',
            'age'          => 'required|numeric',
            'photo'        => 'required|image|mimes:jpeg,jpg,png|max:2048'
        ]);

        //upload phot
        $photo = $request->file('photo');
        $photo->storeAs('public/reporters', $photo->hashName());

        //create product
        Reporter::create([
            'name'         => $request->name,
            'email'        => $request->email,
            'phone'        => $request->phone,
            'address'      => $request->address,
            'age'          => $request->age,
            'photo'        => $photo->hashName(),
        ]);

        //redirect to index
        return redirect()->route('reporters.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }
}
