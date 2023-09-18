<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreatePostRequest;
use App\Models\Category;
use App\Models\Photo;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AdminPostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::with('categories', 'photos', 'user')->get();
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::pluck('title', 'id');
        return view('admin.posts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreatePostRequest $request)
    {
        $post = new Post;

        $file = $request->file('photo');
        $fileName = preg_replace('/\\.[^.\\s]{3,4}$/', '', $file->getClientOriginalName());
        $exFile = $file->getClientOriginalExtension();
        $fileName = preg_replace('/\s+/', '', $fileName) . '_' . time() . '.' . $exFile;
        $dir = 'images';
        $file->move($dir, $fileName);
        $path = $dir . '/' . $fileName;
        $photo = Photo::create([
            'name' => $file->getClientOriginalName(),
            'path' => $path,
            'user_id' => Auth::id()
        ]);
        $photo_id = $photo->id;

        if($request->slug == null || $request->slug == ''){
            $slug = make_slug($request->title, '-');
        }else{
            $slug = make_slug($request->slug, '-');
        }
        $post->title = $request->title;
        $post->slug = $slug;
        $post->body = $request->body;
        $post->meta_description = $request->meta_description;
        $post->meta_keywords = $request->meta_keywords;
        $post->status = $request->status;
        $post->user_id = Auth::id();
        $post->save();
        $post->categories()->attach($request->categories);
        $post->photos()->attach($photo_id);

        Session::flash('add_post','پست جدید با موفقیت اضافه شد!');
        return redirect(route('posts.index'));
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
