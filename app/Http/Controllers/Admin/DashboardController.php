<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Photo;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        $usersCount = User::count();
        $postsCount = Post::count();
        $categoriesCount = Category::count();
        $photosCount = Photo::count();

        $posts = Post::orderBy('created_at','desc')->limit(5)->get();
        $users = User::orderBy('created_at','desc')->limit(5)->get();

        return view('admin.dashboard.index',compact('usersCount','postsCount','categoriesCount','photosCount','posts','users'));
    }
}
