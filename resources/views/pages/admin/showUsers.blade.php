@extends('layouts.admin')

@section('content')
<div class="content-header">
  <h1 class="col-sm-6">All Users</h1>
</div>
<div class="container">
<div class="row">
    <div class="col-lg-12 mx-auto">
        <div class="card card-dark">
            <div class="card-header"><i class="fas fa-users"></i> All Users</div>
            <div class="card-body">
                <hr>
                <table class="table table-striped table-bordered data-table-users" style="overflow-x:auto;">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone No</th>
                            <th>DOB</th>
                            <th>Profile Image</th>
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

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>

<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>

<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>

<script src="https://cdn.datatables.net/buttons/1.0.3/js/dataTables.buttons.min.js"></script>

<script src="{{ asset('/vendor/datatables/buttons.server-side.js')}}"></script>

<script>
 $('.data-table-users').DataTable({
        processing: true,
        serverSide: true,
        
        ajax: "{{ route('getUsersData') }}",
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex' },
            { data: 'name', name: 'name', width: "12%"},
            { data: 'email', name: 'email'},
            { data: 'phone_number', name: 'phone_number', width: "15%" },
            { data: 'dob' , name: 'dob', width: "12%" },
            { 
                data: 'profile_image', name: 'profile_image' , render: function (data, type, full, meta) {
                    return "<img src={{ URL::to('/') }}/storage/profile_images/" + data + " class='img-circle elevation-2' style='width: 100px;height: 100px;'>";
                    },
                orderable: false, width: "15%" 
            },
            { data: 'action', name: 'action', orderable: false, searchable: false , width: "15%"},
        ],
       
    });

    </script>

@endpush
