@extends('frontend.templates.layout')
@section('slider')
@if ($featureds->count() > 0)
<section class="main-slider">
    <ul class="bxslider">
        @foreach ($featureds as $featured)
        <li>
            <div class="slider-item"><img src="{{ $featured->getThumbnail() }}" title="{{$featured->title}}" />
                <h2><a href="{{route('post.slug',$featured->slug)}}"
                        title="{{$featured->title}}">{{$featured->title}}</a></h2>
            </div>
        </li>
        @endforeach
    </ul>
</section>
@endif

@endsection
@section('content')
<div class="col-md-8">
    @if ($posts->count() < 1) 
        <article>
            <h1>Sorry, No Post!</h1>
        </article>
        @else
        <h2 class="mb-4">Category : {{ $category->title }}</h2>
        @foreach($posts as $post)
        <article class="blog-post">
            <div class="blog-post-image">
                <a href="{{'post/' . $post->slug}}"><img src="{{$post->getThumbnail()}}" alt="" width="750px"></a>
            </div>
            <div class="blog-post-body">
                <h2><a href="{{route('post.slug',$post->slug)}}">{{ $post->title }} </a></h2>
                <div class="post-meta">
                    <span>by <a href="#">{{ $post->user->name }}</a></span>/
                    <span><i class="fas fa-list-alt"></i>{{$post->category->title}}</span> /
                    <span><i class="fa fa-clock-o"></i>{{$post->created_at->diffForHumans()}}</span>/
                    <span><i class="fa fa-comment-o"></i> <a href="#">{{$post->comments->count()}}</a></span>
                </div>
                <p>
                    {!! Str::limit($post->removeTags($post->content), 150) !!}
                </p>
                <div class="read-more"><a href="{{'post/' . $post->slug}}">Continue Reading</a></div>
            </div>
        </article>
        @endforeach
        {{ $posts->links() }}
    @endif
</div>
@endsection
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
