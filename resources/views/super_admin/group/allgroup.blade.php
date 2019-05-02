@extends('super_admin_inc.template')
@section('content')    
  <div class="container-fluid page-body-wrapper">
	  <!-- partial -->
	    <div class="main-panel p-3">
	        <table class="datatable table table-hover nowrap w-100" >
	            <thead>
	                <tr>
	                    <th>ID</th>
	                    <th>Name</th>
	                    <th>Schools</th>
						<th>Date Of Creation</th>
						<th>Number of user</th>
	                    <th></th>
	                    <th></th>
	                </tr>
	            </thead>
	            <tbody>
	            	@foreach($groups as $key => $group)
		                <tr>
		                    <td class="row_for_details" data-type="Group" data-id="{{$group->id}}"><p> {{$group->id}}</p> </td>
		                    <td class="row_for_details" data-type="Group" data-id="{{$group->id}}"><p> {{$group->name}}</p> </td>
							<td class="row_for_details" data-type="Group" data-id="{{$group->id}}">
								@if( $group->SchoolsOfTheGroup )
									@foreach($group->SchoolsOfTheGroup as $SchoolOfTheGroup)
										<p>
											{{$SchoolOfTheGroup->ChooseSchoolInfo->name}}
										</p>
									@endforeach
								@endif
							</td>
							<td class="row_for_details" data-type="Group" data-id="{{$group->id}}"><p> {{$group->created_at}}</p> </td>
							<td class="row_for_details" data-type="Group" data-id="{{$group->id}}">
								@php
									$CountOfUsers = 0
								@endphp
								@foreach(App\SchoolOfTheGroup::where('group_id',$group->id)->get() as $SchoolOfTheGroup )
									@php
										$CountOfUsers += $SchoolOfTheGroup->SchoolOfTheUser->count()
									@endphp
								@endforeach
								{{$CountOfUsers}}
							</td>
							<td class="row_for_details" data-type="Group" data-id="{{$group->id}}">
								<button access="{{ Crypt::encrypt($group->id) }}" data-toggle="modal" data-target="#editGroup" class="btn btn-outline-warning editGroup">Edit</button>
		                    </td>
							<td>
								<button access="{{ Crypt::encrypt($group->id) }}" data="Group" class="btn btn-outline-danger SADelete ml-1" >Delete</button>

							</td>
						</tr>
	                @endforeach
	            </tbody>
	        </table>
	    </div>
	</div>
@endsection