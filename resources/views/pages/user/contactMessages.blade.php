@extends('layouts.user')

@section('content')
<div class="content-header">
  <h1 class="col-sm-6">Contact Messages</h1>
</div>
<div class="container">
<div class="row">
    <div class="col-lg-12 mx-auto">
        <div class="card card-dark">
            <div class="card-header"><i class="fas fa-comments-dollar"></i> All Messages</div>
            <div class="card-body">
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
                                Are You sure you want to delete this Message?
                                <br>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" id="ok_button">Ok</button>
                                <button type="button" class="btn btn-secondary" id="close" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
               
                <h5>All Messages Send on your Business Card</h5> 
                    
                    {!! $dataTable->table() !!}
                   
                    <a href="/contactDeletedMessages" class="btn btn-dark float-right mt-2" style="border-radius: 0px;" ><i class="fas fa-trash"></i> Deleted Messages</a>
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

<script src="https://cdn.datatables.net/buttons/1.0.3/js/dataTables.buttons.min.js"></script>
  
<script src="{{ asset('/vendor/datatables/buttons.server-side.js')}}"></script>

{!! $dataTable->scripts() !!}
<script>

    //delete button on datatables
    var id;
    $(document).on('click', '.put', function () {
        id = $(this).attr('id');
    });

    $('#ok_button').click(function () {
        $.ajax({
            url: '/deleteContactMessages/' + id,
            beforeSend: function () {
                $('#ok_button').text('Deleting...');
            },
            type: 'PUT',
            data: {
                submit: true,
                _token: $('input[name="_token"]').val()
            },
            success: function () {
                setTimeout(function () {
                    $('#close').click();
                    $('#data-table-messages').DataTable().ajax.reload();
                    alert('Message Deleted');
                }, 1000);
            }
        });
    });

    </script>
    

@endsection
