<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Hash;
use Auth;

class DashboardController extends Controller
{
   
    public function dashboard(){
        return view("admin.dashboard");
    }


    public function profile($slug='')
    {
        // dd($slug);
        $data = Auth::guard('admin')->user();
        return view('admin.profile',compact('data','slug'));
    }

    public function profileupdate(Request $request)
    {
        $id=Auth::guard('admin')->user()->id;
        $request->validate([
            'name' => 'required',
            'email' => 'required|string|email|max:255|unique:admins,email,' . $id,
            'phone' => 'required|numeric|digits:10|unique:admins,phone,' . $id,
            ]
        );
       
        $input = $request->all();
        $data = Auth::guard('admin')->user();
           
        $data->update($input);

        return redirect()->back()->with('success','profile updated successfully');    

    }

    public function updatepassword(Request $request)
    {
        
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required',
            "confirm_password" => ["required","same:new_password"],
        ]
        );

        if (!Hash::check($request->current_password, Auth::guard('admin')->user()->password)) {
            return back()->withErrors(['current_password' => 'The current password is incorrect.']);
        }

        $admin = Auth::guard('admin')->user();
        $admin->password=Hash::make($request->input('password'));
        $admin->update();
        // Return a success message
        return redirect()->back()->with('success','password updated successfully!');    

    }

 

}
