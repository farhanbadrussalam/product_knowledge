<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Knowledge | {{ $title }}</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" crossorigin="anonymous">
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}" crossorigin="anonymous"></script>

    <!-- font awesome 4.7.0 -->
    <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}">

    <!-- Jquery -->
    <script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>

    <!-- datatable -->
    <link rel="stylesheet" href="{{ asset('css/dataTables.bootstrap5.min.css') }}">
    <script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/dataTables.bootstrap5.min.js') }}"></script>

    <!-- trix editor -->
    <link rel="stylesheet" href="{{ asset('css/trix.css') }}">
    <script src="{{ asset('js/trix.js') }}"></script>

    <style>
        trix-toolbar [data-trix-button-group="file-tools"] {
            display: none;
        }
    </style>
</head>

<body>
    @if($template === 'landing' || $template === 'view-product')
    <nav class="navbar navbar-expand-lg navbar-dark" aria-label="Eighth navbar example" style="background-color: #a8d8ff">
        <div class="container">
            <a href="{{ url('/') }}"><img src="{{ asset('gambar/kitologowarna.png') }}" alt="logo" class="img-fluid" style="width: 100px"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample07" aria-controls="navbarsExample07" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse">
                <ul class="navbar-nav ms-auto">
                    @auth

                    <li class="nav-item dropdown ">
                        <a class="nav-link dropdown-toggle text-dark" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Hello, {{ auth()->user()->name }}
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="{{ url('dashboard') }}">Dashboard</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <form action="{{ url('logout') }}" method="POST">
                                    @csrf
                                    <button class="dropdown-item">Logout</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                    @else
                    @if(session()->has('dataCustomer'))
                    <li class="nav-item">
                        <button class="btn btn-outline-dark" type="button" data-bs-toggle="modal" data-bs-target="#modalListOrder">
                            <i class="fa fa-shopping-cart me-1"></i>
                            Cart
                            <span class="badge bg-warning text-dark ms-1 rounded-pill" id="jumlahCart">{{ count($dataKeranjang) }}</span>
                        </button>
                    </li>

                    <li class="nav-item dropdown ">
                        <a class="nav-link dropdown-toggle text-dark" id="namaCustomer" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">

                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li>
                                <form action="{{ url('product-customer/logout') }}" method="POST">
                                    @csrf
                                    <button class="dropdown-item">Logout</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                    @else
                    <li class="nav-item me-2">
                        <button class="btn btn-outline-dark fw-bolder" data-bs-toggle="modal" data-bs-target="#modalTokenID">
                            <i class="fa fa-shopping-cart me-1"></i>
                            start shopping
                        </button>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('login') }}" class="btn btn-outline-dark fw-bolder">Log in</a>
                    </li>
                    @endif
                    @endauth
                </ul>
            </div>
        </div>
    </nav>
    <main>
        <div>
            @yield('container')
        </div>
        <!-- modal list order -->
        <div class="modal fade" id="modalOrderProduct" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalOrderProductLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalOrderProductLabel">Order product</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ url('product-customer/orderProduct') }}" method="post">
                            @csrf
                            <div class="row mb-1">
                                <label for="">Product</label>
                                <div class="col-md-12">
                                    <input type="hidden" class="form-control" name="idProduct" id="idProduct">
                                    <input type="text" class="form-control" id="nameProduct" disabled>
                                </div>
                            </div>
                            <div class="row mb-1">
                                <label for="">Price</label>
                                <div class="col-md-12">
                                    <input type="text" class="form-control" id="priceProduct" disabled>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <label for="">Qty</label>
                                <div class="col-md-12">
                                    <input type="number" min="1" name="qtyProduct" class="form-control" id="qtyProduct" value="1">
                                </div>
                            </div>
                            <div class="row mb-1">
                                <input type="hidden" id="postGrandTotal" name="postGrandTotal">
                                <div class="col-md-12 text-center h1" id="grandTotal">
                                    Rp.12.000
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12"><button class="btn btn-primary" type="submit">Order</button></div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- modal add to cart -->
        <div class="modal fade" id="modalListOrder" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalListOrderLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalListOrderLabel">List order</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <table class="table table-sm w-100">
                            <thead>
                                <tr>
                                    <th width="5%" class="text-center">No</th>
                                    <th width="55%">Nama Product</th>
                                    <th width="10%" class="text-center">Qty</th>
                                    <th>Harga</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="bodyTableListOrder">
                                @foreach($dataKeranjang as $key => $value)
                                <tr>
                                    <td class="text-center">{{ $key+1 }}</td>
                                    <td class="text-break">{{ $value->product->name }}</td>
                                    <td class="text-center">{{ $value->qty }}</td>
                                    <td>Rp. {{ number_format($value->price,0,',',',') }}</td>
                                    <td class="text-center">
                                        <button class="btn btn-danger btn-sm">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- form input token id -->
        <div class="modal fade" id="modalTokenID" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalTokenIDLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalTokenIDLabel">Masukkan token id</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ url('product-customer/searchToken') }}" method="post">
                            @csrf
                            <div class="input-group justify-content-center">
                                <div class="form-floating w-75">
                                    <input type="password" class="form-control" id="tokenId" name="tokenId" placeholder="Token ID">
                                    <label for="tokenId">Token ID</label>
                                </div>
                                <button class="input-group-text bg-primary text-white" type="submit"><i class="fa fa-sign-in text-sm" aria-hidden="true"></i></button>
                            </div>
                        </form>

                        <div class="d-flex justify-content-center">
                            <span>Belum punya token id ? <a href="#" data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#modalFormDaftar" class="text-decoration-none">Klik disini</a></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- form membuat token id -->
        <div class="modal fade" id="modalFormDaftar" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalFormDaftarLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalFormDaftarLabel">Create Token Id</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ url('product-customer/generateToken') }}" method="post">
                        @csrf
                        <div class="modal-body">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="name" name="name" placeholder="Name" required>
                                <label for="name">Name</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
                                <label for="email">Email</label>
                            </div>
                            <div class="form-floating">
                                <textarea class="form-control" placeholder="Alamat" id="alamat" name="alamat"></textarea>
                                <label for="alamat">Alamat</label>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Create</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modalSuccessGenerate" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalSuccessGenerateLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="w-100 text-center">
                            <h2>Token anda</h2>
                            <h1 id="tokenIdShow"></h1>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#modalTokenID">Masukkan token</button>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script>
        $(document).ready(function() {
            const session = '<?= session()->has('success') ?>';
            const error = '<?= session()->has('error') ?>';
            const customer = '<?= session()->has('dataCustomer') ?>';

            if (customer == 1) {
                const data = <?= json_encode(session('dataCustomer')) ?>;
                document.getElementById('namaCustomer').innerHTML = data[0].name;
            }

            if (session == 1) {
                const success = <?= json_encode(session('success')) ?>;
                document.getElementById('tokenIdShow').innerHTML = success.token;
                $('#modalSuccessGenerate').modal('show');
            }

            if (error == 1) {
                alert('<?= session('error') ?>');
            }

        })
    </script>
    @elseif($template === 'login')
    <main>
        @yield('container')
    </main>
    @else
    <header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 py-3 shadow" style="background-color: #03030e !important;">
        <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="#">
            <img src="{{ asset('gambar/kitoshindo-logo.png') }}" alt="logo" class="img-fluid" style="width: 100px;">
        </a>
        <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="w-100"></div>
        <div class="navbar-nav">
            <div class="nav-item text-nowrap">
                <form action="{{ url('logout') }}" method="POST">
                    @csrf
                    <button class="nav-link px-3 bg-dark border-0">Logout</button>
                </form>
            </div>
        </div>
    </header>
    <div class="container-fluid">
        <div class="row">
            <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
                <div class="position-sticky pt-5">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}" aria-current="page" href="{{ url('dashboard') }}">
                                <i class="fa fa-home" aria-hidden="true"></i>
                                Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('dashboard/kategori') ? 'active' : '' }}" href="{{ url('dashboard/kategori') }}">
                                <i class="fa fa-tasks" aria-hidden="true"></i>
                                Kategori
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('dashboard/product*') ? 'active' : '' }}" href="{{ url('dashboard/product') }}">
                                <i class="fa fa-cart-plus" aria-hidden="true"></i>
                                Data Products
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('dashboard/marketing') ? 'active' : '' }}" href="{{ url('dashboard/marketing') }}">
                                <i class="fa fa-users" aria-hidden="true"></i>
                                Data Marketing
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                @yield('container')
            </main>
        </div>
    </div>
    @endif

    <!-- <div class="avatar p-2 rounded">
        <img src="{{ asset('gambar/FOTO.jpg') }}" alt="avatar" style="width: 3rem;height: 3rem" class="img-fluid rounded-circle">
        <span>Muhamad Farhan Badrussalam</span>
    </div> -->
</body>

</html>