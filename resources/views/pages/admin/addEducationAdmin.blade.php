@extends('layouts.userEdit')

@section('content')
<div class="content-header">
  <h1 class="col-sm-6">Add/Remove Education</h1>
</div>
<div class="container">
<div class="row">
    <div class="col-lg-10 mx-auto">
        <div class="card card-dark">
            <div class="card-header"><i class="fas fa-chart-bar"></i>Add Education</div>
            <div class="card-body">
                <form action="/newEducationAdminEdit/{{ $user_data->id }}" class="col-sm-8 mx-auto" method="post">
                    @csrf
                    <div class="form-group">
                      <label for="institute">Institute</label>
                      <input type="text" class="form-control" name="institute" id="institute" placeholder="Enter institute name" minlength="2" value="{{ old('institute') }}" required>
                        @error('institute')
                            <small class="text-danger">
                                <strong>{{ $message }}</strong>
                            </small>
                        @enderror
                    </div>
                    <div class="form-group">
                      <label for="course">Course</label>
                      <input type="text" class="form-control" name="course" id="course" minlength="2" placeholder="Enter course" value="{{ old('course') }}" required>
                        @error('course')
                            <small class="text-danger">
                                <strong>{{ $message }}</strong>
                            </small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="start_date">Start Date</label>
                        <input type="date" class="form-control" name="start_date" id="start_date" value="{{ old('start_date') }}" required>
                          @error('start_date')
                              <small class="text-danger">
                                  <strong>{{ $message }}</strong>
                              </small>
                          @enderror
                    </div>
                    <div class="form-group">
                        <label for="end_date">End Date</label>
                        <input type="date" class="form-control" name="end_date" id="end_date" value="{{ old('end_date') }}" required>
                          @error('end_date')
                              <small class="text-danger">
                                  <strong>{{ $message }}</strong>
                              </small>
                          @enderror
                    </div>
                    <div class="form-group">
                        <label for="about_course">About Course</label>
                        <textarea class="form-control" name="about_course" id="about_course" rows="3" minlength="8" maxlength="200" placeholder="Enter About your course"required>{{ old('course') }}</textarea>
                    @error('about_exp')
                        <small class="text-danger">
                            <strong>{{ $message }}</strong>
                        </small>
                    @enderror
                    </div>

                    <div class="text-center py-2">
                        <button type="submit" class="btn btn-dark btn-md" style="border-radius: 0px;"><i class="fas fa-plus"></i> Add Education</button>
                    </div>
                </form>

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
                                Are You sure you want to delete this Education Record?
                                <br>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" id="ok_button">Ok</button>
                                <button type="button" class="btn btn-secondary" id="close" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
                <h5>All Education Records Added By you</h5> 
                    <table class="table table-striped table-bordered data-table-education" style="overflow-x:auto;">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Institute</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Course</th>
                                <th>About Course</th>
                                <th width="100px">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
             
            </div>
        </div>
    </div>
</div>      
</div>
@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>

<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>

<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>

<script>
 $('.data-table-education').DataTable({
        processing: true,
        serverSide: true,
        ajax: "/getEducationDataAdminEdit/{{ $user_data->id }}",
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex' },
            { data: 'institute', name: 'institute'},
            { data: 'start_date', name: 'start_date' },
            { data: 'end_date', name: 'end_date' },
            { data: 'course' , name: 'course'},
            { data: 'about_course' , name: 'about_course'},
            { data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });

    //delete button on datatables
    var id;
    $(document).on('click', '.delete', function () {
        id = $(this).attr('id');
    });

    $('#ok_button').click(function () {
        $.ajax({
            url: '/deleteEducationDataAdminEdit/' + id,
            beforeSend: function () {
                $('#ok_button').text('Deleting');
            },
            type: 'DELETE',
            data: {
                submit: true,
                _token: $('input[name="_token"]').val()
            },
            success: function () {
                setTimeout(function () {
                    $('#close').click();
                    $('.data-table-education').DataTable().ajax.reload();
                    alert('Education Record Deleted');
                }, 2000);
            }
        });
    });

    </script>
@endsection
