<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Auth;
use App\User;
use Brian2694\Toastr\Facades\Toastr;

class SettingsController extends Controller
{
    public function index(){
        return view('admin.settings');
    }

    public function updateProfile(Request $request){
        $this->validate($request,[
            'name' => 'required',
            'email' => 'required|email',
            'iamge' => 'required|image|mimes:jpg,jpeg,png,bmp'
        ]);

        $image = $request->file('image');
        $slug = Str::slug($request->name);
        $user = User::findOrFail(Auth::id());

        if(isset($image)){
            
            $currentDate = Carbon::now()->toDateString();
            $imageName = $slug.'-'. $currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();
        }

    }

    public function updatePassword(Request $request){
        $this->validate($request,[
            'old_password' => 'required',
            'password' => 'required|confirmed',
        ]);
        
        $hashedPassword = Auth::user()->password;
        if(Hash::check($request->old_password,$hashedPassword))
        {
            if(!Hash::check($request->password,$hashedPassword))
            {
                $user = User::find(Auth::id());
                $user->password = Hash::make($request->password);
                $user->save();
                Toastr::success('Password  Successfully Updated :)', 'Success', ["closeButton" => true,  "progressBar" => true]);
                Auth::logout();
                return redirect()->back();
            }
            else{
                Toastr::error('New password can not be the same as old password', 'Error', ["closeButton" => true,  "progressBar" => true]);
                return redirect()->back();
            }
        }
        else{
            Toastr::error("Current password doesn't match ", 'Error', ["closeButton" => true,  "progressBar" => true]);
            return redirect()->back();

        }
    }
}
