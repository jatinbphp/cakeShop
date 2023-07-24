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
                            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
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
                                    <a href="{{ route('orders.export') }}"><button class="btn btn-warning float-right" type="button" style="margin-right: 1.5%;"><i class="fa fa-file-export pr-1"></i> Export to CSV</button></a>
                                    <a href="{{ route('orders.create') }}"><button class="btn btn-info float-right" type="button" style="margin-right: 1.5%;"><i class="fa fa-plus pr-1"></i> Add New</button></a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body table-responsive">
                            <table id="ordersTable" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Unique ID</th>
                                        <th>Customer</th>
                                        <th style="width: 12%;">Status</th>
                                        <th style="width: 12%;">Total</th>
                                        <th style="width: 18%;" >Date Added</th>
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
        var table = $('#ordersTable').DataTable({
            processing: true,
            serverSide: true,
            buttons: [
                {
                    text: 'csv',
                    extend: 'csvHtml5',
                },
            ],
            ajax: "{{ route('orders.index') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false, width: '10%' },
                {data: 'unique_id', name: 'unique_id'},
                {data: 'customer_name', name: 'customer_name'},
                {data: 'status', name: 'status'},
                {data: 'order_total', name: 'order_total'},
                {data: 'created_at', name: 'created_at'},
                {data: 'action', "width": "10%", name: 'action', orderable: false, searchable: false},
            ]
        });

        $('#ordersTable tbody').on('click', '.deleteOrder', function (event) {
            event.preventDefault();
            if ($(this).hasClass('selected')) {
                $(this).removeClass('selected');
            }
            else {
                table.$('tr.selected').removeClass('selected');
                $(this).addClass('selected');
            }
            var cId = $(this).attr("data-id");
            swal({
                    title: "Are you sure?",
                    text: "To delete this order",
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
                        url: "{{url('admin/orders')}}/"+cId,
                        type: "DELETE",
                        data: {_token: '{{csrf_token()}}' },
                        success: function(data){
                            table.row('.selected').remove().draw(false);
                            swal("Deleted", "Your data successfully deleted!", "success");
                        }
                    });
                } else {
                    swal("Cancelled", "Your data safe!", "error");
                }
            });
        });

        $('#ordersTable tbody').on('click', '.assign', function (event) {
            event.preventDefault();
            var user_id = $(this).attr('uid');
            var url = $(this).attr('url');
            var l = Ladda.create(this);
            l.start();
            $.ajax({
                url: url,
                type: "post",
                data: {'id': user_id},
                headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') },
                success: function(data){
                    l.stop();
                    $('#assign_remove_'+user_id).show();
                    $('#assign_add_'+user_id).hide();
                    table.draw(false);
                }
            });
        });

        $('#ordersTable tbody').on('click', '.unassign', function (event) {
            event.preventDefault();
            var user_id = $(this).attr('ruid');
            var url = $(this).attr('url');
            var l = Ladda.create(this);
            l.start();
            $.ajax({
                url: url,
                type: "post",
                data: {'id': user_id,'_token' : $('meta[name=_token]').attr('content') },
                success: function(data){
                    l.stop();
                    $('#assign_remove_'+user_id).hide();
                    $('#assign_add_'+user_id).show();
                    table.draw(false);
                }
            });
        });
    });
  </script>
@endsection
