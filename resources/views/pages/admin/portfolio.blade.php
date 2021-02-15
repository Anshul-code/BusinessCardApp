@extends('layouts.userEdit')

@section('content')
<div class="content-header">
    <h1 class="col-sm-6">Portfolio</h1>
  </div>
  <div class="container">
  <div class="row">
      <div class="col-lg-12 mx-auto">
          <div class="card card-dark">
              <div class="card-header">
                  <i class="fas fa-images"></i> 
                  Skill based Portfolio
              </div>
              <div class="card-body">
                  @if($skills->count() != 0)
                  <form action="/addPortfolioImageAdminEdit/{{ $user_data->id }}" method="post" class="col-sm-6 mx-auto" enctype="multipart/form-data">
                      @csrf
                      <div class="form-group">
                        <label for="">Select Skill Added by you</label>
                        <br>
                        
                        <select class="form-control" name="skill" id="skill" required>
                          <option value="">-- Select --</option>
                          @if($skills->count() != 0)
                              @foreach ($skills as $row)
                                  <option value="{{ $row->id }}">{{ $row->skill }}</option>
                              @endforeach
                          @endif
                        </select>
                        @error('skill')
                            <small class="text-danger">
                              <strong>{{ $message }}</strong>
                            </small>
                        @enderror
                      </div>
                      <div class="form-group">
                          <label for="portfolio_image">Portfolio Image</label>
                          <input type="file" class="form-control-file" name="portfolio_image" id="portfolio_image" required>
                        @error('portfolio_image')
                            <small class="text-danger">
                              <strong>{{ $message }}</strong>
                            </small>
                        @enderror
                      </div>
                      <div class="form-group">
                        <label for="image_title">Image Title</label>
                        <input type="text" class="form-control" name="image_title" id="image_title" placeholder="Enter Image Title" value="{{ old('image_title') }}" minlength="4" maxlength="20" required >
                        @error('image_title')
                          <small class="text-danger">
                              <strong>{{ $message }}</strong>
                          </small>
                        @enderror
                      </div>
                      <div class="form-group">
                        <label for="about_image">Image Details</label>
                        <input type="text" class="form-control" name="about_image" id="about_image" placeholder="Tell us about this image" value="{{ old('about_image') }}" minlength="8" maxlength="100" required >
                        @error('about_image')
                          <small class="text-danger">
                            <strong>{{ $message }}</strong>
                          </small>
                        @enderror
                      </div>
                      <div class="text-center py-2">
                          <button type="submit" class="btn btn-dark btn-md" style="border-radius: 0px;"><i class="fas fa-plus"></i> Add Portfolio Image</button>
                      </div>
                  </form>
                  @else
                      <h4 class="text-center">Add Some Skills Before Adding Portfolio Images !</h4>
                      <p class="text-center"><a href="/addSkills">Click Here </a>to add Skills to your Profile</p>
                  @endif
                  <hr>
                  <!-- Confirmation Modal -->
                  <div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                          <div class="modal-content">
                              <div class="modal-header">
                                  <h5 class="modal-title">Confirm Deletion</h5>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                      </button>
                              </div>
                              <div class="modal-body">
                                  Are You sure you want to delete this portfolio image?
                                  <br>
                              </div>
                              <div class="modal-footer">
                                  <button type="button" class="btn btn-danger" id="ok_button">Ok</button>
                                  <button type="button" class="btn btn-secondary" id="close" data-dismiss="modal">Close</button>
                              </div>
                          </div>
                      </div>
                  </div>
                  <!-- Modal End -->
                  <h3 class="py-2">Portfolio Data</h3>
                  <!-- portfolio info in table -->
                  <table class="table table-striped table-bordered data-table-portfolio" style="overflow-x:auto;">
                      <thead>
                          <tr>
                              <th>No</th>
                              <th>Skill</th>
                              <th>Image Title</th>
                              <th>About Image</th>
                              <th>Image</th>
                              <th>Created At</th>
                              <th width="100px">Action</th>
                          </tr>
                      </thead>
                      <tbody>
                      </tbody>
                  </table>
                  <!-- table end -->
              </div>
          </div>
      </div>
  </div>      
  </div>
@endsection