<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Brian2694\Toastr\Facades\Toastr;
use App\Category;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::latest()->get();
        return view('admin.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name'  => 'required|unique:categories',
            'image' => 'required|image|mimes:jpg,jpeg,png'
        ]);

        $data = array();
        $data['name'] = $request->name;
        $data['slug'] = Str::slug($request->name);
        $image = $request->file('image');
        if($image){
            $image_name = Str::random(5);
            $currentDate =  Carbon::now()->toDateString();
            $ext = strtolower($currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension());
            $image_full_name = $image_name . '.' . $ext;
            $upload_path = 'media/category/';
            $image_url = $upload_path . $image_full_name;
            $success = $image->move($upload_path,$image_full_name);
            if($success){
                $data['image'] = $image_url;
                $category = DB::table('categories')->insert($data);
                if($category){
                    Toastr::success('Category Successfully saved :)', 'Success', ["closeButton" => true,  "progressBar" => true]);
                    return redirect()->route('admin.category.index');
                }
            }
        }
    }
       


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::find($id);
        return view('admin.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'name'  => 'required',
            'image' => 'image|mimes:jpg,jpeg,png'
        ]);
        $old_image = $request->old_image;
        $data = array();
        $data['name'] = $request->name;
        $data['slug'] = Str::slug($request->name);
        $image = $request->file('image');
        if($image){
            unlink($old_image);
            $image_name = Str::random(5);
            $currentDate =  Carbon::now()->toDateString();
            $ext = strtolower($currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension());
            $image_full_name = $image_name . '.' . $ext;
            $upload_path = 'media/category/';
            $image_url = $upload_path . $image_full_name;
            $success = $image->move($upload_path,$image_full_name);
            if($success){
                $data['image'] = $image_url;
                $category = DB::table('categories')->where('id',$id)->update($data);
                if($category){
                    Toastr::success('Category Successfully Updated :)', 'Success', ["closeButton" => true,  "progressBar" => true]);
                    return redirect()->route('admin.category.index');
                }
            }
        }

        Toastr::success('Category Successfully Updated :)', 'Success',["closeButton" => true,  "progressBar" => true]);
        return redirect()->route('admin.category.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = DB::table('categories')->where('id',$id)->first();
        $image = $data->image;
        unlink($image);
        DB::table('categories')->where('id',$id)->delete();
        Toastr::success('Category Successfully Deleted :)', 'Success', ["closeButton" => true,  "progressBar" => true]);
        return redirect()->back();
    }
}
