@extends('layouts.main')

@section('container')

<div class="p-3 h-auto">
    <div class="card h-100">
        <div class="card-body">
            <h2>Edit marketing</h2>
            <hr>
            <div class="col-lg-8">
                <form action="{{ url('dashboard/marketing/'.$marketing->id) }}" method="post">
                    @method('put')
                    @csrf
                    <div class="mb-2">
                        <label for="name">Name marketing</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $marketing->name) }}">
                        @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="mb-2">
                        <label for="username">Username</label>
                        <input type="text" class="form-control @error('username') is-invalid @enderror" id="username" name="username" value="{{ old('username', $marketing->username) }}">
                        @error('username')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="mb-2">
                        <label for="email">E-mail</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $marketing->email) }}">
                        @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    @if($marketing->password)
                    <div class="mb-2">
                        <label for="password">Password Lama</label>
                        <input type="password" class="form-control @error('password_lama') is-invalid @enderror" id="password_lama" name="password_lama" value="{{ old('password') }}">
                        @error('password_lama')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    @endif
                    <div class="mb-2">
                        <label for="password">Password</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" value="{{ old('password') }}">
                        @error('password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Update marketing</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection