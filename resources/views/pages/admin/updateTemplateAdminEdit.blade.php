@extends('layouts.userEdit')

@section('content')
<div class="content-header">
    <h1 class="col-sm-6">Change Profile Template</h1>
  </div>
  <div class="container">
  <div class="row">
      <div class="col-lg-10 mx-auto">
          <div class="card card-olive">
              <div class="card-header">Update Template</div>
              <form action="/changeTemplateAdminEdit/{{ $user_data->id }}" method="post">
                  @csrf
                  {{ method_field("PUT") }}
                  <div class="card-body bg-dark">
                      @error('template')
                      <div class="alert text-center" style="background-color: rgba(240, 64, 29, 0.2);" role="alert">
                          <strong>{{ $message }}</strong>
                      </div>
                      @enderror
                      <div class="form-check row ml-4">
                          <label class="form-check-label col-sm-6">
                              <input type="radio" class="form-check-input" name="template" id="creative" value="creative" @if(isset($temp->template) && $temp->template == "creative") checked @endif>
                              <img src="{{ asset('creative/creative-demo-1.png') }}" alt="template-creative" height="320px" width="280px" >
                      
                              <p class="py-2">Template 1</p>
                          </label>
                          <label class="form-check-label col-sm-5">
                              <input type="radio" class="form-check-input" name="template" id="cresume" value="cresume" @if(isset($temp->template) && $temp->template == "cresume") checked @endif>
                              <img src="{{ asset('cresume/cresume-demo-1.jpg') }}" alt="template-cresume" height="320px" width="280px" >
                              <p class="py-2">Template 2</p>
                          </label>
                      </div>
                      
                      <div class="text-center">
                          <hr class="bg-light">
                          <button type="submit" class="btn btn-light">Change<i class="fas fa-edit"></i></button>
                      </div>
                  </div>
              </form>
          </div>
      </div>
  </div>      
  </div>
@endsection