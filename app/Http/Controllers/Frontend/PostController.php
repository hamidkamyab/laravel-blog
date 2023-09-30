<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as Input;

class PostController extends Controller
{
    public function show($slug){
        $post = Post::with(['user','photos','categories','comments'=>function($q){
            $q->where('status',1)
            ->where('parent_id',null);
        }, 'comments.replies'=>function($e){
            $e->where('status',1);
        }])->where('slug',$slug)->where('status',1)->first();
        $categories = Category::all();
        return view('frontend.post.show',compact('post','categories'));
    }

    public function search(){
        $query = Input::get('title');
        $posts = Post::with('user','categories','photos')
        ->where('title','like','%'.$query.'%')
        ->where('status','1')
        ->orderBy('created_at','desc')
        ->paginate(2);
        $categories = Category::all();
        return view('frontend.post.search',compact('posts','categories','query'));
    }
}
