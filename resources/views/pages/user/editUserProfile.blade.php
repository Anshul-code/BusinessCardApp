@extends('layouts.user')

@section('content')
<div class="content-header">
  <h1 class="col-sm-6">Edit Profile</h1>
</div>
  <div class="container">
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <div class="card card-olive">
                <div class="card-header">Update Your Profile</div>
                <div class="card-body">
                    <div class="text-center py-2">
                        <img src="{{ asset('/storage/profile_images/'.Auth::user()->profile_image) }}" alt="profileImage" class="img-circle elevation-2" height="160px" width="160px">
                        <br>
                        @error('profile_image')
                            <small class="text-danger">
                                <strong>{{ $message }}</strong>
                            </small>
                        @enderror
                    </div>
                    <!-- Button trigger modal -->
                    <div class="text-center py-2">
                        <button type="button" class="btn btn-dark btn-sm" data-toggle="modal" data-target="#modelProfile">
                            <span class="fas fa-image"></span>&nbsp;
                            Change Image
                        </button>
                    </div>
                    
                    
                    <!-- Modal -->
                    <div class="modal fade" id="modelProfile" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Change Profile Image</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                </div>
                                
                                <div class="modal-body">
                                    <form action="/editUserProfile/uploadImage" method="post" enctype="multipart/form-data">
                                        @csrf
                                        {{ method_field("PUT") }}
                                        <div class="form-group">
                                          <label for="profile_image">Profile Image</label>
                                          <input type="file" class="form-control-file" name="profile_image" id="profile_image">
                                        </div>
    
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary">Save</button>
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        </div>
                                    </form>
                                </div>
                                
                            </div>
                        </div>
                    </div>

                    <form method="POST" action="/updateUserProfile">
                        @csrf
                        {{ method_field("PUT") }}
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Name</label>
        
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $data_user->name }}" pattern="[A-Za-z\s]+" title="Alphabets and space only" required autocomplete="name" autofocus >
        
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                @error('name_slug')
                                    <small class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </small>
                                @enderror
                               
                            </div>
                        </div>
        
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">Email Address</label>
        
                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $data_user->email }}" required autocomplete="email">
        
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
        
                        <div class="form-group row">
                            <label for="address" class="col-md-4 col-form-label text-md-right">Address</label>
        
                            <div class="col-md-6">
                                <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ $data_user->address }}" required autocomplete="address" autofocus>
        
                                @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
        
                        <div class="form-group row">
                            <label for="dob" class="col-md-4 col-form-label text-md-right">Date Of Birth</label>
        
                            <div class="col-md-6">
                                <input id="dob" type="date" class="form-control @error('dob') is-invalid @enderror" name="dob" value="{{ $data_user->dob }}" required autocomplete="dob" autofocus>
        
                                @error('dob')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
        
                        <div class="form-group row">
                            <label for="phone_number" class="col-md-4 col-form-label text-md-right">Phone Number</label>
        
                            <div class="col-md-6">
                                <input id="phone_number" type="text" class="form-control @error('phone_number') is-invalid @enderror" name="phone_number" value="{{ $data_user->phone_number }}" required autocomplete="phone_number" autofocus>
        
                                @error('phone_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
        
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">
                                Update
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>      
  </div>
@endsection