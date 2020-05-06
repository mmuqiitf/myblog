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
                <h1 class="card-title">Posts Table</h1>
                <br><a href="{{ route('admin.posts.create') }}" class="btn btn-primary">Create Post</a>
            </div>
            <div class="card-body">
                <table id="dataTable" class="table table-bordered table-hover" width="100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Title</th>
                            <th>Author</th>
                            <th>Category</th>
                            <th>Likes</th>
                            <th>Comments</th>
                            <th>Created At</th>
                            <th>Action</th>
                            <th>Featured</th>
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
    $(document).on('click touchstart', '.btn-featured', function (e) {
        let _this = $(this);
        let _url = "/admin/featured/" + _this.attr('data-id');
        $.get(_url, function (data) {
            _this.removeClass('btn btn-info btn-sm btn-featured').addClass(
                'btn btn-danger btn-sm btn-unfeatured');
        });
        e.preventDefault()
    });
    $(document).on('click touchstart', '.btn-unfeatured', function (e) {
        let _this = $(this);
        let _url = "/admin/unfeatured/" + _this.attr('data-id');
        $.get(_url, function (data) {
            _this.removeClass('btn btn-danger btn-sm btn-unfeatured').addClass(
                'btn btn-info btn-sm btn-featured');
        });
        e.preventDefault()
    });

</script>
<script>
    $(function () {
        $('#dataTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route('admin.posts.data') }}',
            columns: [{
                    data: 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'title'
                },
                {
                    data: 'author',
                    orderable: false
                },
                {
                    data: 'category'
                },
                {
                    data: 'total_likes',
                    searchable: false
                },
                {
                    data: 'total_comments',
                    searchable: false
                },
                {
                    data: 'created_at'
                },
                {
                    data: 'action',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'featured',
                    orderable: false,
                    searchable: false
                }
            ]
        });
    });

</script>
@endpush
