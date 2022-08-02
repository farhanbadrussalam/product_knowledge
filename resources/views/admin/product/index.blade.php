@extends('layouts.main')

@section('container')
<div class="p-3 h-auto">
    <div class="card h-100">
        <div class="card-body">
            <h2>Data Product</h2>
            <a class="btn btn-primary mb-3" href="{{ url('dashboard/product/create') }}">Tambah data</a>

            @if(session()->has('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
            @endif
            <div class="table-responsive">
                <table class="table table-striped table-hover w-100" id="table">
                    <thead>
                        <tr>
                            <th width="1%" class="text-center">No</th>
                            <th width="50%">Nama product</th>
                            <th width="20%">Kategori</th>
                            <th width="20%">Harga</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    let table_ = false;
    $(function(){
        table_ = $('#table').DataTable({
            processing: true,
            serverSide: true,
            methode: 'GET',
            ajax: "{{ url('/product/dataAjax') }}",
            columns : [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'name_product', name: 'name_product'},
                {data: 'kategori', name: 'kategori'},
                {data: 'harga', name: 'harga'},
                {data: 'action', name: 'action', orderable: false, searchable: false}
            ]
        })

    })
    function deleteThis(id) {
        const validasi = confirm('Are you sure want to delete?');

        if(validasi){
            $.ajax({
                url: `{{ url('dashboard/product') }}/${id}`,
                type: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
                    alert(data);
                    table_.ajax.reload();
                }
            })
        }
    }
</script>
@endsection