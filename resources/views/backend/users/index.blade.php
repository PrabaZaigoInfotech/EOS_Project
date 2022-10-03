@extends('larasnap::layouts.app', ['class' => 'user-index'])
@section('title','User Management')
@section('content')
<div class="breadcrumb_nav">
   <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
         <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
         <li class="breadcrumb-item active" aria-current="page">Students</li>
      </ol>
   </nav>
</div>
<!-- Page Heading  Start-->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
   <h1 class="h3 mb-0 text-gray-800">Students</h1>
</div>
<!-- Page Heading End-->
<!-- Page Content Start-->
<div class="row">
   <div class="col-xl-12">
      <div class="card shadow mb-4">
         <div class="card-body">
            <div class="card-body p-0">
               <form method="POST" action="{{ route('admin.user_lists.index') }}" id="list-form" class="form-inline my-2 my-lg-0" autocomplete="off">
                  @method('POST')
                  @csrf
                  <div class="container-fluid common-filter p-0 mb-3">
                     <div class="row">
                        <!-- list filters -->
                        <div class="col-md-2 cc-right">
                           @canAccess('admin.register')
                           <a href="{{ route('admin.register') }}" title="Create Student" class="btn btn-primary purple-btn btn-sm"><i aria-hidden="true" class="fa fa-plus"></i>Create Student
                           </a>
                           @endcanAccess
                           <br>
                        </div>
                        <div class="col-md-9">
                           @php
                           $searchVal = "";
                           if (!empty($request->search)) {
                           $searchVal = $request->search;
                           }
                           @endphp
                           <input type="text" name="search" id="search" placeholder="Search By Email" class="form-control ml-10" value="{{ $searchVal }}" data-toggle="tooltip" data-placement="top" title="Search By Email">
                           <input type="submit" name="order_filter" id="submit1" value="Filter" class="btn btn-primary">
                           <a href="{{route('admin.user_lists.index')}}"><button title="Reset" class="btn btn-danger" id="reset">Reset</button></a>
                           <!-- list filters -->
                        </div>
                     </div>
                  </div>

                  <div class="table-responsive">
                     <table class="table">
                        <thead>
                           <tr>
                              <!-- <th><input type="checkbox" id="bulk-checkall"></th> -->
                              <th>S.No</th>
                              <th>Name</th>
                              <th>Email</th>
                              <th>No.Of Badges</th>
                              <th>Mobile Number</th>
                              <th>Actions</th>
                           </tr>
                        </thead>
                        <tbody>
                           @php
                           $superAdminRole = config('larasnap.superadmin_role');
                           @endphp
                           @forelse($users as $i => $user)
                           <tr>
                              <!-- @if(isset($superAdminRole) && !empty($superAdminRole) && $user->roles->contains('name', $superAdminRole) && !userHasRole($superAdminRole)) 
                                  <td><input type="checkbox" class="checkbox" name="records[]" value="" disabled></td>
                              @else
                                <td><input type="checkbox" class="checkbox bulk-check" name="records[]" value="{{ $user->id }}" data-id="{{$user->id}}"></td>
                              @endif -->
                              <td>{{ $i+1 }}</td>
                              <td>{{ $user->full_name }}</td>
                              <td><a href="mailto:{{ $user->email }}">{{ $user->email }}</a></td>
                              @php
                              $badgeCount = $user->badge->count();
                              @endphp
                              <td>
                                 {{ $badgeCount }}
                              </td>
                              <td>
                                 {{ $user->userProfile->mobile_no }}
                              </td>
                              <td>
                                 @canAccess('admin.user_lists.index')
                                 <a href="{{ route('admin.badges.index', $user->id) }}" title="Add Badge"><button class="btn btn-info btn-sm" type="button"><i aria-hidden="true" class="fa fa-id-badge"></i></button></a>
                                     @endcanAccess
                                 
                                 <a href="{{ route('admin.badges.assigncertificate.index', $user->id) }}" title="assign Certificate"><button class="btn btn-info btn-sm" type="button"><i aria-hidden="true" class="fa  fa-certificate"></i></button></a>
                                
                                 <!-- If 'Super Admin Role' is added on the config & if the user has 'Super Admin Role', show the edit/assign role/delete options only if the logged in user has 'Super Admin Role' -->
                                 @if(isset($superAdminRole) && !empty($superAdminRole))
                                 @if($user->roles->contains('name', $superAdminRole) && !userHasRole($superAdminRole))
                                 @continue;
                                 @endif
                                 @endif
                                 <!-- @canAccess('users.edit')
                                     <a href="{{ route('users.edit', $user->id) }}" title="Edit Admin"><button class="btn btn-primary btn-sm" type="button"><i aria-hidden="true" class="fa fa-pencil-square-o"></i></button></a>
                                 @endcanAccess -->
                                 <!-- @canAccess('users.assignrole_create')
                                     <a href="{{ route('users.assignrole_create', $user->id)}}" title="Assign Role"><button class="btn btn-success btn-sm" type="button"><i aria-hidden="true" class="fa fa-key"></i></button></a>
                                 @endcanAccess -->
                                 <!-- @canAccess('users.destroy')
                                     <a href="#" onclick="return individualDelete({{ $user->id }})" title="Delete Admin"><button class="btn btn-danger btn-sm" type="button"><i aria-hidden="true" class="fa fa-trash"></i></button></a>
                                 @endcanAccess -->
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
                        {{ $users->links() }}
                     </div>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </div>
</div>

<!-- Page Content End-->
<script>
   $('#submit1').on('click', function() {
      $('#list-form').submit();
   });

   $('#reset').on('click', function() {
      $('#search').val('');
      $('#list-form').submit();
   });
</script>
@endsection