<?php

namespace App\Http\Controllers;

use App\Models\Nilai;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class NilaiController extends Controller
{
    public function index() : View
    {
        $nilais = Nilai::paginate(10);

        return view('nilais.index', compact('nilais'));
    }
     /**
     * create
     *
     * @return View
     */
    public function create(): View
    {
        return view('nilais.create');
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
            'basdon'         => 'required|numeric',
            'basing'         => 'required|numeric',
            'matematika'     => 'required|numeric',
            'ipa'            => 'required|numeric',
            'ips'            => 'required|numeric',
        ]);

        //create nilai
        Nilai::create([
            'basdon'         => $request->basdon,
            'basing'         => $request->basing,
            'matematika'     => $request->matematika,
            'ipa'            => $request->ipa,
            'ips'            => $request->ips,
        ]);

        //redirect to index
        return redirect()->route('nilais.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }
}
