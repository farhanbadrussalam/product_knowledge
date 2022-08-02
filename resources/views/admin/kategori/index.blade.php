@extends('layouts.main')

@section('container')
<div class="p-3 h-100">
    <div class="card h-100">
        <div class="card-body col-lg-7">
            <div class="d-flex justify-content-between">
                <h2>Data kategori</h2>
                @if(session()->has('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>
                @endif
            </div>
            <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalTambah">Tambah data</button>
            <div class="table-responsive">
                <table class="table table-striped table-hover w-100" id="table">
                    <thead>
                        <tr>
                            <th width="1" class="text-center">No</th>
                            <th>Nama kategori</th>
                            <th class="text-center w-25">Action</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@include('admin.kategori.form')
<script>
    let table_ = false;
    $(function(){
        table_ = $('#table').DataTable({
            processing: true,
            serverSide: true,
            methode: 'GET',
            ajax: "{{ url('/kategori/dataAjax') }}",
            columns: [
                {data: 'DT_RowIndex', name:'DT_RowIndex'},
                {data: 'name', name:'name'},
                {data: 'action', name:'action', orderable: false, searchable: false}
            ]
        });
    });

    function editData(obj){
        let item = $(obj).data('item');
        document.getElementById('update_name').value = item.name;

        let formEdit = document.getElementById('formUpdate');
        formEdit.action = `{{ url('dashboard/kategori') }}/${item.id}`;

        $('#modalEdit').modal('show');
    }

    function deleteData(id) {
        const validasi = confirm('Are you sure want to delete?');

        if(validasi){
            $.ajax({
                url: `{{ url('dashboard/kategori') }}/${id}`,
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