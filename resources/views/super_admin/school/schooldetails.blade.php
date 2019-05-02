@extends('super_admin_inc.template')
@section('content')
    <div class="container-fluid page-body-wrapper">
        <!-- partial -->
        <div class="main-panel p-4">
            <div class="row">
                <div class="col-md-7">
                    <form  action="{{ route('super_admin.UpdateClient') }}" class="mt-5 mb-5" method="post"  enctype="multipart/form-data">
                        @csrf
                        <input type='hidden' name="id" id="id_for_school" value="{{ Crypt::encrypt($school->id) }}">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="col-md-10 offset-1">
                                    <div class="col-md-12 text-center">
                                        @if(!empty($school->logo))
                                            <img class="img_for_details_page mb-2" src="{{asset("images/Schools/" . $school->logo)}}">
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="logo_for_group">Logo <span class="text-danger">*</span> </label>
                                        @if ($errors->has('logo'))
                                            <p role="alert" class='text-danger'><strong>{{ $errors->first('logo') }}</strong></p>
                                        @endif
                                        <div class="custom-file mt-2">
                                            <input type="file" class="custom-file-input" id="logo_for_client" name="logo" >
                                            <label class="custom-file-label" for="logo_for_client">Choose file</label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="name_of_group">Group <span class="text-danger">*</span></label>
                                        @if ($errors->has('name_of_group'))
                                            <p role="alert" class='text-danger'><strong>{{ $errors->first('name_of_group') }}</strong></p>
                                        @endif
                                        <select value="3" class="form-control" name="name_of_group">
                                            <option value="" disabled="" {{ old('name_of_group')?'':'selected' }}>Select Group</option>
                                            @foreach(App\Groups::all() as $group)
                                                <option {{isset($SchoolOfTheGroup[0])? $SchoolOfTheGroup[0]->group_id == $group->id? 'selected' : '' : ""}} value="{{ $group->id }}">{{$group->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="name_of_school">Name<span class="text-danger">*</span></label>
                                        @if ($errors->has('name'))
                                            <p role="alert" class='text-danger'><strong>{{ $errors->first('name') }}</strong></p>
                                        @endif
                                        <input type='text' value="{{$school->name}}" name="name" id="name_of_school" class="form-control" required="">
                                    </div>
                                    <div class="form-group">
                                        <label for="date_of_launch">Date Of Launch <span class="text-danger">*</span></label>
                                        @if ($errors->has('date_of_launch'))
                                            <p role="alert" class='text-danger'><strong>{{ $errors->first('date_of_launch') }}</strong></p>
                                        @endif
                                        <input type='date' value="{{$school->date_of_launch}}" name="date_of_launch" id="date_of_launch" class='form-control' required="">
                                    </div>
                                    <div class="form-group">
                                        <label for="first_name_of_administrative_contact">First Name Of Administrator Contact <span class="text-danger">*</span></label>
                                        @if ($errors->has('first_name_of_administrative_contact'))
                                            <p role="alert" class='text-danger'><strong>{{ $errors->first('first_name_of_administrative_contact') }}</strong></p>
                                        @endif
                                        <input type="text" id="first_name_of_administrative_contact" value="{{$school->first_name_of_administrative_contact}}"   class="form-control" placeholder="Enter first name of administrator" name="first_name_of_administrative_contact" required >
                                    </div>
                                    <div class="form-group">
                                        <label for="last_name_of_administrative_contact">Last Name Of Administrator Contact <span class="text-danger">*</span></label>
                                        @if ($errors->has('last_name_of_administrative_contact'))
                                            <p role="alert" class='text-danger'><strong>{{ $errors->first('last_name_of_administrative_contact') }}</strong></p>
                                        @endif
                                        <input type="text" id="last_name_of_administrative_contact" value="{{$school->last_name_of_administrative_contact}}"  class="form-control" placeholder="Enter last name of administrator" name="last_name_of_administrative_contact" required >
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="col-md-10 offset-1">
                                    <div class="col-md-12 text-center">
                                        @if(!empty($school->background_image))
                                            <img class="img_for_details_page mb-2" src="{{asset("images/Schools/" . $school->background_image)}}">
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="background_image">Background Image <span class="text-danger">*</span> </label>
                                        @if ($errors->has('background_image'))
                                            <p role="alert" class='text-danger'><strong>{{ $errors->first('background_image') }}</strong></p>
                                        @endif
                                        <div class="custom-file mt-2">
                                            <input type="file" class="custom-file-input" id="background_image" name="background_image" >
                                            <label class="custom-file-label" for="background_image">Choose file</label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="email_of_the_administrative_contact"> Email of the administrative contact<span class="text-danger">*</span></label>
                                        @if ($errors->has('email_of_the_administrative_contact'))
                                            <p role="alert" class='text-danger'><strong>{{ $errors->first('email_of_the_administrative_contact') }}</strong></p>
                                        @endif
                                        <input type="text" id="email_of_the_administrative_contact" value="{{$school->email_of_the_administrative_contact}}"  class="form-control" placeholder="Enter last name of administrator" name="email_of_the_administrative_contact" required >
                                    </div>
                                    <div class="form-group">
                                        <label for="first_name_of_the_person_in_charge_of_alumni"> First name of the person in charge of alumni<span class="text-danger">*</span></label>
                                        @if ($errors->has('first_name_of_the_person_in_charge_of_alumni'))
                                            <p role="alert" class='text-danger'><strong>{{ $errors->first('first_name_of_the_person_in_charge_of_alumni') }}</strong></p>
                                        @endif
                                        <input type="text" id="first_name_of_the_person_in_charge_of_alumni" value="{{ $school->first_name_of_the_person_in_charge_of_alumni  }}"  class="form-control" placeholder="Enter last name of administrator" name="first_name_of_the_person_in_charge_of_alumni" required >
                                    </div>
                                    <div class="form-group">
                                        <label for="last_name_of_the_person_in_charge_of_alumni"> Last name of the person in charge of alumni<span class="text-danger">*</span></label>
                                        @if ($errors->has('last_name_of_the_person_in_charge_of_alumni'))
                                            <p role="alert" class='text-danger'><strong>{{ $errors->first('last_name_of_the_person_in_charge_of_alumni') }}</strong></p>
                                        @endif
                                        <input type="text" id="last_name_of_the_person_in_charge_of_alumni" value="{{ $school->last_name_of_the_person_in_charge_of_alumni  }}"  class="form-control" placeholder="Enter last name of administrator" name="last_name_of_the_person_in_charge_of_alumni" required >
                                    </div>
                                    <div class="form-group">
                                        <label for="email_of_the_person_in_charge_of_alumni">  Email of the person in charge of alumni<span class="text-danger">*</span></label>
                                        @if ($errors->has('email_of_the_person_in_charge_of_alumni'))
                                            <p role="alert" class='text-danger'><strong>{{ $errors->first('email_of_the_person_in_charge_of_alumni') }}</strong></p>
                                        @endif
                                        <input type="text" id="email_of_the_person_in_charge_of_alumni" value="{{ $school->last_name_of_the_person_in_charge_of_alumni  }}"  class="form-control" placeholder="Enter last name of administrator" name="email_of_the_person_in_charge_of_alumni" required >
                                    </div>
                                    <div class="form-group">
                                        <label for="url">URL <span class="text-danger">*</span></label>
                                        @if ($errors->has('url'))
                                            <p role="alert" class='text-danger'><strong>{{ $errors->first('url') }}</strong></p>
                                        @endif
                                        <input type='text' value="{{$school->url }}" name="url" id="url" class='form-control' required="">
                                    </div>
                                    <button class="btn btn-outline-danger float-right">Save</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-4">
                    <div class="col-md-12">
                        <div class="col-md-12 mb-2">
                            <button class="btn btn-outline-primary btn_for_show_admin_part">Add Administrator</button>
                        </div>
                        <div class="col-md-12 mb-4 mt-4 class_for_display_none div_for_form_admin_fields">
                            <form  action="{{ route('super_admin.AddAdminToClient') }}" method="post"  enctype="multipart/form-data">
                                @csrf
                                <input type='hidden' name="id" id="id_for_school" value="{{ Crypt::encrypt($school->id) }}">
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
                            @if($AdminOfTheSchool->count() > 0)
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
                                    @foreach($AdminOfTheSchool as $admin)
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
                </div>
            </div>

            <div class="col-md-8 offset-2">
                <div class="col-md-12 text-center">
                    <h4 class="text-info">List Of Users</h4>
                </div>
                <table class="datatable table table-hover nowrap w-100" >
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Degree</th>
                        <th>Status</th>
                        <th>Send Email</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($SchoolOfTheUsers as $SchoolOfTheUser)
                        <tr>
                            <td><p> {{$SchoolOfTheUser->GetUserInfo->id}}</p> </td>
                            <td><p> {{$SchoolOfTheUser->GetUserInfo->first_name}}</p> </td>
                            <td><p> {{$SchoolOfTheUser->GetUserInfo->last_name}}</p> </td>
                            <td><p> {{$SchoolOfTheUser->GetUserInfo->email}}</p> </td>
                            <td>
                                @if($SchoolOfTheUser->GetDegreeId->count() > 0 )
                                    @foreach($SchoolOfTheUser->GetDegreeId as $DegreeOfTheUser)
                                        <p>
                                            {{$DegreeOfTheUser->degree->name}}
                                        </p>
                                    @endforeach
                                @endif
                            </td>
                            <td><p> {{($SchoolOfTheUser->GetUserInfo->status == 1)? "Active":"Inactive"}}</p> </td>
                            <td>
                                <button access="{{ Crypt::encrypt($SchoolOfTheUser->GetUserInfo->id) }}" class="btn btn-outline-danger SendEmailToUser" >Send Email</button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-md-8 offset-2">
                <div class="col-md-12 text-center">
                    <h4 class="text-info">List Of Degrees</h4>
                </div>
                <div class="col-md-12 mb-2">
                    <button class="btn btn-outline-primary btn_for_show_add_degreet">Add Degree</button>
                </div>
                <div class="col-md-4 mb-4 mt-4 class_for_display_none div_for_form_add_degree">
                    <form  action="{{ route('super_admin.AddDegree') }}" method="post"  enctype="multipart/form-data">
                        @csrf
                        <input type='hidden' name="id" id="id_for_school" value="{{ Crypt::encrypt($school->id) }}">
                        <div class="form-group">
                            <label for="name_of_degree">Name<span class="text-danger">*</span></label>
                            @if ($errors->has('name_of_degree'))
                                <p role="alert" class='text-danger'><strong>{{ $errors->first('name_of_degree') }}</strong></p>
                            @endif
                            <input type='text' value="{{old('name_of_degree')}}" id="name_of_degree" placeholder="Name" name="name_of_degree" class="form-control">
                        </div>
                        <div class="form-group">
                            <button class="btn btn-outline-danger float-right">Add</button>
                        </div>
                    </form>
                </div>
                <table class="datatable table table-hover nowrap w-100" >
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Number Of Students</th>
                        <th>Date Of Launch</th>
                        <th></th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($DegreeOfTheSchools as $DegreeOfTheSchool)
                        <tr>
                            <td class="row_for_details" data-type="Degree" data-id="{{$DegreeOfTheSchool->degree->id}}"><p> {{$DegreeOfTheSchool->degree->id}}</p> </td>
                            <td class="row_for_details" data-type="Degree" data-id="{{$DegreeOfTheSchool->degree->id}}"><p> {{$DegreeOfTheSchool->degree->name}}</p> </td>
                            <td class="row_for_details" data-type="Degree" data-id="{{$DegreeOfTheSchool->degree->id}}"><p> {{$DegreeOfTheSchool->GetUsersOfDegree->count()}}</p> </td>
                            <td class="row_for_details" data-type="Degree" data-id="{{$DegreeOfTheSchool->degree->id}}"><p> {{$DegreeOfTheSchool->degree->date_of_launch}}</p> </td>
                            <td class="row_for_details" data-type="Degree" data-id="{{$DegreeOfTheSchool->degree->id}}">
                                <button access="{{ Crypt::encrypt($DegreeOfTheSchool->degree->id) }}" class="btn btn-outline-warning" >Edit</button>
                            </td>
                            <td>
                                <button access="{{ Crypt::encrypt($DegreeOfTheSchool->degree->id) }}" data="Degree" class="btn btn-outline-danger SADelete ml-1" >Delete</button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-md-8 offset-2 mt-5">
                <div class="col-md-12 text-center">
                    <h4 class="text-info">Active Surveys</h4>
                </div>
                <div class="col-md-12 mb-2">
                    <button class="btn btn-outline-primary btn_for_show_add_survey">Add Survey</button>
                </div>
                <div class="col-md-4 mb-4 mt-4 class_for_display_none div_for_form_add_survey">
                    <form  action="{{ route('super_admin.AddSurveyToSchool') }}" method="post"  enctype="multipart/form-data">
                        @csrf
                        <input type='hidden' name="id" id="id_for_school" value="{{ Crypt::encrypt($school->id) }}">
                        <div class="form-group">
                            <label for="survey_add">Surveys </label>
                            @if ($errors->has('survey_add'))
                                <p role="alert" class='text-danger'><strong>{{ $errors->first('survey_add') }}</strong></p>
                            @endif
                            <select value="3" class="form-control" name="survey_add">
                                <option value="" disabled="" {{ old('survey_add')?'':'selected' }}>Select Group</option>
                                @foreach(App\Survey::all() as $survey)
                                    <option {{isset($SchoolOfTheGroup[0])? $SchoolOfTheGroup[0]->group_id == $survey->id? 'selected' : '' : ""}} value="{{ $survey->id }}">{{$survey->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-outline-danger float-right">Add</button>
                        </div>
                    </form>
                </div>
                <table class="datatable table table-hover nowrap w-100" >
                    <thead>
                    <tr>
                        <th>Name</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($SurveyOfTheSchools as $SurveyOfTheSchool)
                        <tr>
                            <td><p> {{$SurveyOfTheSchool->GetSurveyInfo->name}}</p> </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-md-8 offset-2 mt-5">
                <div class="col-md-12 text-center">
                    <h4 class="text-info">Last Job Offers</h4>
                </div>
                <table class="datatable table table-hover nowrap w-100" >
                    <thead>
                    <tr>
                        <th>Name</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($JobOfTheUserLasts as $JobOfTheUserLast)
                            <tr>
                                <td>
                                    <p>
                                        {{$JobOfTheUserLast->job->title}}
                                    </p>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @if($errors->has('Client'))
        <script>
            setTimeout(function(){
                $(".btn_for_show_admin_part").trigger('click')
            },1000)
        </script>
    @endif
    @if($errors->has('Degree'))
        <script>
            setTimeout(function(){
                $(".btn_for_show_add_degreet").trigger('click')
            },1000)
        </script>
    @endif
@endsection