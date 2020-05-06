@extends('admin.templates.layout')
@section('content')
<div class="row">
    <div class="col-12">
      <div class="card">
        @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif
        @if (session('danger'))
        <div class="alert alert-danger">
            {{ session('danger') }}
        </div>
        @endif
        <div class="card-header">
            <h1 class="card-title">User Table</h1>
        </div>
        <div class="card-body"> 
            <table id="dataTable" class="table table-bordered table-hover" width="100%">
                <thead>
                    <tr>
                      <th>No</th>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Email Verified</th>
                      <th>Created At</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Muqiit</td>
                        <td>Edit</td>
                        <td>Edit</td>
                    </tr>
                </tbody>
            </table>
        </div>
      </div>
    </div>
</div>
@endsection
@push('css')
    <link rel="stylesheet" href="{{ asset('admin/plugins/datatables-bs4/css/dataTables.bootstrap4.css') }}">
@endpush
@push('scripts')
    <script src="{{ asset('admin/plugins/datatables/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('admin/plugins/datatables-bs4/js/dataTables.bootstrap4.js') }}"></script>
<script>
        $(function (){
            $('#dataTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('admin.users.data') }}',
                columns: [
                    {data : 'DT_RowIndex', orderable : false, searchable: false},
                    {data : 'name'},
                    {data : 'email'},
                    {data : 'email_verified_at'},
                    {data : 'created_at'},
                ]
            });
        });
    </script>
@endpush