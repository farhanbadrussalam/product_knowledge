<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\kategori;

use Illuminate\Http\Request;

use DataTables;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.kategori.index', [
            'title' => 'Kategori',
            'template' => 'admin'
        ]);
    }

    public function dataAjax()
    {
        $kategoris = kategori::all();
        return DataTables::of($kategoris)
            ->addIndexColumn()
            ->addColumn('action', function ($kategori) {
                return "
                        <div class='d-flex justify-content-center w-100'>
                            <a href='javascript:void(0)' onclick='editData(this)' data-item='$kategori' class='badge bg-warning me-2'>
                                <i class='fa fa-pencil-square-o' aria-hidden='true'></i>
                            </a>
                            <a href='javascript:void(0)' onclick='deleteData($kategori->id)' class='badge bg-danger'>
                                <i class='fa fa-trash-o' aria-hidden='true'></i>
                            </a>
                        </div>
                    ";
            })
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreKategoriRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required'
        ]);

        $validatedData['slug'] = '';

        kategori::create($validatedData);

        return redirect('/dashboard/kategori')->with('success', 'Create new kategori success');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kategori  $kategori
     * @return \Illuminate\Http\Response
     */
    public function show(Kategori $kategori)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kategori  $kategori
     * @return \Illuminate\Http\Response
     */
    public function edit(Kategori $kategori)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateKategoriRequest  $request
     * @param  \App\Models\Kategori  $kategori
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kategori $kategori)
    {
        $validatedData = $request->validate([
            'name' => 'required'
        ]);

        kategori::where('id', $kategori->id)
            ->update($validatedData);

        return redirect('/dashboard/kategori')->with('success', 'Update kategori success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kategori  $kategori
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kategori $kategori)
    {
        kategori::destroy($kategori->id);
        return 'Kategori has been deleted';
    }
}
