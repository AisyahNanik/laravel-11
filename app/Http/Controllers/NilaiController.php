<?php

namespace App\Http\Controllers;

use App\Models\Nilai;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
    /**
     * show
     *
     * @param  mixed $id
     * @return View
     */
    public function show(string $id): View
    {
        //get nilai by ID
        $nilai = Nilai::findOrFail($id);

        //render view with nilai
        return view('nilais.show', compact('nilai'));
    }
     /**
     * edit
     *
     * @param  mixed $id
     * @return View
     */
    public function edit(string $id): View
    {
        //get nilai by ID
        $nilai = Nilai::findOrFail($id);

        //render view with nilai
        return view('nilais.edit', compact('nilai'));
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
            'basdon'         => 'required|numeric',
            'basing'         => 'required|numeric',
            'matematika'     => 'required|numeric',
            'ipa'            => 'required|numeric',
            'ips'            => 'required|numeric',
        ]);

        
    // Mendapatkan nilai berdasarkan ID
    $nilai = Nilai::findOrFail($id);

    // Update nilai tanpa mengupdate gambar
    $nilai->update([
        'basdon'         => $request->basdon,
        'basing'         => $request->basing,
        'matematika'     => $request->matematika,
        'ipa'            => $request->ipa,
        'ips'            => $request->ips,
    ]);

        //redirect to index
        return redirect()->route('nilais.index')->with(['success' => 'Data Berhasil Diubah!']);
    }
    /**
     * destroy
     *
     * @param  mixed $id
     * @return RedirectResponse
     */
    public function destroy($id): RedirectResponse
    {
        //get nilai by ID
        $nilai = Nilai::findOrFail($id);

        //delete nilai
        $nilai->delete();

        //redirect to index
        return redirect()->route('nilais.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
