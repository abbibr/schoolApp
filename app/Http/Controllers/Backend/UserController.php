<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Hash;

class UserController extends Controller
{
    public function viewUser(){
        /* $admin = User::where('email', 'admin@gmail.com')->first();

        if($admin->id == auth()->user()->id){
            $users = User::where('usertype', 'user')
                    ->orWhere('id', '!=', 1)
                    ->get();

            return view('backend.users.view_user',[
                'users' => $users
            ]);
        }
        else{
            $users = User::where('usertype', 'user')->get();

            return view('backend.users.view_user',[
                'users' => $users
            ]);
        } */

        $users = User::where("usertype", "admin")
                    ->whereNotIn('id', [auth()->user()->id])
                    ->get();
                        
        return view('backend.users.view_user',[
            'users' => $users
        ]);
    }

    public function addUser(){
        return view('backend.users.add_user');
    }

    public function storeUser(Request $request){
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users'
        ]);

        $code = rand(00000, 99999);

        User::create([
            'usertype' => 'admin',
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($code),
            'code' => $code,
            'role' => $request->role
        ]);

        $notification = [
            'message' => 'New User Successfully Created',
            'alert-type' => 'success'
        ];

        return redirect()->route('user.view')->with($notification);
    }

    public function editUser($id){
        $user = User::find($id);

        return view('backend.users.edit_user', [
            'user' => $user
        ]);
    }

    public function updateUser(Request $request, $id){
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email'
        ]);

        $user = User::find($id);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
        ]);

        $notification = [
            'message' => 'User Successfully Updated',
            'alert-type' => 'success'
        ];

        return redirect()->route('user.view')->with($notification);   
    }

    public function deleteUser($id){
        $user = User::findOrFail($id);
        $user->delete();

        $notification = [
            'message' => 'User Successfully Deleted',
            'alert-type' => 'info'
        ];

        return redirect()->route('user.view')->with($notification);   
    }
}
