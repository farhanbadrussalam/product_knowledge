@extends('layouts.main')

@section('container')

<div class="container vh-100 p-3">
    <div class="row align-items-center justify-content-between">
        <div class="col-md-7">
            <img src="{{ asset('gambar/img_perusahaan.jpg') }}" alt="perusahaan" class="img-fluid rounded shadow">
        </div>
        <div class="col-md-4 my-3 ">
            @if(session()->has('loginError'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('loginError') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            <form class="rounded-3 bg-light shadow form-signin" action="{{ url('login') }}" method="POST">
                @csrf
                <div>
                    <img src="{{ asset('gambar/perusahaan 2.jpg') }}" alt="" class="img-fluid rounded-top shadow-sm">
                </div>
                <div class="p-3 p-md-4">
                    <div class="form-floating">
                        <input type="text" class="form-control" id="username" name="username" placeholder="Username or Email" autofocus required value="{{ old('username') }}">
                        <label for="username">Username or Email address</label>
                    </div>
                    <div class="form-floating">
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                        <label for="password">Password</label>
                    </div>
                    <button class="w-100 btn btn-lg btn-primary" type="submit">Login</button>
                    <a href="{{ url('/') }}" class="btn btn-link w-100">Kembali</a>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection