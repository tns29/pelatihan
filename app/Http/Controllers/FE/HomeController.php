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
        $post = Post::with('picturePost')->orderBy('id', 'DESC')->get();
        
        return view('user-page/posts', [
            'title' => 'Berita & Inovasi Dinas Tenaga Kerja',
            'posts' => $post,
            'brand_name' => 'UPTD'
        ]);
    }

    function detailPosts(int $id) {
        $resultPost = Post::with('picturePost')->where('id', $id)->first();

        if($resultPost) {
            $currentSeen = $resultPost->seen;
            $seenValUpdate = $currentSeen+1;
            Post::where('id', $id)->update(['seen' => $seenValUpdate]);
        }

        $post = Post::with('picturePost')->orderBy('id', 'DESC')->get();
        // dd($post);
        return view('user-page/detail_posts', [
            'title' => 'Berita & Inovasi Dinas Tenaga Kerja',
            'post' => $post,
            'resultPost' => $resultPost,
            'brand_name' => 'UPTD'
        ]);
    }
}
