@extends('larasnap::layouts.app', ['class' => 'user-create'])
@section('title','User Management')
@section('content')
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="https://unpkg.com/tachyons@4.10.0/css/tachyons.min.css" type="text/css">
<link rel="stylesheet" href="{{asset('backend/js/vendors/formvalidation/dist/css/formValidation.min.css')}}">
<!-- Page Heading  Start-->
<div class="breadcrumb_nav">
	<nav aria-label="breadcrumb">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
			<li class="breadcrumb-item"><a href="{{ route('institution.index') }}">Institution</a></li>
			<li class="breadcrumb-item active" aria-current="page">Institution</li>
		</ol>
	</nav>
</div>
<div class="d-sm-flex align-items-center justify-content-between mb-4">
	<h1 class="h3 mb-0 text-gray-800"> Institution</h1>
</div>
<!-- Page Heading End-->
<!-- Page Content Start-->
<div class="row">
	<div class="col-xl-12">
		<div class="card shadow mb-4">
			<div class="card-body">
				<div class="card-body p-0">
					<a href="{{route('institution.index')}}" title="Back to index" class="btn btn-warning btn-sm"><i aria-hidden="true" class="fa fa-arrow-left"></i> Back to Institution
					</a>
					<br> <br>
					<form class="login100-form validate-form login-form signup-form" id="register" method="POST" action="{{route('institution.store')}}" enctype="multipart/form-data" autocomplete="off">
						@csrf
						<div class="row">

							<div class="col-md-4">
								<div class="form-group">
									<div class="fl w-100">
										<label for="institution_name" class="control-label">Institution Name<small class="text-danger required">*</small></label>
										<input type="text" class="form-control" value="{{ old('institution_name') }}" name="institution_name" placeholder="Institution Name">
										@error('institution_name')
										<p class="invalid-feedback d-block mt-10 validation-error">{{ $message }}</p>
										@enderror
									</div>
								</div>
							</div>

							<div class="col-md-4">
								<div class="form-group">
									<div class="fl w-100">
										<label for="logo" class="control-label">Logo</label>
										<input name="logo" type="file" id="logo" class="form-control">
										<small>Allowed File Formats: jpg, jpeg, png</small>
										@error('logo')
										<span class="invalid-feedback d-block mt-10 validation-error">{{ $message }}</span>
										@enderror
									</div>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<div class="fl w-100">
										<label for="signature" class="control-label">Signature</label>
										<input name="signature" type="file" id="signature" class="form-control">
										<small>Allowed File Formats: jpg, jpeg, png</small>
										@error('signature')
										<span class="invalid-feedback d-block mt-10 validation-error">{{ $message }}</span>
										@enderror
									</div>
								</div>
							</div>


							<div class="row">
								<div class="col-md-12 mt-2 cc-right">
									<div class="form-group">
										<input type="submit" value="Create" id="loginButton" class="btn btn-primary purple-btn">
									</div>
								</div>
							</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection