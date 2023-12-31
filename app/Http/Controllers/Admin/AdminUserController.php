<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\EditUserRequest;
use App\Http\Requests\UserRequest;
use App\Models\Photo;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class AdminUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::with('roles')->paginate(5);
        return view('admin.users.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::pluck('title','id');
        return view('admin.users.create',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        $user = new User();
        if($request->avatar){
            $file = $request->avatar;
            $fileName = preg_replace('/\\.[^.\\s]{3,4}$/', '', $file->getClientOriginalName());
            $exFile = $file->getClientOriginalExtension();
            $fileName = preg_replace('/\s+/', '', $fileName).'_'.time().'.'.$exFile;
            $dir = 'images';
            $file->move($dir,$fileName);
            $path = $dir.'/'.$fileName;
            $photo = Photo::create([
                'name' => $file->getClientOriginalName(),
                'path' => $path,
                'user_id' => 1
            ]);
            $user->photo_id = $photo->id;
        }
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->status = $request->status;
        $user->save();
        $user->roles()->attach($request->roles);
        Session::flash('add_user','کاربر '.$user->name.' با موفقیت اضافه شد!');
        return redirect(route('users.index'));
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
        $user = User::findOrFail($id);
        $r = Role::pluck('title','id');
        $roles = [];
        foreach($r as $key=>$roleItem){
            $roles[$key]['title'] = $roleItem;
            foreach($user->roles as $role){
                if($key == $role->id){
                    $roles[$key]['selected'] = 1;
                }
            }
        }
        return view('admin.users.edit',compact('user','roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EditUserRequest $request, string $id)
    {
        $user = User::findOrFail($id);
        if($request->avatar){
            if($user->photo_id){
                if (File::exists($user->photo->path)) {
                    File::delete($user->photo->path);
                }
                $user->photo->delete();
            }
            $file = $request->avatar;
            $fileName = preg_replace('/\\.[^.\\s]{3,4}$/', '', $file->getClientOriginalName());
            $exFile = $file->getClientOriginalExtension();
            $fileName = preg_replace('/\s+/', '', $fileName).'_'.time().'.'.$exFile;
            $dir = 'images';
            $file->move($dir,$fileName);
            $path = $dir.'/'.$fileName;
            $photo = Photo::create([
                'name' => $file->getClientOriginalName(),
                'path' => $path,
                'user_id' => 1
            ]);
            $user->photo_id = $photo->id;
        }
        $user->name = $request->name;
        $user->email = $request->email;
        if($request->password != null){
            $user->password = bcrypt($request->password);
        }
        $user->status = $request->status;
        $user->save();
        $user->roles()->sync($request->roles);
        Session::flash('edit_user','کاربر '.$user->name.' با موفقیت ویرایش شد!');
        return redirect(route('users.index'));

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        if($user->photo_id != null){
            $photo = $user->photo->path;
            if (File::exists($photo)) {
                File::delete($photo);
            }
            $user->photo->delete();
        }
        $name = $user->name;
        $user->delete();
        Session::flash('delete_user','کاربر '.$name.' با موفقیت حذف شد!');
        return redirect(route('users.index'));
    }
}
