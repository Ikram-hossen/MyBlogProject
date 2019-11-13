@extends('layouts.backend.app')
@push('css')
     <!-- Bootstrap Select Css -->
     <link href="{{asset('assets/backend/plugins/bootstrap-select/css/bootstrap-select.css')}}" rel="stylesheet" />
    
@endpush
@section('title', 'Edit Post')


@section('content')
    <div class="container-fluid">
        <!-- Vertical Layout | With Floating Label -->
        <form action="{{ route('admin.post.update',$post->id)}}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row clearfix">
                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>EDIT POST</h2>
                        </div>
                        <div class="body">
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" id="title" class="form-control" name="title" value="{{$post->title}}">
                                    <label class="form-label">Post Title</label>
                                </div>
                                <div class="form-line">
                                    <textarea class="form-control" name="body" rows="3">{!! $post->body !!}</textarea>
                                    <label class="form-label">Body</label>
                                </div>
                               
                                <div class="form-group">
                                    <label class="form-label">featured image</label>
                                    <input type="file" class="form-control" name="image" value="{{$post->image}}">
                                </div>
                                <div class="form-group">
                                    <input id="publish" type="checkbox" class="filled-in" name="status" value="1" {{$post->status == true ? 'checked' : ''}}>
                                    <label for="publish">Publish</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <div class="card" style="padding-bottom:48px;">
                        <div class="header">
                            <h2>Categories & Tags</h2>
                        </div>
                        <div class="body">
                            <div class="form-group form-float">
                                <div class="form-line {{ $errors->has('categories') ? 'focused error' : ''}}">
                                    <label for="category">Select Category</label>
                                    <select name="categories[]" id="category" class="form-control show-tick" data-live-search="true" multiple>
                                        @foreach ($categories as $category)
                                            <option 
                                                @foreach($categories as $postCategory)
                                                    {{ $postCategory->id == $category->id ? 'selected' : ''}}
                                                @endforeach
                                            value="{{ $category->id}}">{{ $category->name}}</option> 
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group form-float">
                                <div class="form-line {{ $errors->has('tags') ? 'focused error' : ''}}">
                                    <label for="tag">Select Tags</label>
                                    <select name="tags[]" id="tag" class="form-control show-tick" data-live-search="true" multiple>
                                        @foreach ($tags as $tag)
                                            <option
                                                @foreach($tags as $postTag)
                                                    {{ $postTag->id == $tag->id ? 'selected' : ''}}
                                                @endforeach
                                            value="{{ $tag->id}}">{{ $tag->name}}</option> 
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <a href="{{ route('admin.post.index')}}" class="btn btn-danger m-t-15 waves-effect">BACK</a>
                            <button type="submit" class="btn btn-primary m-t-15 waves-effect">SUBMIT</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <!-- Vertical Layout | With Floating Label -->
    </div>
@endsection

@push('js')
    <!-- Select Plugin Js -->
    <script src="{{ asset('assets/backend/plugins/bootstrap-select/js/bootstrap-select.js') }}"></script>
@endpush
