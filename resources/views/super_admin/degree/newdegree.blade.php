@extends('super_admin_inc.template')
@section('content')    
	<div class="container-fluid page-body-wrapper">
	  	<!-- partial -->
		<div class="main-panel p-4">
			<div class="super_admin_content">
				<form action="{{ route('super_admin.NewDegree') }}" method="post" class="form" enctype="multipart/form-data">
						@csrf
						<h4 class="text-info">Degree Information</h4>
						@if(session()->has('success_group'))
							<div class="text-success">
								{{ session()->get('success_group') }}
							</div>
						@endif
						<div class="form-group">
							<label for="name_of_degree">Name <span class="text-danger">*</span></label>
							@if ($errors->has('name'))
								<p role="alert" class='text-danger'><strong>{{ $errors->first('name') }}</strong></p>
							@endif
							<input type="text" id="name_of_degree" value="{{ old('name') }}"  class="form-control" placeholder="Enter Degree name" name="name" required >
						</div>
						<button type="submit" class="btn btn-outline-primary mt-4">Create</button>
				</form>
		</div>

	</div>
	</div>
@endsection