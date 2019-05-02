@extends('super_admin_inc.template')
@section('content')
	<div class="container-fluid page-body-wrapper">
	  	<!-- partial -->
		<div class="main-panel p-4">
			<div class="super_admin_content">
				<form action="{{ route('super_admin.NewGroup') }}" method="post" class="form" enctype="multipart/form-data">
						@csrf
						<h4 class="text-info">Group Information</h4>
						@if(session()->has('success_group'))
							<div class="text-success">
								{{ session()->get('success_group') }}
							</div>
						@endif
						<div class="form-group">
							<label for="logo_for_group">Logo <span class="text-danger">*</span> </label>
							@if ($errors->has('logo_for_group'))
								<p role="alert" class='text-danger'><strong>{{ $errors->first('logo_for_group') }}</strong></p>
							@endif
							<div class="custom-file">
								<input type="file" class="custom-file-input" id="logo_for_group" name="logo_for_group">
								<label class="custom-file-label" for="logo_for_group">Choose file</label>
							</div>
						</div>
						<div class="form-group">
							<label for="name_of_group">Name <span class="text-danger">*</span> </label>
							@if ($errors->has('name'))
								<p role="alert" class='text-danger'><strong>{{ $errors->first('name_of_group') }}</strong></p>
							@endif
							<input type='text' value="{{old('name_of_group')}}" name="name_of_group"  required="" id="name_of_group" class="form-control">
						</div>
						<div class="form-group">
							<label for="date_of_launch">Date Of Launch <span class="text-danger">*</span></label>
							@if ($errors->has('date_of_launch'))
								<p role="alert" class='text-danger'><strong>{{ $errors->first('date_of_launch') }}</strong></p>
							@endif
							<input type='date' value="{{ old('date_of_launch')}}" name="date_of_launch" id="date_of_launch" class='form-control' required="">
						</div>
						<div class="form-group">
							<label for="contact_first_name">Contact First Name <span class="text-danger">*</span></label>
							@if ($errors->has('contact_first_name'))
								<p role="alert" class='text-danger'><strong>{{ $errors->first('contact_first_name') }}</strong></p>
							@endif
							<input type='text' value="{{old('contact_first_name') }}"  required="" name="contact_first_name" id="contact_first_name" class='form-control'>
						</div>
						<div class="form-group">
							<label for="contact_last_name">Contact Last Name <span class="text-danger">*</span></label>
							@if ($errors->has('contact_last_name'))
								<p role="alert" class='text-danger'><strong>{{ $errors->first('contact_last_name') }}</strong></p>
							@endif
							<input type='text' value="{{old('contact_last_name') }}"  required="" name="contact_last_name" id="contact_last_name" class='form-control'>
						</div>
						<div class="form-group">
							<label for="contact_email">Contact Email <span class="text-danger">*</span></label>
							@if ($errors->has('contact_email'))
								<p role="alert" class='text-danger'><strong>{{ $errors->first('contact_email') }}</strong></p>
							@endif
							<input type='text' value="{{ old('contact_email')}}"  required="" name="contact_email" id="contact_email" class='form-control'>
						</div>
						<div class="form-group">
							<label for="schools">Schools </label>
							@if ($errors->has('schools.*') > 0)
								@foreach ($errors->get('schools.*') as $error)
									<p role="alert" class='text-danger'><strong>{{ $error[0] }}</strong></p>
								@endforeach
							@endif
							<select name="schools[]" id="schools" class='form-control multiple w-100' multiple="multiple">
								<option value="" disabled="" >Schools</option>
								@foreach(App\School::all() as $school)
									<option value="{{$school->id}}">{{$school->name}}</option>
								@endforeach
							</select>
						</div>
						<button type="submit" class="btn btn-outline-primary mt-4">Create</button>
				</form>
		</div>

	</div>
	</div>
@endsection