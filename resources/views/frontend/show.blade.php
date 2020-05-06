@extends('frontend.templates.layout')
@section('content')
<div class="col-md-8">
    <article class="blog-post">
        <div class="blog-post-image">
            <img src="{{'http://faturrahman.local/' . $post->thumbnail}}" alt="" width="750px">
        </div>
        <div class="blog-post-body">
            <h2>{{ $post->title }}</h2>
            <div class="post-meta"><span>by <a href="#">{{ $post->user->name }}</a></span>/<span><i
                        class="fa fa-clock-o"></i>{{$post->created_at->diffForHumans()}}</span>/<span><i
                        class="fa fa-comment-o"></i>{{ $commentCount }}</span></div>
            <div class="blog-post-text">
                {!! $post->content !!}
            </div>
        </div>
    </article>
    <div class="row">
        <div class="col-md-12">
            @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @guest
            <h3>You should <a href="{{ route('login') }}">login</a> before post a comments and give a likes.</h3>
            @else
            <div class="like_wrapper mb-3">
                <button class="btn-like-post like-review @if($post->isLike()) btn-unlike @else btn-like @endif" data-model-id="{{ $post->id }}" data-type="1">
                    @if($post->isLike()) Unlike @else  <i class="fa fa-heart" aria-hidden="true"></i> Like @endif
                </button>
                <div class="total_like mt-2">
                    <span class="like_number"> {{ $post->likes->count() }}</span> <span class="like_desc">Total Like</span> 
                </div>
            </div>
            <form method="POST" action="/comments/{{ $post->id }}">
                @csrf
                <div class="form-group">
                    <label for="">Comment as {{ auth()->user()->name }}</label>
                    <textarea name="text" class="form-control @error('text') is-invalid @enderror" cols="30"
                        rows="10"> {{old('text')}} </textarea>
                    @error('text')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="form-group">
                    <input type="submit" value="Submit" class="btn btn-primary">
                </div>
            </form>
            @endguest
        </div>
    </div>
    {{-- <div class="row">
        @foreach ($comments as $comment)
        <div class="col-md-12" style="border: 1px solid black;">
            <p>{{ $comment->user->name }}</p>
            <p> {{ $comment->text }} </p>
            <p>{{ $comment->created_at->diffForHumans() }}</p>
            <div class="like_wrapper mb-3">
                <button class="btn-like-comment like-review @if($comment->isLike()) btn-unlike @else btn-like @endif" data-model-id="{{ $comment->id }}" data-type="2">
                    @if($comment->isLike()) Unlike @else  <i class="fa fa-heart" aria-hidden="true"></i> Like @endif
                </button>
                <div class="total_like mt-2">
                    <span class="like_number"> {{ $comment->likes->count() }}</span> Total Like
                </div>
            </div>
        </div>
        @endforeach
        {{ $comments->links() }}
    </div> --}}
    <div class="row">
        <ul class="comment-section" id="comment">
            @foreach ($comments as $comment)
            <li class="comment user-comment">
                @guest
                <div class="info">
                    <a href="">{{ $comment->user->name }}</a>
                    <span>{{ $comment->created_at->diffForHumans() }}</span>
                </div>
                <a href="" class="avatar">
                    <img src="{{$comment->user->getPicture()}}" style="width: 35px !important; height: 35px !important" alt="">
                </a>
                <p>{{$comment->text}}</p>
                @else
                <div class="like_wrapper pt-2">
                    <button class="btn-like-comment like-review mb-1 @if($comment->isLike()) btn-unlike @else btn-like @endif" data-model-id="{{ $comment->id }}" data-type="2">
                        @if($comment->isLike()) Unlike @else  <i class="fa fa-heart" aria-hidden="true"></i> Like @endif
                    </button>
                    <span class="like_number"> {{ $comment->likes->count() }}</span> <span class="like_desc">Total Like</span> 
                </div>    
                @endguest
            </li>
            @endforeach
        </ul>
        {{ $comments->links() }}
    </div>
</div>
@endsection
@push('scripts')
<script>
    $(document).ready(function () {
            $('img').addClass('img-fluid').css("height", "auto");
        })
    $(document).on('click touchstart', '.btn-like', function () {
        let _this = $(this);
        let _url = "/like/" + _this.attr('data-type') + "/" + _this.attr('data-model-id');
        $.get(_url, function (data) {
            _this.removeClass('btn-primary btn-like').addClass('btn-danger btn-unlike').html('Unlike');
            let likeNumber = _this.parents('.like_wrapper').find('.like_number');
            likeNumber.html(parseInt(likeNumber.html()) + 1);
        });
    });
    $(document).on('click touchstart', '.btn-unlike', function () {
        let _this = $(this);
        let _url = "/unlike/" + _this.attr('data-type') + "/" + _this.attr('data-model-id');
        $.get(_url, function (data) {
            _this.removeClass('btn-danger btn-unlike').addClass('btn-primary btn-like').html('<i class="fa fa-heart" aria-hidden="true"></i> Like');
            let likeNumber = _this.parents('.like_wrapper').find('.like_number');
            likeNumber.html(parseInt(likeNumber.html()) - 1);
        });
    });

</script>
@endpush
@section('sidebar')
<div class="col-md-4 sidebar-gutter">
    <aside>
        <!-- sidebar-widget -->
        <div class="sidebar-widget">
            <h3 class="sidebar-title">About Me</h3>
            <div class="widget-container widget-about">
                <a href="/about">
                    <h4>M. Muqiit Faturrahman</h4>
                </a>
                <div class="author-title">Learner</div>
                <p>Maybe i'm a slow learner, but i learn.</p>
            </div>
        </div>
        <!-- sidebar-widget -->
        @if ($featureds->count() > 0)
        <div class="sidebar-widget">
            <h3 class="sidebar-title">Featured Posts</h3>
            <div class="widget-container">
                @foreach ($featureds as $featured)
                <article class="widget-post">
                    <div class="post-image">
                        <a href="{{ route('post.slug',$featured->slug) }}"><img src="{{$featured->getThumbnail()}}"
                                alt=""></a>
                    </div>
                    <div class="post-body">
                        <h2><a href="post.html">{{$featured->title}}</a></h2>
                        <div class="post-meta">
                            <span><i class="fa fa-clock-o"></i> {{$featured->created_at->diffForHumans()}}</span>
                            <span><a href="post.html"><i class="fa fa-comment-o"></i>
                                    {{$featured->comments->count()}}</a></span>
                        </div>
                    </div>
                </article>
                @endforeach
            </div>
        </div>
        @endif
        
        <!-- sidebar-widget -->
        <div class="sidebar-widget">
            <h3 class="sidebar-title">Socials</h3>
            <div class="widget-container">
                <div class="widget-socials">
                    <a href="https://www.facebook.com/mmuqiitf"><i class="fa fa-facebook"></i></a>
                    <a href="https://www.twitter.com/mmuqiit"><i class="fa fa-twitter"></i></a>
                    <a href="https://www.instagram.com/mmuqiit"><i class="fa fa-instagram"></i></a>
                    <a href="https://www.github.com/mmuqiitf"><i class="fa fa-github"></i></a>
                </div>
            </div>
        </div>
        <!-- sidebar-widget -->
        <div class="sidebar-widget">
            <h3 class="sidebar-title">Categories</h3>
            <div class="widget-container">
                <ul>
                    @foreach ($categories as $category)
                    <li><a href="{{ route('category',$category->slug) }}">{{$category->title}}</a></li>
                    @endforeach
                </ul>
            </div>
        </div>
    </aside>
</div>
@endsection
