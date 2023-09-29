<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\CommentRequest;
use App\Models\Comment;
use Illuminate\Http\Request;
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
    public function store(CommentRequest $request)
    {
        Comment::create([
            'name' => $request->name,
            'email' => $request->email,
            'body' => $request->body,
            'post_id'=>$request->post_id,
            'status' => 0,
            'isAdmin' => 0,
        ]);
        Session::flash('add_comment','دیدگاه شما بعد از تایید مدیرسایت نمایش داده می شود!');
        return redirect()->back();
    }

}
