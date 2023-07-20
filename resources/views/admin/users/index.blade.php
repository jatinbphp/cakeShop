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
                            <li class="breadcrumb-item"><a href="{{url('admin/')}}">Home</a></li>
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
                            {!! Form::open(['url' => url('admin/users'), 'method' => 'get', 'class' => 'form-horizontal','files'=>false]) !!}
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-6 col-sm-6 col-xs-12 mar-bot">
                                            <input  class="form-control" type="text" @if(!empty($search)) value="{{$search}}" @else placeholder="Search" @endif name="search" id="search">
                                        </div>
                                        <div>
                                            <button type="submit" class="btn btn-info mr-1" name="submit" value="Search">Search</button>
                                            <a href="{{url('admin/users')}}"><button type="button" class="btn btn-danger" name="submit" value="Search">Clear</button></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <a href="{{ url('admin/users') }}" ><button class="btn btn-default pull-right" type="button"><span class="fa fa-refresh"></span></button></a>
                                    <a href="{{ url('admin/users/create') }}"><button class="btn btn-info pull-right" type="button" style="margin-right: 1.5%;"><span class="fa fa-user-circle pr-1"></span> Invite User</button></a>
                                </div>
                            </div>
                            {!! Form::close() !!}
                        </div>
                        <div class="card-body table-responsive">
                            <table id="example2" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Invitation Accepted</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Mobile</th>
                                        <th>Image</th>
                                        <th>View Address</th>
                                        <th style="width: 15%;">Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach ($users as $list)
                                    <tr class="ui-state-default" id="arrayorder_{{$list['id']}}">
                                        <td>
                                            <label class="label @if($list['is_accepted'] == 0) label-danger @else label-success @endif p-1 pl-2 pr-2" style="border-radius: 5px;">
                                                @if($list['is_accepted'] == 0) Not Accepted @else Accepted @endif
                                            </label>
                                        </td>
                                        <td>{{ ucfirst($list['first_name']) }}  {{ ucfirst($list['last_name']) }}</td>
                                        <td>{{ $list['email'] }}</td>
                                        <td>{{ $list['mobile'] }}</td>
                                        <td>
                                            @if(!empty($list['image']) && file_exists($list['image']))
                                                <img src="{{url('storage/'.$list['image'])}}" height="40px">
                                            @endif
                                        </td>
                                        <td>
                                            <div class="btn-group-horizontal">
                                                <span data-toggle="tooltip" title="View Address" data-trigger="hover">
                                                    <button class="btn btn-primary" type="button" @if(count($list['Address']) >0) data-toggle="modal" data-target="#userAddress{{$list['id']}}" @endif><i class="fa fa-map-marker"></i> - {{count($list['Address'])}}</button>
                                                </span>
                                            </div>
                                        </td>
                                        <td>
                                            @if($list['status'] == 'active')
                                                <div class="btn-group-horizontal" id="assign_remove_{{ $list['id'] }}" >
                                                    <button class="btn btn-success unassign ladda-button" data-style="slide-left" id="remove" url="{{url('admin/users/unassign')}}" ruid="{{ $list['id'] }}"  type="button" style="height:28px; padding:0 12px"><span class="ladda-label">Active</span> </button>
                                                </div>
                                                <div class="btn-group-horizontal" id="assign_add_{{ $list['id'] }}"  style="display: none"  >
                                                    <button class="btn btn-danger assign ladda-button" data-style="slide-left" id="assign" uid="{{ $list['id'] }}" url="{{url('admin/users/assign')}}" type="button"  style="height:28px; padding:0 12px"><span class="ladda-label">In Active</span></button>
                                                </div>
                                            @endif
                                            @if($list['status'] == 'inactive')
                                                <div class="btn-group-horizontal" id="assign_add_{{ $list['id'] }}"   >
                                                    <button class="btn btn-danger assign ladda-button" id="assign" data-style="slide-left" uid="{{ $list['id'] }}" url="{{url('admin/users/assign')}}"  type="button" style="height:28px; padding:0 12px"><span class="ladda-label">In Active</span></button>
                                                </div>
                                                <div class="btn-group-horizontal" id="assign_remove_{{ $list['id'] }}" style="display: none" >
                                                    <button class="btn  btn-success unassign ladda-button" id="remove" ruid="{{ $list['id'] }}" data-style="slide-left" url="{{url('admin/users/unassign')}}" type="button" style="height:28px; padding:0 12px"><span class="ladda-label">Active</span></button>
                                                </div>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="btn-group btn-group-sm">
{{--                                            {{ Form::open(array('url' => 'admin/users/'.$list['id'].'/edit', 'method' => 'get','style'=>'display:inline')) }}--}}
{{--                                            <button class="btn btn-info tip" data-toggle="tooltip" title="Edit User" data-trigger="hover" type="submit" ><i class="fa fa-edit"></i></button>--}}
{{--                                            {{ Form::close() }}--}}
                                                <span data-toggle="tooltip" title="Delete User" data-trigger="hover">
                                                    <button class="btn btn-danger" type="button" data-toggle="modal" data-target="#myModal{{$list['id']}}"><i class="fa fa-trash"></i></button>
                                                </span>
                                            </div>
                                        </td>
                                    </tr>
                                    <!--------------------------------DELETE MODEL-------------------------------->
                                    <div id="myModal{{$list['id']}}" class="modal modal-default" role="dialog">
                                        {{ Form::open(array('url' => 'admin/users/'.$list['id'], 'method' => 'delete','style'=>'display:inline')) }}
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header bg-danger text-center">
                                                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span></button>
                                                    <h4 class="modal-title">Delete User</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Are you sure you want to delete this user?</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-outline pull-right">Delete</button>
                                                </div>
                                            </div>
                                        </div>
                                        {{ Form::close() }}
                                    </div>

                                    <!--------------------------------ADDRESS MODEL-------------------------------->
                                    <div id="userAddress{{$list['id']}}" class="fade modal modal-default" role="dialog">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content ml-0">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span></button>
                                                    <h4 class="modal-title">Address</h4>
                                                </div>
                                                <div class="modal-body" style="height: 360px; overflow-y: auto;">
                                                    @foreach($list['Address'] as $add)
                                                        <div class="callout callout-danger">
                                                            <span class="right badge badge-danger p-2 mb-2">{{ucfirst($add['address_title'])}}</span>
                                                            <h5>{{ucwords($add['username'])}}</h5>
                                                            <p>
                                                                {{$add['address']}}, {{$add['locality']}}, {{$add['city']}} - {{$add['pincode']}}, {{$add['state']}}, {{$add['country']}}<br/>
                                                                <b>Phone: {{$add['mobile']}}</b>
                                                            </p>
                                                        </div>
                                                    @endforeach
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-outline pull-right" data-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                </tbody>
                            </table>
                            <div style="text-align:right;float:right;"> @include('admin.pagination.limit_links', ['paginator' => $users])</div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
