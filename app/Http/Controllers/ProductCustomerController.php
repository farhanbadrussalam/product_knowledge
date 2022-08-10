<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Models\product;
use App\Models\kategori;
use App\Models\customer;
use App\Models\booking;

use App\Http\Controllers\Controller;
use App\Mail\NotifyMail;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;

class ProductCustomerController extends Controller
{
    public function index()
    {
        $products = product::latest()
            ->filter(request(['pencarian', 'kategori']))
            ->paginate(12)
            ->withQueryString();

        $dataKeranjang = array();

        if (session()->has('dataCustomer')) {
            $data = session('dataCustomer')[0];

            $dataKeranjang = booking::where('customer_id', $data->id)->get();
        }

        return view('productCustomer.index', [
            'title' => 'Product',
            'template' => 'view-product',
            'kategoris' => kategori::all(),
            'products' => $products,
            'dataKeranjang' => $dataKeranjang
        ]);
    }

    public function detail($id)
    {
        $product = product::where('id', $id)->first();

        $dataKeranjang = array();

        if (session()->has('dataCustomer')) {
            $data = session('dataCustomer')[0];

            $dataKeranjang = booking::where('customer_id', $data->id)->get();
        }

        return view('productCustomer.detail', [
            'title' => 'detail-product',
            'template' => 'view-product',
            'product' => $product,
            'dataKeranjang' => $dataKeranjang
        ]);
    }

    public function generateToken(Request $request)
    {
        $token = Str::random(7);
        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['token_id'] = $token;
        $data['alamat'] = $request->alamat;

        $datenow = now();
        $date = Carbon::createFromFormat('Y-m-d', $datenow->format('Y-m-d'))->addMonth();

        $data['limit'] = $date->format('Y-m-d');

        customer::create($data);

        $details = [
            'title' => 'Berikut Token ID Anda',
            'body' => $token
        ];

        // send mail
        Mail::to($request->email)->send(new NotifyMail($details));

        if (Mail::failures()) {
            return response()->Fail('Sorry! Please try again latter');
        } else {
            return redirect('product-customer')->with('success', [
                'status' => 200,
                'token' => $token,
                'message' => 'Token berhasil di buat'
            ]);
        }
    }

    public function searchToken(Request $request)
    {
        $token = $request->tokenId;

        $data = customer::where('token_id', $token)->first();

        if ($data) {
            $datenow = now()->getTimestamp();
            $limit = strtotime($data->limit);

            if ($datenow < $limit) {
                $request->session()->regenerate();

                $request->session()->push('dataCustomer', $data);

                return redirect('product-customer');
            } else {
                return redirect('product-customer')->with('error', 'Token invalid');
            }
        }
        return redirect('product-customer')->with('error', 'Token invalid');
    }

    public function logout(Request $request)
    {
        $request->session()->invalidate();
        $request->session()->regenerate();

        return redirect('/');
    }

    public function orderProduct(Request $request)
    {
        $idProduct = $request->idProduct;
        $qty = $request->qtyProduct;
        $total = $request->postGrandTotal;
        $customer = session('dataCustomer')[0];

        $data['customer_id'] = $customer->id;
        $data['product_id'] = $idProduct;
        $data['qty'] = $qty;
        $data['price'] = $total;

        booking::create($data);

        return redirect('product-customer');
    }
}
