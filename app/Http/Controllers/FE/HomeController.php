<?php

namespace App\Http\Controllers\FE;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    function index() {
        $category = Category::get();
        return view('user-page/index', [
            'title' => 'Home',
            'category' => $category,
            'brand_name' => 'UPTD'
        ]);
    }

    function posts() {
        $post = Post::get();
        return view('user-page/posts', [
            'title' => 'Pemberitahuan',
            'posts' => $post,
            'brand_name' => 'UPTD'
        ]);
    }
}
