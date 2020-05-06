<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\Post;
use App\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $users = User::get();
        $posts = Post::get();
        $categories = Category::get();
        return view('admin.index', compact('users', 'posts', 'categories'));
    }
}
