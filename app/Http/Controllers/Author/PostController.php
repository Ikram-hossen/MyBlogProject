<?php

namespace App\Http\Controllers\Author;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Notification;
use App\Notifications\NewAuthorPost;
use Auth;
use App\User;
use App\Post;
use App\Category;
use App\Tag;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Auth::User()->posts()->latest()->get();
        return view('author.post.index' , compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('author.post.create', compact('categories','tags')); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'image' => 'required|image|mimes:jpg,jpeg,png,bmp',
            'categories' => 'required',
            'tags' => 'required',
            'body' => 'required'
        ]);

// get form data
        $image = $request->file('image');
        $slug  = Str::slug($request->title);

        if(isset($image))
        {
// make unique name for image
            $currentDate =  Carbon::now()->toDateString();
            $imageName = $slug .'-'. $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
// check category dir is exixts
            if(!Storage::disk('public')->exists('post'))
            {
                Storage::disk('public')->makeDirectory('post');
            }
// resize image for category and upload
            $postImage = Image::make($image)->resize(1600, 1066)->save($imageName);
            Storage::disk('public')->put('post/'.$imageName,$postImage);
        }
        else{
            $imageName = 'default.png';
        }

        $post = new Post();
        $post->user_id = Auth::id();
        $post->title = $request->title;
        $post->slug = $slug;//is already define above
        $post->image = $imageName;
        $post->body = $request->body;
        if(isset($request->status))
        {
            $post->status = true;
        }else{
            $post->status = false;
        }
        $post->is_approved = false;
        $post->categories()->attach($request->categories);
        $post->tags()->attach($request->tags);

        $post->save();
        
        // send notification to Admin
        $users = User::where('role_id','1')->get();
        Notification::send($users, new NewAuthorPost($post));


        Toastr::success('Post Successfully saved :)', 'Success', ["closeButton" => true,  "progressBar" => true]);
        return redirect()->route('author.post.index');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        if($post->user_id != Auth::id()){
            Toastr::error('Sorry..!, You cann\'t access only without your post', 'Error', ["closeButton" => true,  "progressBar" => true]);
            return redirect()->back();
        }
        return view('author.post.show', compact('post')); 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        if($post->user_id != Auth::id()){
            Toastr::error('Sorry..!, You cann\'t access only without your post', 'Error', ["closeButton" => true,  "progressBar" => true]);
            return redirect()->back();
        }
        $categories = Category::all();
        $tags = Tag::all();
        return view('author.post.edit', compact('post','categories','tags')); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        if($post->user_id != Auth::id()){
            Toastr::error('Sorry..!, You cann\'t access only without your post', 'Error', ["closeButton" => true,  "progressBar" => true]);
            return redirect()->back();
        }

        $this->validate($request, [
            'title' => 'required',
            'image' => 'image|mimes:jpg,jpeg,png,bmp',
            'categories' => 'required',
            'tags' => 'required',
            'body' => 'required'
        ]);

// get form data
        $image = $request->file('image');
        $slug  = Str::slug($request->title);

        if(isset($image))
        {
// make unique name for image
            $currentDate =  Carbon::now()->toDateString();
            $imageName = $slug .'-'. $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
// check category dir is exixts
            if(!Storage::disk('public')->exists('post'))
            {
                Storage::disk('public')->makeDirectory('post');
            }
// delete old image from storage
            if(!Storage::disk('public')->exists('post/'. $post->image))
            {
                Storage::disk('public')->delete('post/'. $post->image);
            }
// resize image for category and upload
            $postImage = Image::make($image)->resize(1600, 1066)->save($imageName);
            Storage::disk('public')->put('post/'.$imageName,$postImage);
        }
        else{
            $imageName = $post->image;
        }

        $post->user_id = Auth::id();
        $post->title = $request->title;
        $post->slug = $slug;//is already define above
        $post->image = $imageName;
        $post->body = $request->body;
        if(isset($request->status))
        {
            $post->status = true;
        }else{
            $post->status = false;
        }
        $post->is_approved = false;
        $post->categories()->attach($request->categories);
        $post->tags()->attach($request->tags);

        $post->save();
        Toastr::success('Post Successfully Updated :)', 'Success', ["closeButton" => true,  "progressBar" => true]);
        return redirect()->route('author.post.index');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        if($post->user_id != Auth::id()){
            Toastr::error('Sorry..!, You cann\'t access only without your post', 'Error', ["closeButton" => true,  "progressBar" => true]);
            return redirect()->back();
        }
        
        if(!Storage::disk('public')->exists('post/'. $post->image))
        {
            Storage::disk('public')->delete('post/'. $post->image);
        }
       $post->categories()->detach();
       $post->tags()->detach();
       $post->delete();
       Toastr::success('Post Successfully Deleted :)', 'Success', ["closeButton" => true,  "progressBar" => true]);
       return redirect()->back();
    }
}
