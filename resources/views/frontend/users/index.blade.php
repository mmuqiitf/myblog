@extends('frontend.templates.layout')
@section('content')
<div class="col-md-12">
    @if(session('danger'))
    <div class="alert alert-danger"> {{ session('danger') }} </div>
    @endif
    @if(session('success'))
    <div class="alert alert-success">{{  session('success') }} </div>
    @endif

    <article class="blog-post">
        <div class="blog-post-body">
            <h2>My Profile</h2>
        </div>
        <div class="blog-post-text">
            <form action="{{ route('profile.update', $user) }}" method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-6">
                        <h4>Your Account</h4>
                        @csrf
                        @method("PUT")
                        <div class="form-group">
                            <label for="">Name</label>
                            <input type="text" name="name" value="{{ old('name') ?? $user->name}}"
                                class="form-control @error('name') is-invalid @enderror">
                            @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Email</label>
                            <input type="text" name="email" value="{{ old('email') ?? $user->email}}"
                                class="form-control @error('email') is-invalid @enderror">
                            @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Old Password</label>
                            <input type="password" name="old_password"
                                class="form-control @error('old_password') is-invalid @enderror">
                            @error('old_password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">New Password</label>
                            <input type="password" name="password"
                                class="form-control @error('password') is-invalid @enderror">
                            @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input type="submit" value="Edit" class="btn btn-primary btn-lg">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <h4>Your Pircture</h4>
                        <div class="form-group">
                            <label for="">Picture</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="image" name="picture">
                                <label class="custom-file-label" for="image">Choose Picture</label>
                                @error('picture')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <img src="{{ $user->getPicture() }}" alt="" class="img-thumbnail">
                    </div>
                </div>
            </form>
        </div>
    </article>
</div>
@endsection
@push('scripts')
<script>
    $('.custom-file-input').on('change', function () {
        let fileName = $(this).val().split('\\').pop();
        $(this).next('.custom-file-label').addClass("selected").html(fileName);
    });

</script>
@endpush
