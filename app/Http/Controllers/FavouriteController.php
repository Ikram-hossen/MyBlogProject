<?php

namespace App\Http\Controllers;

use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class FavouriteController extends Controller
{
    public function add($post){
        $user = Auth::user();
        $isFavourite = $user->favourite_posts()->where('post_id', $post)->count();

        if($isFavourite == 0){
            $user->favourite_posts()->attach($post);
            Toastr::success('Post Successfully added to your favourite list :)', 'Success');
            return redirect()->back();
        }else{
            $user->favourite_posts()->detach($post);
            Toastr::success('Post Successfully removed from your favourite list :)', 'Success');
            return redirect()->back();
        }
    }
}
