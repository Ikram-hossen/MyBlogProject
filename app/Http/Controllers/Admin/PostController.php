<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\DB;
use App\Notifications\AuthorPostApproved;
use App\Notifications\NewPostNotify;
use Illuminate\Support\Facades\Notification;

use Auth;
use App\Post;
use App\Category;
use App\Subscriber;
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
        $posts = Post::latest()->get();
        return view('admin.post.index' , compact('posts'));
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
        return view('admin.post.create', compact('categories','tags')); 
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
            'image' => 'image|mimes:jpg,jpeg,png,bmp',
            'categories' => 'required',
            'tags' => 'required',
            'body' => 'required'
        ]);

// get form data
        $post = new Post();
        $image = $request->file('image');
        $slug  = Str::slug($request->title);

        if(isset($image))
        {
// make unique name for image
            $currentDate =  Carbon::now()->toDateString();
            $imageName = $slug .'-'. $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();

            $upload_path = 'media/post';
            $image_url = $imageName . $upload_path;
            $image->move($upload_path,$imageName);
            $post->image = $image_url;
        }
        else{
            $imageName = 'default.png';
        }

      
        $post->user_id = Auth::id();
        $post->title = $request->title;
        $post->slug = $slug;//is already define above
        $post->body = $request->body;
        $post->image = $imageName;
        if(isset($request->status))
        {
            $post->status = true;
        }else{
            $post->status = false;
        }
        $post->is_approved = true;
        $post->categories()->attach($request->categories);
        $post->tags()->attach($request->tags);
        $post->save();

         // send notification to Subscribers
         $subscribers = Subscriber::all();
         foreach( $subscribers as  $subscriber){
            Notification::route('mail', $subscriber->email)
                    ->notify(new NewPostNotify($post));
         }

        Toastr::success('Post Successfully saved :)', 'Success', ["closeButton" => true,  "progressBar" => true]);
        return redirect()->route('admin.post.index');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('admin.post.show', compact('post')); 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.post.edit', compact('post','categories','tags')); 
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
        $post->is_approved = true;
        $post->categories()->attach($request->categories);
        $post->tags()->attach($request->tags);

        $post->save();
        Toastr::success('Post Successfully Updated :)', 'Success', ["closeButton" => true,  "progressBar" => true]);
        return redirect()->route('admin.post.index');
        
    }
    public function pending(){

        $posts = Post::where('is_approved',false)->get();
        return view('admin.post.pending',compact('posts'));
    }
    public function approval($id){
        $post = Post::find($id);
        if($post->is_approved == false){
            $post->is_approved = true;
            $post->save();
            //send notification to author
            $post->user->notify(new AuthorPostApproved($post));

            // send notification to Subscribers
            $subscribers = Subscriber::all();
            foreach( $subscribers as  $subscriber){
                Notification::route('mail', $subscriber->email)
                        ->notify(new NewPostNotify($post));
            }

            Toastr::success('Post Successfully Approved :)', 'Success', ["closeButton" => true,  "progressBar" => true]);
        }else{
            Toastr::info('Post Already Approved :)', 'Info', ["closeButton" => true,  "progressBar" => true]);
        }
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,Post $post)
    {
       $post = DB::table('posts')->where('id',$post)->first();
       $post->image = $request->image;
       unlink($post->image);
       $post->categories()->detach();
       $post->tags()->detach();
       $post->delete();
       Toastr::success('Post Successfully Deleted :)', 'Success', ["closeButton" => true,  "progressBar" => true]);
       return redirect()->back();
    }
}
