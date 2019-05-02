@extends('super_admin_inc.template')
@section('content')
    <div class="container-fluid page-body-wrapper">
        <!-- partial -->
        <div class="main-panel p-4">
            <div class="col-md-12 text-center">
                <h4 class="text-info">{{$group->name}}</h4>
            </div>
            <div class="row">
                <div class="col-md-7">
                    <form  action="{{ route('super_admin.UpdateGroup') }}" class="mt-5 mb-5" method="post"  enctype="multipart/form-data">
                        @csrf
                        <input type='hidden' name="id" id="id_for_school" value="{{ Crypt::encrypt($group->id) }}">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="col-md-10 offset-1">
                                    <div class="col-md-12 text-center">
                                        @if(!empty($group->logo))
                                            <img class="img_for_details_page mb-2" src="{{asset("images/Groups/" . $group->logo)}}">
                                        @endif
                                    </div>
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
                                            <p role="alert" class='text-danger'><strong>{{ $errors->first('name') }}</strong></p>
                                        @endif
                                        <input type='text' value="{{$group->name}}" name="name"  required="" id="name_of_group" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="date_of_launch">Date Of Launch <span class="text-danger">*</span></label>
                                        @if ($errors->has('date_of_launch'))
                                            <p role="alert" class='text-danger'><strong>{{ $errors->first('date_of_launch') }}</strong></p>
                                        @endif
                                        <input type='date' value="{{ $group->date_of_launch }}" name="date_of_launch" id="date_of_launch" class='form-control' required="">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="col-md-10 offset-1">
                                    <div class="form-group">
                                        <label for="contact_first_name">Contact First Name <span class="text-danger">*</span></label>
                                        @if ($errors->has('contact_first_name'))
                                            <p role="alert" class='text-danger'><strong>{{ $errors->first('contact_first_name') }}</strong></p>
                                        @endif
                                        <input type='text' value="{{ $group->contact_first_name }}"  required="" name="contact_first_name" id="contact_first_name" class='form-control'>
                                    </div>
                                    <div class="form-group">
                                        <label for="contact_last_name">Contact Last Name <span class="text-danger">*</span></label>
                                        @if ($errors->has('contact_last_name'))
                                            <p role="alert" class='text-danger'><strong>{{ $errors->first('contact_last_name') }}</strong></p>
                                        @endif
                                        <input type='text' value="{{ $group->contact_last_name }}"  required="" name="contact_last_name" id="contact_last_name" class='form-control'>
                                    </div>
                                    <div class="form-group">
                                        <label for="contact_email">Contact Email <span class="text-danger">*</span></label>
                                        @if ($errors->has('contact_email'))
                                            <p role="alert" class='text-danger'><strong>{{ $errors->first('contact_email') }}</strong></p>
                                        @endif
                                        <input type='text' value="{{ $group->contact_email }}"  required="" name="contact_email" id="contact_email" class='form-control'>
                                    </div>
                                    <div class="form-group">
                                        <label for="schools">Schools  <span class="text-danger">*</span></label>
                                        @if ($errors->has('schools.*') > 0)
                                            @foreach ($errors->get('schools.*') as $error)
                                                <p role="alert" class='text-danger'><strong>{{ $error[0] }}</strong></p>
                                            @endforeach
                                        @endif
                                        <select name="schools[]" id="schools" class='form-control multiple w-100' multiple="multiple" required="">
                                            <option value="" disabled="" >Schools</option>
                                            @foreach(App\School::all() as $school)
                                                @if(App\SchoolOfTheGroup::where('school_id',$school->id)->where('group_id',$group->id)->first())
                                                    <option selected value="{{$school->id}}">{{$school->name}}</option>
                                                @else
                                                    <option value="{{$school->id}}">{{$school->name}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                    <button class="btn btn-outline-danger float-right">Save</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-4 text-center">
                    <div class="col-md-12 mb-2">
                        <button class="btn btn-outline-primary btn_for_show_admin_part">Add Administrator</button>
                    </div>
                    <div class="col-md-12 mt-4 class_for_display_none div_for_form_admin_fields">
                        <form  action="{{ route('super_admin.AddAdminToGroup') }}" method="post"  enctype="multipart/form-data">
                            @csrf
                            <input type='hidden' name="id" id="id_for_school" value="{{ Crypt::encrypt($group->id) }}">
                            <div class="form-group">
                                <label for="first_name_for_new_admin">First Name Of Admin<span class="text-danger">*</span></label>
                                @if ($errors->has('first_name_for_new_admin'))
                                    <p role="alert" class='text-danger'><strong>{{ $errors->first('first_name_for_new_admin') }}</strong></p>
                                @endif
                                <input type='text' value="{{old('first_name_for_new_admin')}}" id="first_name_for_new_admin" placeholder="First Name Of Admin" name="first_name_for_new_admin" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="last_name_for_new_admin">Last Name Of Admin<span class="text-danger">*</span></label>
                                @if ($errors->has('last_name_for_new_admin'))
                                    <p role="alert" class='text-danger'><strong>{{ $errors->first('last_name_for_new_admin') }}</strong></p>
                                @endif
                                <input type='text' value="{{old('last_name_for_new_admin')}}" id="last_name_for_new_admin" placeholder="Last Name Of Admin" name="last_name_for_new_admin" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="email_for_new_admin">Email Of Admin<span class="text-danger">*</span></label>
                                @if ($errors->has('email_for_new_admin'))
                                    <p role="alert" class='text-danger'><strong>{{ $errors->first('email_for_new_admin') }}</strong></p>
                                @endif
                                <input type='text' value="{{old('email_for_new_admin')}}" id="email_for_new_admin" placeholder="Email Of Admin" name="email_for_new_admin" class="form-control">
                            </div>
                            <div class="form-group">
                                <button class="btn btn-outline-danger float-right">Add</button>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-12 mt-5"></div>
                    <div class="col-md-12 mt-4">
                        @if($AdminOfTheGroup->count() > 0)
                            <table class="table table-hover nowrap w-100" >
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>First name</th>
                                    <th>Last name</th>
                                    <th>Email</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($AdminOfTheGroup as $admin)
                                    <tr>
                                        <td><p> {{$admin->GetAdminInfo->id}}</p> </td>
                                        <td><p> {{$admin->GetAdminInfo->first_name}}</p> </td>
                                        <td><p> {{$admin->GetAdminInfo->last_name}}</p> </td>
                                        <td><p> {{$admin->GetAdminInfo->email}}</p> </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>
                </div>
                <div class="col-md-8 offset-2 mb-4">
                    <div class="col-md-12 text-center">
                        <h4 class="text-info">List Of Schools</h4>
                    </div>
                    <table class="datatable table table-hover nowrap w-100" >
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Visit School</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($schools as $school)
                            <tr>
                                <td><p> {{$school->id}}</p> </td>
                                <td><p> {{$school->name}}</p> </td>
                                <td><a target="_blank" href="{{$school->url}}" class="btn btn-outline-primary"> Visit </a> </td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        </tfoot>
                    </table>
                </div>
                <div class="col-md-8 offset-2 mb-4">
                    <div class="col-md-12 text-center">
                        <h4 class="text-info">Number Of Users : {{$NumberOfUsers}} </h4>
                    </div>
                </div>
        </div>
    </div>
    @if($errors->has('Group'))
        <script>
            setTimeout(function(){
                $(".btn_for_show_admin_part").trigger('click')
            },1000)
        </script>
    @endif
@endsection