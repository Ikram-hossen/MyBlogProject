@extends('layouts.backend.app')
@push('css')

@endpush
@section('title', 'Show Post')
@section('content')
    <div class="container-fluid">
        <div class="bg-cyan" style="padding: 2px;"> 
           <h3><i class="material-icons">library_books</i> Post</h3>
        </div>
        <br>
            <a href="{{ route('author.post.index')}}" class="btn btn-danger waves-effect">BACK</a>
            @if($post->is_approved == true)
                <button type="button" class="btn btn-success waves-effect pull-right disabled">
                    <i class="material-icons">done</i>
                    <span>Approved</span>
                </button>
            @else 
            <button type="button" class="btn btn-success waves-effect pull-right">
                    <i class="material-icons">done</i>
                    <span>Approve</span>
                </button>
            @endif
            <br><br>
        <!-- Vertical Layout | With Floating Label -->
        <div class="row clearfix">
            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            {{$post->title}}
                            <small>
                            Posted by <strong><a href="#">{{ $post->user->name}}</a></strong> on {{$post->created_at->toFormattedDateString()}}
                            </small>
                        </h2>
                    </div>
                    <div class="body">
                       {!! $post->body !!}
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <div class="card">
                    <div class="header bg-cyan">
                        <h2>Categories</h2>
                    </div>
                    <div class="body">
                        @foreach ($post->categories as $category)
                            <span class="label bg-cyan">{{ $category->name }}</span>
                        @endforeach
                    </div>
                </div>
                <div class="card">
                    <div class="header bg-green">
                        <h2>Tags</h2>
                    </div>
                    <div class="body">
                        @foreach ($post->tags as $tag)
                            <span class="label bg-green">{{ $tag->name }}</span>
                        @endforeach
                    </div>
                </div>
                <div class="card">
                    <div class="header bg-amber">
                        <h2>Featured Image</h2>
                    </div>
                    <div class="body">
                        <img class="img-responsive thumbnail" src="{{ Storage::disk('public')->url('post/'. $post->image)}}" alt="image">
                    </div>
                </div>
            </div>
        </div>
        <!-- Vertical Layout | With Floating Label -->
    </div>
@endsection

@push('js')
    <!-- Select Plugin Js -->
    <script src="{{ asset('assets/backend/plugins/bootstrap-select/js/bootstrap-select.js') }}"></script>
    <!-- Tinymce Plugin Js -->
    <script src="{{ asset('assets/backend/plugins/tinymce/tinymce.min.js') }}"></script>
    <script>tinymce.init({selector:'textarea'});</script>
@endpush
