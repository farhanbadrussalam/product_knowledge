@extends('layouts.main')

@section('container')

<div class="container-xl">
    <div class="row">
        <div class="col-md-12 mt-4 bg-white rounded shadow p-0">
            <div class="headerCard p-2 rounded">
                <label for="" class="fw-bolder"><i class="fa fa-filter" aria-hidden="true"></i> Filter </label>
            </div>
            <div class="d-flex py-2 px-2">
                <form action="{{ url('product-customer') }}" class="row col-md-5">
                    <div class="input-group">
                        <select class="form-select" id="Kategori" aria-label="Kategori" name="kategori">
                            <option value="">All Kategori</option>
                            @foreach($kategoris as $kategori)
                            <?php
                            $kategori->id === (int) request('kategori') ? $selected = 'selected' : $selected = '';
                            ?>
                            <option value="{{ $kategori->id }}" {{ $selected }}>{{ $kategori->name }}</option>
                            @endforeach
                        </select>
                        <input type="text" class="form-control" id="pencarian" placeholder="Pencarian.." name="pencarian" value="{{ request('pencarian') }}">
                        <button type="submit" class="btn btn-primary">Cari</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-12 mt-3">
            <h2><i class="fa fa-caret-right" aria-hidden="true"></i> List Product</h2>
            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                @foreach($products as $product)
                <div class="col mb-5">
                    <div class="card h-100 card-product">
                        <a href="{{ url('product-customer/detail/'.$product->id) }}" class="text-decoration-none text-dark">
                            <!-- Sale badge-->
                            <div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 0.5rem">{{$product->kategori->name}}</div>
                            <!-- Product image-->
                            @if($product->photo_utama == '')
                            <img class="card-img-top" style="height: 250px;" src="https://source.unsplash.com/250x180?{{$product->kategori->name}}" alt="..." />
                            @else
                            <img class="card-img-top" style="height: 250px;" src="{{url('storage/'.$product->photo_utama)}}" alt="..." />
                            @endif
                            <!-- Product details-->
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <!-- Product name-->
                                    <h5 class="fw-bolder">{{ $product->name }}</h5>
                                    <!-- Product price-->
                                    Rp. {{ number_format($product->harga,0,',','.') }}
                                </div>
                            </div>
                        </a>
                        <!-- Product actions-->
                        @if(session()->has('dataCustomer'))
                        <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                            <div class="text-center"><button class="btn btn-outline-dark mt-auto" type="button" data-item="{{$product}}" onclick="addCartOrder(this)">Add to cart <i class="fa fa-cart-plus" aria-hidden="true"></i></button></div>
                        </div>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
            <div class="d-flex justify-content-center">
                {{ $products->links() }}
            </div>
        </div>
    </div>
</div>
<script>
    function addCartOrder(obj) {
        let item = $(obj).data('item');
        const idProduct = document.getElementById('idProduct');
        const nameProduct = document.getElementById('nameProduct');
        const priceProduct = document.getElementById('priceProduct');
        const qtyProduct = document.getElementById('qtyProduct');
        const grandTotal = document.getElementById('grandTotal');
        const postGrandTotal = document.getElementById('postGrandTotal');

        nameProduct.value = item.name;
        idProduct.value = item.id;
        priceProduct.value = `Rp. ${Intl.NumberFormat().format(item.harga)}`;
        grandTotal.innerHTML = `Rp. ${Intl.NumberFormat().format(item.harga)}`;
        postGrandTotal.value = Number(qtyProduct.value) * Number(item.harga);
        qtyProduct.onchange = function(evt) {
            let qty = evt.target.value;

            let total = Number(qty) * Number(item.harga);

            postGrandTotal.value = total;

            grandTotal.innerHTML = `Rp. ${Intl.NumberFormat().format(total)}`;
        }

        $('#modalOrderProduct').modal('show');
    }
</script>
@endsection