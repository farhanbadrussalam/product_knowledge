@extends('layouts.main')

@section('container')
<div class="row g-0 mt-2">
    <div class="col-md-4 col-xxl-4 mb-3 pe-md-2 shadow">
        <div class="card h-md-100 ecommerce-card-min-width">
            <div class="card-header pb-0">
                <h4 class="mt-2 d-flex align-items-center justify-content-center">
                    Jumlah Customer
                    <span class="ms-1 text-400" data-bs-toggle="tooltip" data-bs-placement="top" title="Pelamar"><span class="fas fa-user-friends" data-fa-transform="shrink-1"></span></span>
                </h4>
            </div>
            <div class="card-body d-flex flex-column justify-content-end">
                <div class="row text-center">
                    <div class="col">
                        <p class="font-sans-serif lh-1 mb-1 fs-4">{{ count($customer) }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4 col-xxl-4 mb-3 pe-md-2 shadow">
        <div class="card h-md-100 ecommerce-card-min-width">
            <div class="card-header pb-0">
                <h4 class="mt-2 d-flex align-items-center justify-content-center">
                    Jumlah pemesanan
                </h4>
            </div>
            <div class="card-body d-flex flex-column justify-content-end">
                <div class="row text-center">
                    <div class="col">
                        <p class="font-sans-serif lh-1 mb-1 fs-4 text-success">{{ count($pemesanan) }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4 col-xxl-4 mb-3 shadow">
        <div class="card h-md-100 ecommerce-card-min-width">
            <div class="card-header pb-0">
                <h4 class="mt-2 d-flex align-items-center justify-content-center">
                    Jumlah marketing
                </h4>
            </div>
            <div class="card-body d-flex flex-column justify-content-end">
                <div class="row text-center">
                    <div class="col">
                        <p class="font-sans-serif lh-1 mb-1 fs-4">{{ count($marketing) }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="bg-light p-2 mt-2 rounded shadow">
    <h2>List pemesanan</h2>
    <div class="table-responsive">
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Product</th>
                    <th scope="col">Qty</th>
                    <th scope="col">Price</th>
                    <th scope="col">Date order</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pemesanan as $key => $value)
                <tr>
                    <td>{{ $key+1 }}</td>
                    <td>{{ $value->customer->name }}</td>
                    <td>{{ $value->product->name }}</td>
                    <td>{{ $value->qty }}</td>
                    <td>Rp. {{ number_format($value->price,0,',','.') }}</td>
                    <td>{{ date_format(date_create($value->created_at), "d F Y") }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection