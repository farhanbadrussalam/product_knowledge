@extends('layouts.main')

@section('container')
<link rel="stylesheet" href="{{asset('swiper/swiper-bundle.min.css')}}">

<style>
    .swiper {
        width: 100%;
    }

    .swiper-slide {
        background-position: center;
        background-size: cover;
        width: 300px;
        height: 300px;
    }

    .swiper-slide img {
        display: block;
        width: 100%;
    }
</style>
<div class="container">
    <!-- Media -->
    <div class="row my-3">
        <div class="col-md-5">
            <!-- video -->
            <div>
                @isset($product->video)
                <iframe class="w-100" style="height: 250px;" src="{{ $product->video }}?autoplay=1&controls=0" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                @endisset
            </div>
            <!-- gambar -->
            <div class="mt-3">
                <div class="swiper mySwiper">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <img src="{{asset('storage/'.$product->photo_utama)}}" class="img-fluid" />
                        </div>
                        @foreach(json_decode($product->photo_deskripsi) as $image)
                        <div class="swiper-slide">
                            <img src="{{asset('storage/'.$image)}}" class="img-fluid" />
                        </div>
                        @endforeach
                    </div>
                    <div class="swiper-pagination"></div>
                </div>
            </div>
        </div>
        <div class="col-md-7">
            <article>
                <div class="d-flex justify-content-between">
                    <div class="w-75">
                        <h2>{{ $product->name }}</h2>
                        <p class="blog-post-meta">{{$product->created_at->diffForHumans()}} , Category {{ $product->kategori->name }}</p>
                    </div>
                    @if(session()->has('dataCustomer'))
                    <div>
                        <button class="btn btn-warning mt-auto" data-item="{{$product}}" onclick="addCartOrder(this)">Add to cart <i class="fa fa-cart-plus" aria-hidden="true"></i></button>
                    </div>
                    @endif
                </div>
                {!! $product->description !!}
            </article>
        </div>
    </div>
</div>
<script src="{{ asset('swiper/swiper-bundle.min.js') }}"></script>
<script>
    var swiper = new Swiper(".mySwiper", {
        effect: "coverflow",
        grabCursor: true,
        centeredSlides: true,
        slidesPerView: "auto",
        coverflowEffect: {
            rotate: 50,
            stretch: 0,
            depth: 100,
            modifier: 1,
            slideShadows: true,
        },
        autoplay: {
            delay: 2500,
            disableOnInteraction: false,
        },
        pagination: {
            el: ".swiper-pagination",
        },
    });

    function addCartOrder(obj) {
        const item = $(obj).data('item');

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