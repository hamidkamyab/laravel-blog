<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Models\Category;
use App\Models\Photo;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;

class AdminPostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::with('categories', 'photos', 'user')->paginate(5);
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
    public function store(PostRequest $request)
    {
        $post = new Post;

        if($request->file('photo')){
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
        }
        $post->title = $request->title;
        $post->slug = $request->slug;
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
        $post = Post::findOrFail($id);
        $cat = Category::pluck('title','id');
        $categories = [];
        foreach($cat as $key=>$catItem){
            $categories[$key]['title'] = $catItem;
            foreach($post->categories as $category){
                if($key == $category->id){
                    $categories[$key]['selected'] = 1;
                }
            }
        }
        return view('admin.posts.edit',compact('post','categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PostRequest $request, string $id)
    {
        $post = Post::findOrFail($id);
        if($request->photo != null){
            $photo = $post->photos[0];
            if($photo->id){
                if (File::exists($photo->path)) {
                    File::delete($photo->path);
                }
                $photo->delete();
            }
            $file = $request->photo;
            $fileName = preg_replace('/\\.[^.\\s]{3,4}$/', '', $file->getClientOriginalName());
            $exFile = $file->getClientOriginalExtension();
            $fileName = preg_replace('/\s+/', '', $fileName).'_'.time().'.'.$exFile;
            $dir = 'images';
            $file->move($dir,$fileName);
            $path = $dir.'/'.$fileName;
            $newPhoto = Photo::create([
                'name' => $file->getClientOriginalName(),
                'path' => $path,
                'user_id' => Auth::id()
            ]);
            $post->photos()->attach($newPhoto->id);
        }

        $post->title = $request->title;

        if($request->slug == null || $request->slug == ''){
            $slug = make_slug($request->title);
        }else{
            $slug = make_slug($request->slug);
        }
        $post->slug = $slug;
        $post->body = $request->body;
        $post->meta_description = $request->meta_description;
        $post->meta_keywords =  $request->meta_keywords;
        $post->status = $request->status;
        $post->save();
        $post->categories()->sync($request->categories);
        Session::flash('edit_post','مطلب با موفقیت ویرایش شد!');
        return redirect(route('posts.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $post = Post::findOrFail($id);
        foreach ($post->photos as $key => $photo) {
            $photo->delete();
        }
        if($post->photos[0] != null){
            foreach ($post->photos as $key => $photo) {
                if (File::exists($photo->path)) {
                    File::delete($photo->path);
                }
            }
        }
        $post->delete();
        Session::flash('delete_post','مطلب با موفقیت حذف شد!');
        return redirect(route('posts.index'));
    }
}
