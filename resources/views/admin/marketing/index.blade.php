@extends('layouts.main')

@section('container')
<div class="p-3 h-100">
    <div class="card h-100">
        <div class="card-body">
            <div class="d-flex justify-content-between">
                <h2>Data Marketing</h2>
                @if(session()->has('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>
                @endif
            </div>
            <a class="btn btn-primary mb-3" href="{{ url('dashboard/marketing/create') }}">Tambah data</a>
            <div class="table-responsive">
                <table class="table table-striped table-hover w-100" id="table">
                    <thead>
                        <tr>
                            <th width="1" class="text-center">No</th>
                            <th>Nama marketing</th>
                            <th>E-mail</th>
                            <th>Update At</th>
                            <th class="text-center w-25">Action</th>
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
    $(function() {
        table_ = $('#table').DataTable({
            processing: true,
            serverSide: true,
            methode: 'GET',
            ajax: "{{ url('/marketing/dataAjax') }}",
            columns: [
                {data: 'DT_RowIndex', name:'DT_RowIndex'},
                {data: 'name', name:'name'},
                {data: 'email', name:'email'},
                {data: 'updated', name:'updated'},
                {data: 'action', name:'action', orderable: false, searchable: false}
            ]
        })
    })
    function deleteThis(id){
        const validasi = confirm('Are you sure want to delete?');

        if(validasi){
            $.ajax({
                url: `{{ url('dashboard/marketing') }}/${id}`,
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