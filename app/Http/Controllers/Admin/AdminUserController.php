<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\Photo;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::with('roles')->get();
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
            $fileName = $fileName.'_'.time().'.'.$exFile;
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
        return view('admin.users.edit');
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
