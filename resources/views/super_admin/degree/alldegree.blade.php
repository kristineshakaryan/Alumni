@extends('super_admin_inc.template')
@section('content')    
  <div class="container-fluid page-body-wrapper">
	  <!-- partial -->
	    <div class="main-panel p-3 container">
	        <table class="datatable table table-hover nowrap w-100" >
	            <thead>
	                <tr>
	                    <th>Name</th>
	                    <th></th>
	                    <th></th>
	                </tr>
	            </thead>
	            <tbody>
	            	@foreach($degrees as $degree)
		                <tr>
		                    <td><p> {{$degree->name}}</p> </td>
		                    <td>
	                            <button access="{{ Crypt::encrypt($degree->id) }}" data-toggle="modal" data-target="#editDegree" class="btn btn-outline-warning editDegree" >Edit</button>
		                    </td>
							<td>
								<button access="{{ Crypt::encrypt($degree->id) }}" data="Degree" class="btn btn-outline-danger SADelete ml-1" >Delete</button>
							</td>
						</tr>
	                @endforeach
	            </tbody>
	            <tfoot>
	                <tr>
						<th>Name</th>
						<th></th>
						<th></th>
	                </tr>
	            </tfoot>
	        </table>

			<!-- Modal -->
			<div class="modal fade" id="editDegree" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel">Edit Group</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<form action="{{ route('super_admin.UpdateDegree') }}" method="post" class="editgroupmodal" enctype="multipart/form-data">
							<div class="modal-body">
								@csrf
								<input type='hidden' name="id" id="id_for_degree">
								<div class="form-group">
									<label for="name_of_degree">Name <span class="text-danger">*</span></label>
									@if ($errors->has('name'))
										<p role="alert" class='text-danger'><strong>{{ $errors->first('name') }}</strong></p>
									@endif
									<input type='text' value="{{ old('name') }}" name="name" id="name_of_degree" class="form-control" required="">
								</div>
							</div>
							<div class="modal-footer">
								<button  class="btn btn-secondary" data-dismiss="modal">Close</button>
								<button  class="btn btn-primary btn_for_trigger_form_edit">Save</button>
							</div>
						</form>
					</div>
				</div>
			</div>
	    </div>
	</div>
  @if($errors->has('Degree'))
	  <script>
		  setTimeout(function(){
			  $('#editDegree').modal()
		  },1000)


	  </script>
  @endif
@endsection














