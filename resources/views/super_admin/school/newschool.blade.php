@extends('super_admin_inc.template')
@section('content')    
	<div class="container-fluid page-body-wrapper">
	  	<!-- partial -->
		<div class="main-panel p-4">
			<div class="super_admin_content">
				<form action="{{ route('super_admin.NewClient') }}" method="post" class="form" enctype="multipart/form-data">
						@csrf
						<h4 class="text-info">School Information</h4>
						@if(session()->has('success_group'))
							<div class="text-danger">
								{{ session()->get('success_group') }}
							</div>
						@endif
						<div class="form-group">
							<label for="logo">Logo <span class="text-danger">*</span> </label>
							@if ($errors->has('logo'))
								<p role="alert" class='text-danger'><strong>{{ $errors->first('logo') }}</strong></p>
							@endif
							<div class="custom-file mt-2">
								<input type="file" required="" class="custom-file-input" id="logo" name="logo" >
								<label class="custom-file-label" for="logo_for_client">Choose file</label>
							</div>
						</div>

						<div class="form-group">
							<label for="background_image_for_school">Background image  <span class="text-danger">*</span></label>
							@if ($errors->has('background_image'))
								<p role="alert" class='text-danger'><strong>{{ $errors->first('background_image') }}</strong></p>
							@endif
							<div class="custom-file">
								<input type="file" class="custom-file-input" required="" id="background_image_for_school" name="background_image">
								<label class="custom-file-label" for="background_image_for_school">Choose file</label>
							</div>
						</div>
						<div class="form-group">
							<label for="name_of_group">Group</label>
							@if ($errors->has('name_of_group'))
								<p role="alert" class='text-danger'><strong>{{ $errors->first('name_of_group') }}</strong></p>
							@endif
							<select class="form-control" name="name_of_group">
								<option value="" disabled="" {{ old('name_of_group')?'':'selected' }}>Select Group</option>
								@if (old('name_of_group'))
									@foreach(App\Groups::all() as $group)
										<option value="{{ $group->id }}"  <?php if($group->id == old('name_of_group')) {echo 'selected';} ?>>{{$group->name}}</option>
									@endforeach
								@else
									@foreach(App\Groups::all() as $group)
										<option value="{{ $group->id }}">{{$group->name}}</option>
									@endforeach
								@endif
							</select>
						</div>
						<div class="form-group">
							<label for="name_of_school">Name<span class="text-danger">*</span></label>
							@if ($errors->has('name'))
								<p role="alert" class='text-danger'><strong>{{ $errors->first('name') }}</strong></p>
							@endif
							<input type='text' value="{{ old('name') }}" name="name" id="name_of_school" class="form-control" required="">
						</div>
						<div class="form-group">
							<label for="date_of_launch">Date Of Launch <span class="text-danger">*</span></label>
							@if ($errors->has('date_of_launch'))
								<p role="alert" class='text-danger'><strong>{{ $errors->first('date_of_launch') }}</strong></p>
							@endif
							<input type='date' value="{{ old('date_of_launch')}}" name="date_of_launch" id="date_of_launch" class='form-control' required="">
						</div>
						<div class="form-group">
							<label for="first_name_of_administrative_contact">First Name Of Administrator Contact <span class="text-danger">*</span></label>
							@if ($errors->has('first_name_of_administrative_contact'))
								<p role="alert" class='text-danger'><strong>{{ $errors->first('first_name_of_administrative_contact') }}</strong></p>
							@endif
							<input type="text" id="first_name_of_administrative_contact" value=" {{old('first_name_of_administrative_contact')}}"   class="form-control" placeholder="Enter first name of administrator" name="first_name_of_administrative_contact" required >
						</div>
						<div class="form-group">
							<label for="last_name_of_administrative_contact">Last Name Of Administrator Contact <span class="text-danger">*</span></label>
							@if ($errors->has('last_name_of_administrative_contact'))
								<p role="alert" class='text-danger'><strong>{{ $errors->first('last_name_of_administrative_contact') }}</strong></p>
							@endif
							<input type="text" id="last_name_of_administrative_contact" value="{{old('last_name_of_administrative_contact')}}"  class="form-control" placeholder="Enter last name of administrator" name="last_name_of_administrative_contact" required >
						</div>
						<div class="form-group">
							<label for="email_of_the_administrative_contact"> Email of the administrative contact<span class="text-danger">*</span></label>
							@if ($errors->has('email_of_the_administrative_contact'))
								<p role="alert" class='text-danger'><strong>{{ $errors->first('email_of_the_administrative_contact') }}</strong></p>
							@endif
							<input type="text" id="email_of_the_administrative_contact" value="{{old('email_of_the_administrative_contact')}}"  class="form-control" placeholder="Enter last name of administrator" name="email_of_the_administrative_contact" required >
						</div>
						<div class="form-group">
							<label for="first_name_of_the_person_in_charge_of_alumni"> First name of the person in charge of alumni<span class="text-danger">*</span></label>
							@if ($errors->has('first_name_of_the_person_in_charge_of_alumni'))
								<p role="alert" class='text-danger'><strong>{{ $errors->first('first_name_of_the_person_in_charge_of_alumni') }}</strong></p>
							@endif
							<input type="text" id="first_name_of_the_person_in_charge_of_alumni" value="{{old('first_name_of_the_person_in_charge_of_alumni')}}"  class="form-control" placeholder="Enter last name of administrator" name="first_name_of_the_person_in_charge_of_alumni" required >
						</div>
						<div class="form-group">
							<label for="last_name_of_the_person_in_charge_of_alumni"> Last name of the person in charge of alumni<span class="text-danger">*</span></label>
							@if ($errors->has('last_name_of_the_person_in_charge_of_alumni'))
								<p role="alert" class='text-danger'><strong>{{ $errors->first('last_name_of_the_person_in_charge_of_alumni') }}</strong></p>
							@endif
							<input type="text" id="last_name_of_the_person_in_charge_of_alumni" value="{{ old('last_name_of_the_person_in_charge_of_alumni')}}"  class="form-control" placeholder="Enter last name of administrator" name="last_name_of_the_person_in_charge_of_alumni" required >
						</div>
						<div class="form-group">
							<label for="email_of_the_person_in_charge_of_alumni">  Email of the person in charge of alumni<span class="text-danger">*</span></label>
							@if ($errors->has('email_of_the_person_in_charge_of_alumni'))
								<p role="alert" class='text-danger'><strong>{{ $errors->first('email_of_the_person_in_charge_of_alumni') }}</strong></p>
							@endif
							<input type="text" id="email_of_the_person_in_charge_of_alumni" value="{{ old('last_name_of_the_person_in_charge_of_alumni')}}"  class="form-control" placeholder="Enter last name of administrator" name="email_of_the_person_in_charge_of_alumni" required >
						</div>
						<div class="form-group">
							<label for="url">URL <span class="text-danger">*</span></label>
							@if ($errors->has('url'))
								<p role="alert" class='text-danger'><strong>{{ $errors->first('url') }}</strong></p>
							@endif
							<input type='text' value="{{old('url') }}" name="url" id="url" class='form-control' required="">
						</div>

						<div class="form-group">
							<label for="survey">Survey</label>
							<select class="form-control" name="survey">
								<option value="" disabled="" {{ old('survey')?'':'selected' }}>Select Survey</option>
								@foreach(App\Survey::all() as $survey)
									<option value="{{ $survey->id }}">{{$survey->name}}</option>
								@endforeach
							</select>
						</div>
						<button type="submit" class="btn btn-outline-primary mt-4">Create</button>
				</form>
		</div>

	</div>
	</div>
@endsection