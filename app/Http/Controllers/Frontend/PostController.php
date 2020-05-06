<?php

namespace App\Http\Controllers\Frontend;

use App\Category;
use App\Http\Controllers\Controller;
use App\Post;
use App\Comment;
use App\Like;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::orderBy('created_at', 'DESC')->paginate(5);
        $categories = Category::orderBy('title', 'ASC')->get();
        $featureds = Post::where('featured', 1)->get();
        $posts->load('user', 'comments', 'category');
        $featureds->load('comments');
        return view('frontend.index', compact('posts', 'categories', 'featureds'));
    }

    public function show(Post $post)
    {
        $title = 'Faturrahman - ' . $post->title;
        $comments = Comment::where('post_id', $post->id)->orderBy('created_at', 'DESC')->paginate(8);
        $commentCount = $post->comments->count();
        $categories = Category::orderBy('title', 'ASC')->get();
        $featureds = Post::where('featured', 1)->get();
        $comments->load('user', 'post');
        $featureds->load('comments');
        return view('frontend.show', compact('title', 'post', 'comments', 'commentCount', 'categories', 'featureds'));
    }

    public function addComment(Post $post, Request $request)
    {
        $this->validate($request, [
            'text' => 'required|min:4|max:250'
        ]);

        Comment::create([
            'user_id' => auth()->id(),
            'post_id' => $post->id,
            'text' => $request->text
        ]);
        return redirect()->back()->with('success', 'Comment added!');
    }

    public function like($type, $model_id)
    {
        if ($type == 1) {
            $model_type = Post::find($model_id);
            $model = 'App\Post';
        } else {
            $model_type = Comment::find($model_id);
            $model = 'App\Comment';
        }
        if ($model_type->isLike() == null) {
            Like::create([
                'user_id' => auth()->id(),
                'likeable_id' => $model_id,
                'likeable_type' => $model
            ]);
        }
    }
    public function unlike($type, $model_id)
    {
        if ($type == 1) {
            $model_type = Post::find($model_id);
            $model = 'App\Post';
        } else {
            $model_type = Comment::find($model_id);
            $model = 'App\Comment';
        }
        if ($model_type->isLike()) {
            Like::where('user_id', auth()->id())->where('likeable_id', $model_id)
                ->where('likeable_type', $model)
                ->delete();
        }
    }
}
