@extends('admin.templates.layout')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">General</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip"
                        title="Collapse">
                        <i class="fas fa-minus"></i></button>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.posts.update', $post) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method("PUT")
                    <div class="form-group">
                        <label for="inputName">Title</label>
                        <input type="text" id="inputName" name="title" value="{{ old('title') ?? $post->title}}"
                            class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Content</label>
                        <textarea id="editor" name="content" class="form-control"
                            rows="4">{{ old('content') ?? $post->content }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="">Category</label>
                        <select name="category_id" id="" class="form-control select2">
                            @foreach ($categories as $category)
                            <option value="{{ $category->id }}" @if ($category->id == $post->category_id)
                                selected
                            @endif>{{ $category->title }}</option>
                            @endforeach
                        </select>
                        @error('category_id')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Thumbnail</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="image" name="thumbnail">
                            <label class="custom-file-label"
                                for="image">{{$post->getThumbnail() ?? 'Choose Thumbnail' }}</label>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-md-9">
                            <img src="{{ $post->getThumbnail() }}" alt="" class="img-thumbnail">
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="submit" value="Edit" class="btn btn-primary">
                    </div>
                </form>
            </div>
            <!-- /.card-body -->
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script src="{{asset('admin/plugins/ckeditor-5/ckeditor.js')}}"></script>
<script>
    $('.custom-file-input').on('change', function () {
        let fileName = $(this).val().split('\\').pop();
        $(this).next('.custom-file-label').addClass("selected").html(fileName);
    });
    ClassicEditor
        .create(document.querySelector('#editor'))
        .then(editor => {
            console.log(editor);
        })
        .catch(error => {
            console.error(error);
        });

</script>
@endpush
