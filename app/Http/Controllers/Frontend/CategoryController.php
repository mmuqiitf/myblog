<?php

namespace App\Http\Controllers\Frontend;

use App\Category;
use App\Http\Controllers\Controller;
use App\Post;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function show(Category $category)
    {
        $posts = $category->posts()->orderBy('created_at', 'DESC')->paginate(5);
        $categories = Category::orderBy('title', 'ASC')->get();
        $featureds = Post::where('featured', 1)->get();
        $posts->load('user', 'comments', 'category');
        $featureds->load('comments');
        return view('frontend.category.show', compact('posts', 'categories', 'featureds', 'category'));
    }
}
