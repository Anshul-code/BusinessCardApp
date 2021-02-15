@extends('layouts.user')

@section('content')
<div class="content-header">
  <h1 class="col-sm-6">References</h1>
</div>
<div class="container">
<div class="row">
    <div class="col-lg-12 mx-auto">
        <div class="card card-dark">
            <div class="card-header">
                <i class="fas fa-images"></i> 
                Add/Remove Reference
            </div>
            <div class="card-body">
                <form action="/newReference" method="post" class="col-sm-6 mx-auto" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="form-group">
                        <label for="ref_image">Reference Image</label>
                        <input type="file" class="form-control-file" name="ref_image" id="ref_image" required>
                      @error('ref_image')
                          <small class="text-danger">
                            <strong>{{ $message }}</strong>
                          </small>
                      @enderror
                    </div>
                    <div class="form-group">
                      <label for="name">Person name</label>
                      <input type="text" class="form-control" name="name" id="name" placeholder="Enter Reference person name" value="{{ old('name') }}" minlength="4" maxlength="30" required >
                      @error('name')
                        <small class="text-danger">
                            <strong>{{ $message }}</strong>
                        </small>
                      @enderror
                    </div>
                    <div class="form-group">
                      <label for="company">Company</label>
                      <input type="text" class="form-control" name="company" id="company" placeholder="Enter person company" value="{{ old('company') }}" minlength="3" maxlength="30" required >
                      @error('company')
                        <small class="text-danger">
                            <strong>{{ $message }}</strong>
                        </small>
                      @enderror
                    </div>
                    <div class="form-group">
                      <label for="designation">Person Designation</label>
                      <input type="text" class="form-control" name="designation" id="designation" placeholder="Enter person designation" value="{{ old('designation') }}" minlength="3" maxlength="30" required >
                      @error('designation')
                        <small class="text-danger">
                            <strong>{{ $message }}</strong>
                        </small>
                      @enderror
                    </div>

                    <div class="form-group">
                      <label for="ref_about">About Reference</label>
                      <input type="text" class="form-control" name="ref_about" id="ref_about" placeholder="Enter references detail" value="{{ old('ref_about') }}" minlength="8" maxlength="200" required >
                      @error('ref_about')
                        <small class="text-danger">
                          <strong>{{ $message }}</strong>
                        </small>
                      @enderror
                    </div>

                    <div class="text-center py-2">
                        <button type="submit" class="btn btn-dark btn-md" style="border-radius: 0px;"><i class="fas fa-plus"></i> Add Reference</button>
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
                                Are You sure you want to delete this Reference Record?
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
                <h3 class="py-2">All Reference Data</h3>
                <!-- Reference info in table -->
                <table class="table table-striped table-bordered data-table-reference" style="overflow-x:auto;">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Reference Image</th>
                            <th>Person Name</th>
                            <th>Company</th>
                            <th>Designation</th>
                            <th>Reference</th>
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


@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>

<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>

<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>

    <script>
    $('.data-table-reference').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('getReferenceInfo') }}",
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex' },
            { 
                data: 'ref_image', name: 'ref_image' , render: function (data, type, full, meta) {
                    return "<img src={{ URL::to('/') }}/storage/references_images/" + data + " class=' img-circle elevation-2' style='width: 160px;height: 160px;'>";
                    },
                orderable: false, width: "20%" 
            },
            { data: 'name', name: 'name' },
            { data: 'company', name: 'company', width: "10%" },
            { data: 'designation', name: 'designation', width: "10%" },
            { data: 'ref_about' , name: 'ref_about'},
            { data: 'action', name: 'action', orderable: false, searchable: false , width: "10%"},
        ]
    });

    //delete button on datatables
    var id;
    $(document).on('click', '.delete', function () {
        id = $(this).attr('id');
    });

    $('#ok_button').click(function () {
        $.ajax({
            url: '/deleteReferenceData/' + id,
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
                    $('.data-table-reference').DataTable().ajax.reload();
                    alert('Reference record removed');
                }, 2000);
            }
        });
    });
    </script>
@endsection
