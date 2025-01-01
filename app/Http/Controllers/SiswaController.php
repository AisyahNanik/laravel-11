<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    /**
     * index
     * @return void
     */
    public function index() : View
    {
        //get all siswas
        $siswas = Siswa::paginate(10);

        //render view with siswas
        return view('siswas.index', compact('siswas'));
    }

     /**
     * create
     *
     * @return View
     */
    public function create(): View
    {
        return view('siswas.create');
    }

    /**
     * siswa
     *
     * @param  mixed $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        //validate form
        $request->validate([
            'image'   => 'required|image|mimes:jpeg,jpg,png|max:2048',
            'name'    => 'required|min:3',
            'email'   => 'required|min:10',
            'address' => 'required|min:5',
            'phone'   => 'required|numeric'
        ]);

        //upload image
        $image = $request->file('image');
        $image->storeAs('public/siswas', $image->hashName());

        //create data of siswa
        Siswa::create([
            'image'   => $image->hashName(),
            'name'    => $request->name,
            'email'   => $request->email,
            'address' => $request->address,
            'phone'   => $request->phone
        ]);

        //redirect to index
        return redirect()->route('siswas.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

     /**
     * show
     *
     * @param  mixed $id
     * @return View
     */
    public function show(string $id): View
    {
        //get siswa by ID
        $siswa = Siswa::findOrFail($id);

        //render view with siswa
        return view('siswas.show', compact('siswa'));
    }

}