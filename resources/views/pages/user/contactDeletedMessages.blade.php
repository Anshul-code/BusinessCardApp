@extends('layouts.user')

@section('content')
<div class="content-header">
  <h1 class="col-sm-6">Deleted Contact Messages</h1>
</div>
<div class="container">
<div class="row">
    <div class="col-lg-12 mx-auto">
        <div class="card card-dark">
            <div class="card-header"><i class="fas fa-trash"></i>  All Deleted Messages
            <a href="/contactMessages" class="btn btn-light btn-sm float-right text-dark"><i class="fas fa-arrow-circle-left"></i> Back</a>
            </div>
            <div class="card-body">
                <hr>
                <!-- Confirmation Modal -  Permanently delete message -->
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
                                Are You sure you want to Permanently delete this Message?
                                <br>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" id="ok_button">Ok</button>
                                <button type="button" class="btn btn-secondary" id="close" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
                 <!-- Confirmation Modal - Restrore -->
                 <div class="modal fade" id="confirmRetrieve" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Confirm Restore</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                            </div>
                            <div class="modal-body">
                                Are You sure you want to Restrore this Message?
                                <br>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-success" id="ok_button_restore">Ok</button>
                                <button type="button" class="btn btn-secondary" id="close_restore" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
                <h5>All Deleted Messages</h5> 
                    <table class="table table-striped table-bordered data-table-messages" style="overflow-x:auto;">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Subject</th>
                                <th>Message</th>
                                <th>Created On</th>
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
 $('.data-table-messages').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('getDeletedContactMessages') }}",
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex' },
            { data: 'name', name: 'name'},
            { data: 'email', name: 'email', width: "15%"},
            { data: 'subject', name: 'subject' },
            { data: 'message' , name: 'message', width: "35%" },
            { data: 'created_at' , name: 'created_at' },
            
            { data: 'action', name: 'action', orderable: false, searchable: false , width: "12%"},
        ],
        
    });

    //delete button on datatables
    var id;
    $(document).on('click', '.delete', function () {
        id = $(this).attr('id');
    });

    $('#ok_button').click(function () {
        $.ajax({
            url: '/deleteMessagesPermanently/' + id,
            beforeSend: function () {
                $('#ok_button').text('Deleting...');
            },
            type: 'DELETE',
            data: {
                submit: true,
                _token: $('input[name="_token"]').val()
            },
            success: function () {
                setTimeout(function () {
                    $('#close').click();
                    $('.data-table-messages').DataTable().ajax.reload();
                    alert('Message Deleted');
                }, 1000);
            }
        });
    });

    //restore button on datatables
    var id;
    $(document).on('click', '.put', function () {
        id = $(this).attr('id');
    });

    $('#ok_button_restore').click(function () {
        $.ajax({
            url: '/retrieveMessage/' + id,
            beforeSend: function () {
                $('#ok_button_restore').text('Restoring...');
            },
            type: 'PUT',
            data: {
                submit: true,
                _token: $('input[name="_token"]').val()
            },
            success: function () {
                setTimeout(function () {
                    $('#close_restore').click();
                    $('.data-table-messages').DataTable().ajax.reload();
                    alert('Message Restored');
                }, 1000);
            }
        });
    });

    </script>
@endsection
