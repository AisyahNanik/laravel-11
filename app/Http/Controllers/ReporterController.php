<?php

namespace App\Http\Controllers;

use App\Models\Reporter;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
    /**
     * show
     *
     * @param  mixed $id
     * @return View
     */
    public function show(string $id): View
    {
        //get reporter by ID
        $reporter = Reporter::findOrFail($id);

        //render view with reporter
        return view('reporters.show', compact('reporter'));
    }
     /**
     * edit
     *
     * @param  mixed $id
     * @return View
     */
    public function edit(string $id): View
    {
        //get reporter by ID
        $reporter = Reporter::findOrFail($id);

        //render view with reporter
        return view('reporters.edit', compact('reporter'));
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
            'name'         => 'required|min:5',
            'email'        => 'required|min:10',
            'phone'        => 'required|numeric',
            'address'      => 'required|min:5',
            'age'          => 'required|numeric',
            'photo'        => 'required|image|mimes:jpeg,jpg,png|max:2048'
        ]);

        //get reporter by ID
        $reporter = Reporter::findOrFail($id);

        //check if photo is uploaded
        if ($request->hasFile('photo')) {

            //upload new photo
            $photo = $request->file('photo');
            $photo->storeAs('public/reporters', $photo->hashName());

            //delete old reporter
            Storage::delete('public/reporters/'.$reporter->photo);

            //update product with new photo
            $reporter->update([
                'name'         => $request->name,
                'email'        => $request->email,
                'phone'        => $request->phone,
                'address'      => $request->address,
                'age'          => $request->age,
                'photo'        => $photo->hashName(),
            ]);

        } else {

            //update product without photo
            $reporter->update([
                'name'         => $request->name,
                'email'        => $request->email,
                'phone'        => $request->phone,
                'address'      => $request->address,
                'age'          => $request->age,
            ]);
        }

        //redirect to index
        return redirect()->route('reporters.index')->with(['success' => 'Data Berhasil Diubah!']);
    }
    /**
     * destroy
     *
     * @param  mixed $id
     * @return RedirectResponse
     */
    public function destroy($id): RedirectResponse
    {
        //get reporter by ID
        $reporter = Reporter::findOrFail($id);

        //delete photo
        Storage::delete('public/reporters/'. $reporter->photo);

        //delete reporter
        $reporter->delete();

        //redirect to index
        return redirect()->route('reporters.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
