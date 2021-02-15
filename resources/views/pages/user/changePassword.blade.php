@extends('layouts.user')

@section('content')
<div class="content-header">
  <h1 class="col-sm-6">Account Setting</h1>
</div>
<div class="container">
<div class="row">
    <div class="col-lg-8 mx-auto">
        <div class="card card-info">
            <div class="card-header">Change Your Password</div>
            <div class="card-body">
                <form action="/updatePassword" method="post">
                    @csrf
                    {{ method_field("PUT") }}
                    <div class="form-group row">
                        <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                    <div class="col-md-6">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    </div>

                    <div class="form-group row">
                        <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                        <div class="col-md-6">
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                        </div>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-dark elevation-2" style="border-radius: 0px;">Update <i class="fas fa-edit"></i></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>      
</div>
@endsection