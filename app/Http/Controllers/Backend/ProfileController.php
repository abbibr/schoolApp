<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use Hash;

class ProfileController extends Controller
{
    public function profileView(){
        $id = Auth::id();
        $user = User::findOrFail($id);

        return view('backend.users.view_profile', [
            'user' => $user
        ]);
    }

    public function profileEdit(){
        $id = Auth::id();
        $edit = User::findOrFail($id);

        return view('backend.users.edit_profile', [
            'edit' => $edit
        ]);
    }

    public function profileUpdate(Request $request){
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'mobile' => 'required',
            'address' => 'required',
            'gender' => 'required'
        ]);

        $id = Auth::id();
        $update = User::findOrFail($id);
        $file = $request->file('image');

        if(!empty($file)){
            $name = date('YmdHi').$file->getClientOriginalName();
            $path = $file->storeAs('images', $name);

            $update->update([
                'name' => $request->name,
                'email' => $request->email,
                'mobile' => $request->mobile,
                'address' => $request->address,
                'gender' => $request->gender,
                'image' => $path
            ]);

            $notification = [
                'message' => 'Profile Successfully Updated with Profile Image',
                'alert-type' => 'success'
            ];

            return redirect()->route('profile.view')->with($notification);
        }
        else
        {
            $update->update([
                'name' => $request->name,
                'email' => $request->email,
                'mobile' => $request->mobile,
                'address' => $request->address,
                'gender' => $request->gender
            ]);

            $notification = [
                'message' => 'Profile Successfully Updated without Profile Image',
                'alert-type' => 'success'
            ];

            return redirect()->route('profile.view')->with($notification);
        }
    }

    public function changePassword(){
        return view('backend.users.change_password');
    }

    public function storePassword(Request $request){
        $this->validate($request, [
            'old_password' => 'required',
            'new_password' => 'required|min:8|same:new_confirm_password'
        ]);

        $id = auth()->user()->id;
        $user = User::findOrFail($id);
        $old_password = $request->old_password;

        if(Hash::check($old_password, $user->password)){
            $user->update([
                'password' => Hash::make($request->new_password)
            ]);

            auth()->logout();

            $notification = [
                'message' => 'Password Successfully Updated',
                'alert-type' => 'success'
            ];

            return redirect()->route('login')->with($notification);
        }
        else
        {
            $notification = [
                'message' => 'Your Old Password is Incorrect!',
                'alert-type' => 'error'
            ];

            return redirect()->back()->with($notification);
        }
    }
}
