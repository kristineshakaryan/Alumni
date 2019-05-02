@extends('super_admin_inc.template')
@section('content')    
	<div class="container-fluid page-body-wrapper">
	  	<!-- partial -->
		<div class="main-panel p-4">
			<div class="super_admin_content">
				<form action="{{ route('super_admin.NewJobBoard') }}" method="post" class="form" enctype="multipart/form-data">
						@csrf
						<h4 class="text-info">Job Bord Information</h4>
						<div class="form-group">
							<label for="title">Title <span class="text-danger">*</span></label>
							@if ($errors->has('title'))
								<p role="alert" class='text-danger'><strong>{{ $errors->first('title') }}</strong></p>
							@endif
							<input type="text" id="title" value="{{ old('title') }}"  class="form-control" placeholder="Enter Job Bord title" name="title" required >
						</div>
						<button type="submit" class="btn btn-outline-primary mt-4">Create</button>
				</form>
		</div>

	</div>
	</div>
@endsection