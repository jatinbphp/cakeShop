@extends('admin.layouts.app')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>{{$menu}}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                            <li class="breadcrumb-item active">{{$menu}}</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            @include ('admin.error')
            <div id="responce" class="alert alert-success" style="display: none">
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card card-info card-outline">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-12">
                                    <!-- <a href="{{ url('users/create') }}"><button class="btn btn-info float-right" type="button" style="margin-right: 1.5%;"><i class="fa fa-plus pr-1"></i> Add New</button></a> -->
                                </div>
                            </div>
                        </div>
                        <div class="card-body table-responsive">
                            <table id="usersTable" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>                                        
                                        <th style="width: 15%;">Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('jquery')
<script type="text/javascript">
    $(function () {
        var table = $('#usersTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('customers.index') }}",
            columns: [
                {data: 'name', "width": "15%", name: 'name'},
                {data: 'email',  ame: 'email'},
                {data: 'status', "width": "15%", name: 'status'},
                {data: 'action', "width": "15%", name: 'action', orderable: false, searchable: false},
            ]
        });

        $('#usersTable tbody').on('click', '.deleteUser', function (event) {
            event.preventDefault();
            if ($(this).hasClass('selected')) {
                $(this).removeClass('selected');
            }
            else {
                table.$('tr.selected').removeClass('selected');
                $(this).addClass('selected');
            }
            var roleId = $(this).attr("data-id");
            swal({
                    title: "Are you sure?",
                    text: "To delete this user",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: '#DD6B55',
                    confirmButtonText: 'Yes, Delete',
                    cancelButtonText: "No, cancel",
                    closeOnConfirm: false,
                    closeOnCancel: false
                },
            function(isConfirm) {
                if (isConfirm) {
                    $.ajax({
                        url: "{{url('customers')}}/"+roleId,
                        type: "DELETE",
                        data: {_token: '{{csrf_token()}}' },
                        success: function(data){
                            console.log(data);
                            table.row('.selected').remove().draw(false);
                            swal("Deleted", "Your data successfully deleted!", "success");
                        }
                    });
                } else {
                    swal("Cancelled", "Your data safe!", "error");
                }
            });
        });
    });
  </script>
@endsection