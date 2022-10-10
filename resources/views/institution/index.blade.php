@extends('larasnap::layouts.app', ['class' => 'user-index'])
@section('title','User Management')
@section('content')
<div class="breadcrumb_nav">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Institution</li>
        </ol>
    </nav>
</div>
<!-- Page Heading  Start-->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Institution</h1>
</div>
<!-- Page Heading End-->
<!-- Page Content Start-->
<div class="row">
    <div class="col-xl-12">
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="card-body p-0">
                    <form method="POST" action="{{ route('institution.index') }}" id="list-form" class="form-inline my-2 my-lg-0" autocomplete="off">
                        @method('POST')
                        @csrf
                        <div class="container-fluid common-filter p-0 mb-3">
                            <div class="row">
                                <!-- list filters -->
                                <div class="col-md-2 cc-right">

                                    <a href="{{ route('institution.create') }}" title="Create Institution" class="btn btn-primary purple-btn btn-sm"><i aria-hidden="true" class="fa fa-plus"></i> Create
                                    </a>

                                    <br>
                                </div>
                                <div class="col-md-9">
                                    @php
                                    $searchVal = "";
                                    if (!empty($request->search)) {
                                    $searchVal = $request->search;
                                    }
                                    @endphp
                                    <!-- <input type="text" name="search" id="search" placeholder="Search By Institutions Name" class="form-control ml-10" value="{{ $searchVal }}" data-toggle="tooltip" data-placement="top" title="Search By Email"> -->
                                    <!-- <input type="submit" name="order_filter" id="submit1" value="Filter" class="btn btn-primary"> -->
                                    <!-- <a href=""><button title="Reset" class="btn btn-danger" id="reset">Reset</button></a> -->
                                    <!-- list filters -->
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th>Institution Name</th>
                                        <th>Logo</th>
                                        <th>Signature</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @forelse($institution as $i => $user)
                                    <tr>

                                        <td>{{ $i+1 }}</td>
                                        <td>{{ $user->institution_name }}</td>

                                        <td><img style="width: 50px; height: 50px;" src="<?php echo url(Storage::url("app/public/upload/institution/logo/" . $user->logo)); ?>"></td>
                                        <td><img style="width: 50px; height: 50px;" src="<?php echo url(Storage::url("app/public/upload/institution/signature/" . $user->signature)); ?>"></td>

                                        <td>
                                        <form id="deleteForm" action="{{route('institution.delete',$user->id)}}" method="GET">
                                                @csrf
                                                @method('GET')

                                            <a href="{{route('institution.show',$user->id)}}" title="View Admin"><button class="btn btn-info btn-sm" type="button"><i aria-hidden="true" class="fa fa-eye"></i></button></a>

                                            <!-- If 'Super Admin Role' is added on the config & if the user has 'Super Admin Role', show the edit/assign role/delete options only if the logged in user has 'Super Admin Role' -->
                                            @if(isset($superAdminRole) && !empty($superAdminRole))
                                            @if($user->roles->contains('name', $superAdminRole) && !userHasRole($superAdminRole))
                                            @continue;
                                            @endif
                                            @endif

                                            <a href="{{route('institution.edit',$user->id)}}" title="Edit Admin"><button class="btn btn-primary btn-sm" type="button"><i aria-hidden="true" class="fa fa-pencil-square-o"></i></button></a>
                                            <!-- <a href="{{route('institution.delete',$user->id)}}" title="Delete Admin"><button class="btn btn-danger btn-sm" type="button"><i aria-hidden="true" class="fa fa-trash"></i></button></a> -->
                                            
                                            
                                                <a onclick="deleteModel({{$user->id}})" title="Delete Admin"><button data-toggle="modal" data-target="#small" class="btn btn-danger btn-sm" type="button"><i aria-hidden="true" class="fa fa-trash"></i></button></a>
                                            </form>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td class="text-center" colspan="12">No User found!</td>
                                    </tr>
                                    @endforelse

                                </tbody>
                            </table>
                            <div class="pagination">

                            </div>
                        </div>
                    </form>

                    <div class="modal fade text-left" id="small" tabindex="-1" role="dialog" aria-labelledby="myModalLabel19" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="myModalLabel19">Delete</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <input type="hidden" id="users_id">
                                <div class="modal-body">
                                    Are you sure you want to delete?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" onclick="triggerDelete()" id="delete-btn" class="btn btn-primary" data-dismiss="modal">Accept</button>
                                    <button type="button" id="delete-btn" class="btn btn-danger" class="close" data-dismiss="modal" aria-label="Close">Cancel</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Page Content End-->

@endsection

<script>
    var roleDelteURL = "{{route('institution.delete',':id')}}"

    function deleteModel(id) {
        jQuery('#users_id').val(id);
    }

    function triggerDelete() {
        var action_url = jQuery("#deleteForm").prop('action');
        let roleId = jQuery('#users_id').val();

        action_url = roleDelteURL.replace(':id', roleId);

        jQuery("#deleteForm").attr('action', action_url);

        jQuery("#deleteForm").submit();
    }
</script>