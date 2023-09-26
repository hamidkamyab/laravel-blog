<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;

class AdminPhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $photos = Photo::with('user')->paginate(5);
        return view('admin.photos.index',compact('photos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.photos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = preg_replace('/\\.[^.\\s]{3,4}$/', '', $file->getClientOriginalName());
            $exFile = $file->getClientOriginalExtension();
            $fileName = preg_replace('/\s+/', '', $fileName).'_'.time().'.'.$exFile;
            $dir = 'images';
            $res = $file->move($dir,$fileName);
            if($res){
                $path = $dir.'/'.$fileName;
                Photo::create([
                    'name' => $file->getClientOriginalName(),
                    'path' => $path,
                    'user_id' => Auth::id()
                ]);
            }
        }
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
        $photo = Photo::findOrFail($id);
        File::delete($photo->path);
        $res = $photo->delete();
        if($res){
            Session::flash('delete_photo','تصویر با موفقیت حذف شد');
        }else{
            Session::flash('delete_photo','عملیات با اشکالی مواجه شد، لطفا مجددا تلاش کنید!');
        }
        return redirect(route('photos.index'));
    }
}
