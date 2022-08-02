<?php

namespace App\Http\Controllers;

use App\Models\product;
use App\Models\kategori;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Http\Controllers\Controller;

use DataTables;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = product::all();
        return view('admin.product.index', [
            'title' => 'Data product',
            'template' => 'admin'
        ]);
    }

    public function dataAjax()
    {
        $products = product::where('user_id', auth()->user()->id)->get();

        return DataTables::of($products)
            ->addIndexColumn()
            ->addColumn('name_product', function ($product) {
                return $product->name;
            })
            ->addColumn('kategori', function ($product) {
                return $product->kategori->name;
            })
            ->addColumn('harga', function ($product) {
                return 'Rp. ' . number_format($product->harga, 0, ',', '.');
            })
            ->addColumn('action', function ($product) {
                return '
                        <div class="d-flex justify-content-center w-100">
                            <a href="' . url("dashboard/product/$product->id") . '" class="badge bg-info me-2">
                                <i class="fa fa-info-circle" aria-hidden="true"></i>
                            </a>
                            <a href="' . url("dashboard/product/$product->id/edit") . '" class="badge bg-warning me-2">
                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                            </a>
                            <a href="javascript:void(0)" onclick="deleteThis(' . $product->id . ')" class="badge bg-danger">
                                <i class="fa fa-trash-o" aria-hidden="true"></i>
                            </a>
                        </div>
                    ';
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
        return view('admin.product.create', [
            'title' => 'Tambah product',
            'template' => 'Tambah',
            'kategoris' => kategori::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreproductRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'kategori_id' => 'required',
            'harga' => 'required|numeric',
            'description' => 'required',
            'photo_utama' => 'required|image|file|max:2048'
        ]);
        $photo_deskripsi = $request->file('photo_deskripsi');

        $tmpPhoto = array();
        foreach ($photo_deskripsi as $key => $value) {
            $nameFile = $value->store('image-product');
            // array_push($tmpPhoto, str_replace('public/', '', $nameFile));
            array_push($tmpPhoto, $nameFile);
        }

        $image = $request->file('photo_utama')->store('image-product');

        $validatedData['user_id'] = auth()->user()->id;
        $validatedData['excerpt'] = Str::limit(strip_tags($request->post('description')), 50);
        // $validatedData['photo_utama'] = str_replace('public/', '', $image);
        $validatedData['photo_utama'] = $image;
        $validatedData['photo_deskripsi'] = json_encode($tmpPhoto);
        $validatedData['video'] = $request->post('video');

        product::create($validatedData);
        return redirect('/dashboard/product')->with('success', 'Create new product success');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(product $product)
    {
        return view('admin.product.edit', [
            'title' => 'Edit product',
            'template' => 'Edit',
            'kategoris' => kategori::all(),
            'product' => $product
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateproductRequest  $request
     * @param  \App\Models\product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, product $product)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'kategori_id' => 'required',
            'harga' => 'required|numeric',
            'description' => 'required'
        ]);

        // untuk menghapus deskripsi image
        $arrImage = array();
        $listImage = json_decode($product->photo_deskripsi);
        foreach ($listImage as $key => $value) {
            array_push($arrImage, $value);
        }
        if (isset($request->removeImage)) {
            // untuk menghapus gambar yang lama di dalam file
            foreach ($request->removeImage as $key => $value) {
                Storage::delete($value);
            }
            // Untuk membandingkan 2 array, nilai result nya adalah value yang ga sama
            $result = array_diff($arrImage, $request->removeImage);
            $arrImage = $result;
        }

        // Untuk menambahkan deskripsi image
        if ($request->file('photo_deskripsi')) {
            $photo_deskripsi = $request->file('photo_deskripsi');
            foreach ($photo_deskripsi as $key => $value) {
                $nameFile = $value->store('image-product');
                // array_push($tmpPhoto, str_replace('public/', '', $nameFile));
                array_push($arrImage, $nameFile);
            }
        }

        if ($request->file('photo_utama')) {
            if ($request->oldImage) {
                Storage::delete($request->oldImage);
            }
            $nameFile = $request->file('photo_utama')->store('public/image-product');
            $validatedData['photo_utama'] = str_replace('public/', '', $nameFile);
        }

        $validatedData['photo_deskripsi'] = json_encode($arrImage);
        $validatedData['user_id'] = auth()->user()->id;
        $validatedData['excerpt'] = Str::limit(strip_tags($request->desctiption), 100);

        product::where('id', $product->id)
            ->update($validatedData);

        return redirect('/dashboard/product')->with('success', 'Product has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(product $product)
    {
        if ($product->photo_utama) {
            Storage::delete($product->photo_utama);
        }
        $deskripsiPhoto = json_decode($product->photo_deskripsi);

        foreach ($deskripsiPhoto as $key => $value) {
            Storage::delete($value);
        }
        product::destroy($product->id);
        return 'Product has been deleted';
    }
}
