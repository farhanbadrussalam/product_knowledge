@extends('layouts.main')

@section('container')
<link rel="stylesheet" href="{{asset('swiper/swiper-bundle.min.css')}}">

<style>
    .swiper {
        width: 100%;
        height: 100%;
        margin-left: auto;
        margin-right: auto;
    }

    .swiper-slide {
        text-align: center;
        font-size: 18px;
        background: #fff;

        /* Center slide text vertically */
        display: -webkit-box;
        display: -ms-flexbox;
        display: -webkit-flex;
        display: flex;
        -webkit-box-pack: center;
        -ms-flex-pack: center;
        -webkit-justify-content: center;
        justify-content: center;
        -webkit-box-align: center;
        -ms-flex-align: center;
        -webkit-align-items: center;
        align-items: center;
    }

    .swiper-slide img {
        display: block;
        object-fit: cover;
    }
</style>
<div class="p-3 h-auto">
    <div class="card h-100">
        <div class="card-body">
            <h2>Edit product</h2>
            <hr>
            <form action="{{ url('dashboard/product/'.$product->id) }}" class="row" method="post" enctype="multipart/form-data">
                <div class="col-lg-8">
                    @method('put')
                    @csrf
                    <div class="mb-2">
                        <label for="name">Name product</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $product->name) }}">
                        @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="mb-2">
                        <label for="kategori_id">Kategori</label>
                        <select name="kategori_id" id="kategori_id" class="form-select @error('kategori_id') is-invalid @enderror">
                            @foreach($kategoris as $kategori)
                            @if(old('kategori', $product->kategori_id) == $kategori->id)
                            <option value="{{ $kategori->id }}" selected>{{ $kategori->name }}</option>
                            @else
                            <option value="{{ $kategori->id }}">{{ $kategori->name }}</option>
                            @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-2">
                        <label for="harga">Harga product</label>
                        <input type="number" class="form-control @error('harga') is-invalid @enderror" id="harga" name="harga" value="{{ old('harga', $product->harga) }}">
                        @error('harga')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="mb-2">
                        <label for="photo_utama">Gambar utama</label>
                        <input type="hidden" name="oldImage" value="{{$product->photo_utama}}">
                        @if($product->photo_utama)
                        <img src="{{ asset('storage/'.$product->photo_utama) }}" id="img-preview" class="d-block img-fluid col-md-5 mb-3">
                        @else
                        <img id="img-preview" class="d-block img-fluid col-md-5 mb-3">
                        @endif
                        <input type="file" accept="image/*" name="photo_utama" id="photo_utama" class="form-control @error('photo_utama') is-invalid @enderror" onchange="previewImage(this)">
                        @error('photo_utama')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="mb-2">
                        <label for="link_video">Link video</label>
                        <input type="text" name="video" id="link_video" class="form-control" placeholder="Masukan link video" value="{{ old('video', $product->video) }}">
                    </div>
                    <div class="mb-2">
                        <label for="name">Description</label>
                        @error('description')
                        <p class="text-danger">
                            {{ $message }}
                        </p>
                        @enderror
                        <input type="hidden" id="description" name="description" value="{{ old('description', $product->description) }}">
                        <trix-editor input="description"></trix-editor>
                    </div>

                    <button type="submit" class="btn btn-primary">Create new product</button>
                </div>
                <div class="col-md-4 border">
                    <div class="row">
                        <div class="border-bottom">
                            <h3 class="text-center">Upload Gambar</h3>
                        </div>
                        <div class="mt-2">
                            <div class="swiper mySwiper">
                                <div class="swiper-wrapper" id="preview-img">
                                    @foreach(json_decode($product->photo_deskripsi) as $image)
                                    <div class="swiper-slide row">
                                        <div class="col-md-12">
                                            <img src="{{asset('storage/'.$image)}}" class="img-fluid" />
                                        </div>
                                        <div class="col-md-12">
                                            <button class="btn btn-outline-danger btn-sm" type="button" data-item="{{$image}}" onclick="remove_image(this)" style="font-size: 12px;">Remove</button>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                                <div class="swiper-pagination"></div>
                            </div>
                            <div id="remove-image"></div>
                        </div>
                        <div class="col-12 text-center">
                            <a href="javascript:void(0)" style="text-decoration: none;" onclick="tambahUpload()">Tambah gambar</a>
                        </div>
                        <div class="col-12 mt-2" id="formUploadGambar">
                            <div>
                                <input type="file" accept="image/*" name="photo_deskripsi[]" id="gambar[]" class="form-control form-control-sm">
                                <div class="preview[]" id="preview[]"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="{{ asset('swiper/swiper-bundle.min.js') }}"></script>
<script>
    document.addEventListener('trix-file-accept', function(e) {
        e.preventDefault();
    })

    function tambahUpload() {
        let parent = document.createElement('div');
        parent.className = 'input-group input-group-sm mt-2';
        parent.innerHTML = `<input type="file" accept="image/*" class="form-control" id="photo_deskripsi[]" name="photo_deskripsi[]">
                            <a href="javascript:void(0)" onclick="hapusUpload(this)" class="text-danger input-group-text" style="text-decoration: none;">Hapus</a>`;

        document.getElementById('formUploadGambar').appendChild(parent);
    }

    function hapusUpload(obj) {
        $(obj).parent().remove();
    }

    function previewImage(obj) {
        const oFReader = new FileReader();
        if (obj.files[0]) {
            oFReader.readAsDataURL(obj.files[0]);

            oFReader.onload = function(event) {
                document.querySelector('#img-preview').src = event.target.result;
            }
        } else {
            document.querySelector('#img-preview').src = "{{ asset('storage/'.$product->photo_utama) }}";
        }
    }

    function remove_image(obj) {
        let confirm = window.confirm('are you sure want to remove ?')
        if (confirm) {
            let item = $(obj).data('item');
            $(obj).parent().parent().remove();

            let remove = document.getElementById('remove-image');

            let fakeinput = document.createElement('input');
            fakeinput.type = 'hidden';
            fakeinput.name = 'removeImage[]';
            fakeinput.value = item;

            remove.appendChild(fakeinput);

        }
    }

    let swiper = new Swiper(".mySwiper", {
        slidesPerView: 3,
        spaceBetween: 5,
        freeMode: true,
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
    });
</script>
@endsection