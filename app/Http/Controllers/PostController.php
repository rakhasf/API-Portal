<?php

namespace App\Http\Controllers;

use App\Http\Resources\PostResource;
use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    public function index(){
        $post = Post::all();
        // return response()->json(['data' => $post]);
        return PostResource::collection($post);
    }
}
