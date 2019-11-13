@extends('layouts.backend.app')
@push('css')
     <!-- JQuery DataTable Css -->
    
@endpush
@section('title','Edit Category')

@section('content')
    <div class="container-fluid">
        <!-- Vertical Layout | With Floating Label -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>UPDATE CATEGORY</h2>
                    </div>
                    <div class="body">
                    <form action="{{ route('admin.category.update', $category->id)}}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" id="name" class="form-control" name="name" value="{{ $category->name }}">
                                    <label class="form-label">Category Name</label>
                                </div>
                                <div class="form-line">
                                    <input type="file" class="form-control" name="image">
                                </div>
                                <div class="form-group" style="padding-top:20px;">
                                    <img src="{{ URL::to($category->image)}}" alt="" style="height:100px;width:200px">
                                    <input type="hidden" name="old_image" value="{{ $category->image }}">
                                    <h6 class="form-label">Old Image</h6>
                                </div>
                            </div>
                            <a href="{{ route('admin.category.index')}}" class="btn btn-danger m-t-15 waves-effect">BACK</a>
                            <button type="submit" class="btn btn-primary m-t-15 waves-effect">UPDATE</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Vertical Layout | With Floating Label -->
    </div>
@endsection

@push('js')
   
@endpush
