@extends('layouts.backend.app')
@push('css')
    
@endpush
@section('title', 'Author Settings')

@section('content')
     <div class="container-fluid">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        AUTHOR SETTINGS
                    </h2>
                </div>
                <div class="body">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active">
                            <a href="#profile_with_icon_title" data-toggle="tab" aria-expanded="false">
                                <i class="material-icons">face</i> UPDATE PROFILE
                            </a>
                        </li>
                        <li role="presentation" class="">
                            <a href="#password_with_icon_title" data-toggle="tab" aria-expanded="false">
                                <i class="material-icons">lock</i> CHANGE PASSWORD
                            </a>
                        </li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane fade active in" id="profile_with_icon_title">
                            {{-- form --}}
                            <form method="POST" action="{{ route('author.profile.update')}}" enctype="multipart/form-data" class="form-horizontal">
                               @csrf
                               @method('PUT')
                                <div class="row clearfix">
                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 form-control-label">
                                        <label for="name_address_2">Name : </label>
                                    </div>
                                    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" id="name_address_2" class="form-control" name="name" value="{{Auth::user()->name}}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 form-control-label">
                                        <label for="email_address_2">Email Address : </label>
                                    </div>
                                    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="email" id="email_address_2" class="form-control" name="email" value="{{Auth::user()->email}}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 form-control-label">
                                        <label>Profile Image : </label>
                                    </div>
                                    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="file" name="image">
                                             </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 form-control-label">
                                            <label for="about_address_2">About : </label>
                                        </div>
                                        <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <textarea name="about" id="about_address_2" rows="4"  class="form-control" placeholder="Body here">{{ Auth::user()->about}}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row clearfix">
                                            <div class="col-lg-offset-3 col-md-offset-3 col-sm-offset-4 col-xs-offset-6">
                                                <button type="submit" class="btn btn-primary m-t-15 waves-effect">UPDATE</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            <div role="tabpanel" class="tab-pane fade" id="password_with_icon_title">
                            {{-- form --}}
                            <form method="POST" action="{{ route('author.password.update')}}" class="form-horizontal">
                                @csrf
                                @method('PUT')
                                 <div class="row clearfix">
                                     <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 form-control-label">
                                         <label for="old_password_address_2">Old Password : </label>
                                     </div>
                                     <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                         <div class="form-group">
                                             <div class="form-line">
                                                 <input type="password" id="old_password_address_2" class="form-control" name="old_password">
                                             </div>
                                         </div>
                                     </div>
                                 </div>
                                 <div class="row clearfix">
                                     <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 form-control-label">
                                         <label for="password_address_2">New Password : </label>
                                     </div>
                                     <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                         <div class="form-group">
                                             <div class="form-line">
                                                 <input type="password" id="password_address_2" class="form-control" name="password">
                                             </div>
                                         </div>
                                     </div>
                                 </div>
                                 <div class="row clearfix">
                                     <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 form-control-label">
                                         <label for="confirm_password_address_2">Confirm Password : </label>
                                     </div>
                                     <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                         <div class="form-group">
                                             <div class="form-line">
                                                 <input type="password" id="confirm_password_address_2" class="form-control" name="password_confirmation">
                                             </div>
                                         </div>
                                     </div>
                                 </div>
                                     <div class="row clearfix">
                                        <div class="col-lg-offset-3 col-md-offset-3 col-sm-offset-4 col-xs-offset-5">
                                            <button type="submit" class="btn btn-primary m-t-15 waves-effect">UPDATE</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
     </div>
@endsection

@push('js')
    
@endpush
