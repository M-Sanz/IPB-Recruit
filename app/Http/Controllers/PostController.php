<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Helpers\ApiFormatter;
use App\Models\User;

class PostController extends Controller
{
    public function index()
    {
        return view('posts', [
            "title" => "Organisasi Mahasiswa",
            'active' => 'organisasi',
            "posts" => Post::latest()->get()

        ]);
    }
    public function show(Post $post)
    {
        return view('post', [
            "title" => "Detail Organisasi",
            'active' => 'posts',
            'post' => $post

        ]);
    }
}
