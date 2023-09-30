<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Photo;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index(){
        $usersCount = User::count();
        $postsCount = Post::count();
        $commentsCount = Comment::count();
        $photosCount = Photo::count();

        $posts = Post::orderBy('created_at','desc')->limit(5)->get();
        $users = User::orderBy('created_at','desc')->limit(5)->get();

        return view('admin.dashboard.index',compact('usersCount','postsCount','commentsCount','photosCount','posts','users'));
    }
}
