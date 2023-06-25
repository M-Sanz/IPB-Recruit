<?php

namespace App\Http\Controllers\API;

use App\Helpers\ApiFormatter;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;

class OrganisasiController extends Controller
{
    public function index()
    {
        $data = Post::latest()->get();
        if ($data) {
            return ApiFormatter::createApi(200, 'Success', $data);
        } else {
            return ApiFormatter::createApi(400, 'failed', $data);
        }
    }
}
