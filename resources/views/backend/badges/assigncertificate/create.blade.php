@extends('larasnap::layouts.app', ['class' => 'user-create'])
@section('title','User Management')
@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="https://unpkg.com/tachyons@4.10.0/css/tachyons.min.css" type="text/css">
<link rel="stylesheet" href="{{asset('backend/js/vendors/formvalidation/dist/css/formValidation.min.css')}}">
<!-- Page Heading  Start-->
<div class="breadcrumb_nav">
	<nav aria-label="breadcrumb">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
			<li class="breadcrumb-item"><a href="{{ route('admin.user_lists.index') }}">Students</a></li>
			<li class="breadcrumb-item"><a href="{{ route('admin.badges.index', request()->id) }}">Badges</a></li>
			<li class="breadcrumb-item active" aria-current="page">Add Badge</li>
		</ol>
	</nav>
</div>
<div class="d-sm-flex align-items-center justify-content-between mb-4">
	<h1 class="h3 mb-0 text-gray-800">Assign Certificate</h1>
</div>
<!-- Page Heading End-->
<!-- Page Content Start-->
<div class="row">
	<div class="col-xl-12">
		<div class="card shadow mb-4">
			<div class="card-body">
				<div class="card-body p-0">
					<div class="col-md-3 cc-right">
						@canAccess('admin.register')
						<a href="{{ route('admin.badges.assigncertificate.index',request()->id)  }}" title="Create Student" class="btn btn-warning btn-sm"><i aria-hidden="true" class="fa fa-arrow-left"></i> Back to Assign Certificate List
						</a>
						@endcanAccess
						<br>
					</div>
					<br> <br>
					<form id="badge_form" action="{{route('admin.badges.assigncertificate.store',request()->id)}}" method="POST" class="form-horizontal" autocomplete="off">
						@csrf
						<input type="hidden" id="user_id" value="{{ request()->id }}">
						<div class="row">

							<div class="col-md-4">
								<div class="form-group">
									<label for="institution_name">Select Institution Name: <small class="text-danger required" checked="">*</small></label>
									<select name="institution_name" class="form-control" id="institution_name" value="{{ old('institution_name') }}">
										<option value="" selected="selected">Select institute </option>
										@forelse($institution as $index => $roles)
										<option value="{{ $roles->id }}" {!! old('institution')==$roles->id ? : '' !!} >{{ $roles->institution_name }}</option>
										@empty
										@endforelse
									</select>
									@error('institution_name')
									<span class="text-danger">{{ $message }}</span>
									@enderror
								</div>
							</div>

							<div class="col-md-4">
								<div class="form-group">
									<label for="course_name" class="control-label">Course Name<small class="text-danger required">*</small></label>
									<div class="fl w-100">
										<input name="course_name" type="text" id="course_name" class="form-control" value="{{ old('course_name') }}">
										@error('course_name')
										<span class="text-danger">{{ $message }}</span>
										@enderror
									</div>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label for="total_hours" class="control-label">Total Hours<small class="text-danger required">*</small></label>
									<div class="fl w-100">
										<input name="total_hours" type="number" id="total_hours" class="form-control" value="{{ old('total_hours') }}">
										@error('total_hours')
										<span class="text-danger">{{ $message }}</span>
										@enderror
									</div>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label for="date_completion" class="control-label">Date Completion<small class="text-danger required">*</small></label>
									<div class="fl w-100">
										<input name="date_completion" type="text" id="date_completion" class="form-control" min="0" value="{{ old('date_completion') }}">
										@error('date_completion')
										<span class="text-danger">{{ $message }}</span>
										@enderror
									</div>
								</div>
							</div>

						</div>
						<div class="row">
							<div class="col-md-12 mt-2 cc-right">
								<div class="form-group">
									<input type="submit" id="loginButton" value="Save" class="btn btn-primary purple-btn">
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Page Content End-->
<script src="https://code.jquery.com/jquery-3.5.0.js"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script type="text/javascript">
	$(function() {
		flatpickr("#date_completion", {
			dateFormat: "d-m-Y",
			allowInput: true,
			altInput: true,
			altFormat: "d/m/Y",
		});
	});
</script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>

<link rel="stylesheet" href="{{ asset('css/app.css') }}">
<script src="{{ asset('js/app.js') }}"></script>


@endsection