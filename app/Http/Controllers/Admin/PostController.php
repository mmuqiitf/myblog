<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.posts.index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function data()
    {
        $posts = Post::orderBy('created_at', 'desc')->get();
        $posts->load('user', 'comments', 'likes', 'category');
        return datatables()->of($posts)
            ->addColumn('author', function (Post $post) {
                return $post->user->name;
            })
            ->editColumn('thumbnail', function (Post $post) {
                return '<img src="' . $post->getThumbnail() . '" width="200px" height="150px">';
            })
            ->addColumn('category', function (Post $post) {
                return $post->category->title;
            })
            ->addColumn('total_likes', function (Post $post) {
                return $post->likes->count();
            })
            ->addColumn('total_comments', function (Post $post) {
                return $post->comments->count();
            })
            ->addColumn('created_at', function (Post $post) {
                return $post->created_at->diffForHumans();
            })
            ->addColumn('action', 'admin.posts.action')
            ->addColumn('featured', function (Post $post) {
                if ($post->featured == 0) {
                    return '<a id="featured" href="' . route('admin.featured', $post->id) . '" class="btn-featured btn btn-info btn-sm" data-featured="' . $post->featured . '" data-id="' . $post->id . '"><i class="fas fa-star"></i></a>';
                }
                return '<a id="featured" href="' . route('admin.featured', $post->id) . '" class="btn-unfeatured btn btn-danger btn-sm" data-featured="' . $post->featured . '" data-id="' . $post->id . '"><i class="fas fa-star"></i></a>';
            })
            ->addIndexColumn()
            ->rawColumns(['thumbnail', 'action', 'featured'])
            ->toJson();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::orderBy('title', 'ASC')->get();
        return view('admin.posts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|min:5',
            'content' => 'required|min:5'
        ]);
        $thumbnail = 'https://via.placeholder.com/1140x500.png?text=No+Thumbnail';
        if ($request->hasFile('thumbnail')) {
            $thumbnail = $request->file('thumbnail')->store('assets/thumbnail');
        }
        $slug = Str::of($request->title)->slug('-');
        if ($slug->contains($slug)) {
            $post_slug = Post::where('slug', $slug)->get();
            if ($post_slug->count() > 0) {
                $slug = ($slug . '-' . Str::of($post_slug->count())->slug('-'));
            } else {
                $slug;
            }
        }
        Post::create([
            'title' => $request->title,
            'slug' => $slug,
            'content' => $request->content,
            'category_id' => $request->category_id,
            'thumbnail' => $thumbnail,
            'featured' => 0,
            'user_id' => auth()->id()
        ]);
        return redirect()->route('admin.posts.index')->with('success', 'Posts has been created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $categories = Category::orderBy('title', 'ASC')->get();
        return view('admin.posts.edit', compact('post', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $this->validate($request, [
            'title' => 'required|min:5',
            'content' => 'required|min:5'
        ]);
        $thumbnail = $post->thumbnail;
        if ($request->hasFile('thumbnail')) {
            Storage::delete($post->thumbnail);
            $thumbnail = $request->file('thumbnail')->store('assets/thumbnail');
        }
        $post->update([
            'title' => $request->title,
            'slug' => Str::of($request->title)->slug('-'),
            'content' => $request->content,
            'category_id' => $request->category_id,
            'thumbnail' => $thumbnail
        ]);
        return redirect()->route('admin.posts.index')->with('success', 'Posts has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('admin.posts.index')->with('danger', 'Posts has been deleted!');
    }

    public function featured($post_id)
    {
        $post = Post::where('id', $post_id)->where('featured', 0)->first();
        if ($post) {
            $post->update([
                'featured' => 1
            ]);
        }
    }

    public function unfeatured($post_id)
    {
        $post = Post::where('id', $post_id)->where('featured', 1)->first();
        if ($post) {
            $post->update([
                'featured' => 0
            ]);
        }
    }
}
