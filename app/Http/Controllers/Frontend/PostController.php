<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function show($slug){
        $post = Post::with('user','photos','categories')->where('slug',$slug)->where('status',1)->first();
        $categories = Category::all();
        return view('frontend.post.show',compact('post','categories'));
    }
}
