@extends('super_admin_inc.template')
@section('content')
    <div class="container-fluid page-body-wrapper">
        <!-- partial -->
        <div class="main-panel p-3">
            <div class="super_admin_content mb-4">
                <form action="{{ route('super_admin.AddNewUserCsv') }}" method="post" enctype='multipart/form-data'>
                    @csrf
                    @if ($errors->has('csv'))
                        <p role="alert" class='text-danger'><strong>{{ $errors->first('csv') }}</strong></p>
                    @endif
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="csv_upload" name="csv">
                        <label class="custom-file-label" for="csv_upload">Choose file</label>
                    </div>
                </form>
            </div>

            <table class="datatable_users table table-hover nowrap w-100" >
                <thead>
                <tr>
                    <th>First name</th>
                    <th>Last name</th>
                    <th>Email</th>
                    <th>Category</th>
                    <th>School</th>
                    <th>Degree</th>
                    <th>Active</th>
                    <th>Date Of Import</th>
                    <th></th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $key => $user)
                    <tr>
                        <td class="row_for_details" data-type="User" data-id="{{$user->id}}"><p> {{$user->first_name}}</p> </td>
                        <td class="row_for_details" data-type="User" data-id="{{$user->id}}"><p> {{$user->last_name}}</p> </td>
                        <td class="row_for_details" data-type="User" data-id="{{$user->id}}"><p> {{$user->email}}</p> </td>
                        <td class="row_for_details" data-type="User" data-id="{{$user->id}}">
                            @if($user->chooseColor)
                                @if($user->chooseColor->category)
                                    <p style="padding:5px;width:100%;text-align:center;color:{{$user->chooseColor->category->color}};border:1px dotted {{$user->chooseColor->category->color}}"> {{$user->chooseColor->category->title}}</p>
                                @endif
                            @endif
                        </td>
                        <td class="row_for_details" data-type="User" data-id="{{$user->id}}">
                            @if($user->chooseSchool)
                                <p>
                                    @foreach($user->chooseSchool as $school)
                                        @if($school->school)
                                            <span>{{$school->school->name}} </span>
                                        @endif
                                    @endforeach
                                </p>
                            @endif
                        </td>
                        <td class="row_for_details" data-type="User" data-id="{{$user->id}}">
                            @if($user->chooseDegree)
                                <p>
                                    @foreach($user->chooseDegree as $degree)
                                        @if($degree->degree)
                                            <span>{{$degree->degree->name}} </span>
                                        @endif
                                    @endforeach
                                </p>
                            @endif
                        </td>
                        <td class="row_for_details" data-type="User" data-id="{{$user->id}}"><p> {{$user->status == 1 ? "Active" : "Inactive" }} </p> </td>
                        <td class="row_for_details" data-type="User" data-id="{{$user->id}}">
                            {{$user->date_of_import}}
                        </td>
                        <td class="row_for_details" data-type="User" data-id="{{$user->id}}">
                            <button access="{{ Crypt::encrypt($user->id) }}" class="btn btn-outline-warning edituser" >Edit</button>
                        </td>
                        <td>
                            <button access="{{ Crypt::encrypt($user->id) }}" data="User" class="btn btn-outline-danger SADelete ml-1" >Delete</button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDvvqgc0KhI8v-1cqDl2lbDpy12TFVKe_U&libraries=places&callback=initAutocomplete"async defer></script>
<script>
    function initAutocomplete() {
        var input = document.getElementById('city');
        var opts = {
            types: ['(cities)']
        };
        new google.maps.places.Autocomplete(input, opts);

    }
    $(document).ready(function() {
        var table = $('.datatable_users').DataTable();
        table.order( [ 7, 'desc' ] ).draw();
    } );
</script>
@endsection














