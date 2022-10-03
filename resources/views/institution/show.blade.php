@extends('larasnap::layouts.app', ['class' => 'user-show'])
@section('title','User Management')
@section('content')
<!-- Page Heading  Start-->
<div class="breadcrumb_nav">
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('users.index') }}">Institution</a></li>
    <li class="breadcrumb-item active" aria-current="page"> Institution Show</li>
  </ol>
</nav>
</div>
<div class="d-sm-flex align-items-center justify-content-between mb-4">
   <h1 class="h3 mb-0 text-gray-800">Institution Details</h1>
</div>
<!-- Page Heading End-->				  
<!-- Page Content Start-->				  
<div class="row">
   <div class="col-xl-12">
      <div class="card shadow mb-4">
         <div class="card-body">
            <div class="card-body p-0">
               <a href="{{ route('institution.index') }}" title="Back to index" class="btn btn-warning btn-sm"><i aria-hidden="true" class="fa fa-arrow-left"></i> Back to index
               </a> 
               <br> <br> 
			   <div class="row">
              <div class="col-md-8">
			  <strong class="table-heading">Institution INFORMATION</strong>
           <br>
			  <table class="details mb-10">
			  <tr><td>Institution Name</td><td>{{ $institution->institution_name ? $institution->institution_name : '- NA -' }}</td></tr>
           <tr> <td>Logo </td><td><img style="width: 50px; height: 50px;" src="<?php echo url(Storage::url("app/public/upload/institution/logo/".$institution->logo)); ?>"></td></tr>
           <tr> <td> Signature</td><td><img style="width: 50px; height: 50px;" src="<?php echo url(Storage::url("app/public/upload/institution/signature/".$institution->signature)); ?>"></td></tr>

			  </table>
			  </div>
              <div class="col-md-4 text-center">

				<!-- <img src="{{ $institution->logo }}" class="rounded-circle user-photo" alt="Prof Picture" > -->
			  <!-- </div>
              <div class="col-md-4 text-center">
				<img src="{{ $institution->signature }}" class="rounded-circle user-photo" alt="Prof Picture" >
			  </div>
            </div> -->
            </div>
         </div>
      </div>
   </div>
</div>
<!-- Page Content End-->				  
@endsection