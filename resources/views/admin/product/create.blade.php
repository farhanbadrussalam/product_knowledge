@extends('layouts.main')

@section('container')

<div class="p-3 h-auto">
    <div class="card h-100">
        <div class="card-body ">
            <h2>Tambah product</h2>
            <hr>
            <form action="{{ url('dashboard/product') }}" class="row" method="post" enctype="multipart/form-data">
                <div class="col-lg-8 ">
                    @csrf
                    <div class="mb-2">
                        <label for="name">Name product</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}">
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
                            @if(old('kategori') == $kategori->id)
                            <option value="{{ $kategori->id }}" selected>{{ $kategori->name }}</option>
                            @else
                            <option value="{{ $kategori->id }}">{{ $kategori->name }}</option>
                            @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-2">
                        <label for="harga">Harga product</label>
                        <input type="number" class="form-control @error('harga') is-invalid @enderror" id="harga" name="harga" value="{{ old('harga') }}">
                        @error('harga')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="mb-2">
                        <label for="photo_utama">Gambar utama</label>
                        <img id="img-preview" class="d-block img-fluid col-md-5 mb-3">
                        <input type="file" accept="image/*" name="photo_utama" id="photo_utama" class="form-control @error('photo_utama') is-invalid @enderror" onchange="previewImage(this)">
                        @error('photo_utama')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="mb-2">
                        <label for="link_video">Link video</label>
                        <input type="text" name="video" id="link_video" class="form-control" placeholder="Masukan link video" value="{{ old('video') }}">
                    </div>
                    <div class="mb-2">
                        <label for="name">Description</label>
                        @error('description')
                        <p class="text-danger">
                            {{ $message }}
                        </p>
                        @enderror
                        <input type="hidden" id="description" name="description" value="{{ old('description') }}">
                        <trix-editor input="description"></trix-editor>
                    </div>

                    <button type="submit" class="btn btn-primary">Create new product</button>
                </div>
                <div class="col-md-4 border">
                    <div class="row">
                        <div class="border-bottom">
                            <h3 class="text-center">Upload Gambar</h3>
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
            document.querySelector('#img-preview').src = '';
        }
    }
</script>
@endsection