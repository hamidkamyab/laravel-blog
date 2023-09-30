<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\CommentRequest;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CommentRequest $request,$postId)
    {
        $post = Post::findOrFail($postId);
        if($post){
            $status = 0;
            $isAdmin = 0;
            if(Auth::check()){
                $status = 1;
                $isAdmin = 1;
                $name = Auth::user()->name;
                $email = null;
            }else{
                $name = $request->name;
                $email = $request->email;
            }
            Comment::create([
                'name' => $name,
                'email' => $email,
                'body' => $request->body,
                'post_id'=>$postId,
                'status' => $status,
                'isAdmin' => $isAdmin,
            ]);
            Session::flash('add_comment','دیدگاه شما بعد از تایید مدیرسایت نمایش داده می شود!');
        }
        return redirect()->back();
    }

    public function reply(CommentRequest $request, string $post_id, string $parent_id)
    {
        $post = Post::findOrFail($post_id);
        if($post){
            $status = 0;
            $isAdmin = 0;
            if(Auth::check()){
                $status = 1;
                $isAdmin = 1;
                $name = Auth::user()->name;
                $email = null;
            }else{
                $name = $request->name;
                $email = $request->email;
            }
            Comment::create([
                'name' => $name,
                'parent_id' => $parent_id,
                'post_id' => $post_id,
                'email' => $email,
                'body' => $request->body,
                'status' =>  $status,
                'isAdmin' => $isAdmin,
            ]);
            Session::flash('reply_comment','پاسخ دیدگاه با موفقیت ثبت و منتشر شد!');
        }
        return redirect()->back();
    }

}
