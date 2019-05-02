@extends('super_admin_inc.template')
@section('content')
  <div class="container-fluid page-body-wrapper">
	  <!-- partial -->
	    <div class="main-panel p-3">
	        <table class="datatable table table-hover nowrap w-100 table_for_school" >
	            <thead>
	                <tr>
	                    <th>ID</th>
	                    <th>Group Name</th>
	                    <th>School Name</th>
						<th>Creation Date</th>
						<th>Email of the administrative contact</th>
						<th>URL</th>
						<th>Degree Number</th>
						<th>Users Number</th>
						<th></th>
						<th></th>
					</tr>
				</thead>
				<tbody>
				@foreach($schools as $key => $school)
					<tr >
						<td class="row_for_details" data-type="Client" data-id="{{$school->id}}"> <p> {{$school->id}}</p> </td>
						<td class="row_for_details" data-type="Client" data-id="{{$school->id}}">
							<p>
								@if(isset($school->checkifBusy->GetGroupInfo->name))
									{{$school->checkifBusy->GetGroupInfo->name}}
								@else
									-
								@endif
							</p>
						</td>
						<td class="row_for_details" data-type="Client" data-id="{{$school->id}}"> <p> {{$school->name}}</p> </td>
						<td class="row_for_details" data-type="Client" data-id="{{$school->id}}"> <p> {{$school->created_at}}</p> </td>
						<td class="row_for_details" data-type="Client" data-id="{{$school->id}}"> <p> {{$school->email_of_the_administrative_contact}}</p> </td>
						<td class="row_for_details" data-type="Client" data-id="{{$school->id}}"> <p> {{$school->url}}</p> </td>
						<td class="row_for_details" data-type="Client" data-id="{{$school->id}}"> <p> {{$school->GetDegree->count()}}</p> </td>
						<td class="row_for_details" data-type="Client" data-id="{{$school->id}}"> <p> {{$school->GetUsers->count()}}</p> </td>
						<td class="row_for_details" data-type="Client" data-id="{{$school->id}}">
							<button data-school-id="{{$school->id}}" access="{{ Crypt::encrypt($school->id) }}" class="btn btn-outline-warning editSchool" >Edit</button>
						</td>
						<td>
							<button access="{{ Crypt::encrypt($school->id) }}" data="Client" class="btn btn-outline-danger SADelete ml-1">Delete</button>
						</td>
					</tr>
				@endforeach
				</tbody>
			</table>
		</div>
  </div>

@endsection