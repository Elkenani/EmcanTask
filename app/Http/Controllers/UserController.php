<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function hacks()
    {
        $user = User::find(1);
        $user->roles()->attach(1);
    }

    public function show(User $user){
        return view('admin.users.profile', [
            'user' => $user,
            'roles'=> Role::all()
            ]);
    }

    public function index(){
        $users = User::all();
        return view('admin.users.index', ['users'=>$users]);
    }

    public function attach(User $user){
        $user->roles()->attach(request('role'));
        return back();
    }

    public function detach(User $user){
        $user->roles()->detach(request('role'));
        return back();
    }

    public function Destroy(User $user){
        $user->delete();
        session()->flash('user-deleted', 'user has been deleted');
        return back();
    }
    
}
