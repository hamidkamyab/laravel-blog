<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AdminCommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $comments = Comment::with('post')->paginate(5);
        return view('admin.comments.index',compact('comments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function action(Request $request, string $id)
    {
        $comment = Comment::findOrFail($id);
        $comment->status = $request->action;
        $comment->save();
        if($request->action == 1){
            Session::flash('action_comment','دیدگاه مورد نظر با موفقیت منتشر شد!');
        }else{
            Session::flash('action_comment','دیدگاه مورد نظر از حالت انتشار خارج شد!');
        }
        return redirect(route('comments.index'));
    }
}

