<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Subscriber;
use Brian2694\Toastr\Facades\Toastr;

class SubscriberController extends Controller
{
    public function index(){
        $subscribers = Subscriber::latest()->get();
        return view('admin.subscriber', compact('subscribers'));
    }
    public function destroy($id){
        Subscriber::findOrFail($id)->delete();
        Toastr::success('Subscriber Successfully Deleted :)', 'Success', ["closeButton" => true,  "progressBar" => true]);
        return redirect()->back();
    }
}
