@extends('layouts.backend.app')
@push('css')
     <!-- JQuery DataTable Css -->
    
@endpush
@section('title','Create Category')

@section('content')
    <div class="container-fluid">
        <!-- Vertical Layout | With Floating Label -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>ADD NEW CATEGORY</h2>
                    </div>
                    <div class="body">
                    <form action="{{ route('admin.category.store')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" id="name" class="form-control" name="name">
                                    <label class="form-label">Category Name</label>
                                </div>
                                <div class="form-line">
                                    <input type="file" class="form-control" name="image">
                                </div>
                            </div>
                            <a href="{{ route('admin.category.index')}}" class="btn btn-danger m-t-15 waves-effect">BACK</a>
                            <button type="submit" class="btn btn-primary m-t-15 waves-effect">SUBMIT</button>
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
