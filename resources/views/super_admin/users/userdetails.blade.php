@extends('super_admin_inc.template')
@section('content')
    <div class="container-fluid page-body-wrapper">
        <!-- partial -->
        <div class="main-panel p-4">
            <div class="col-md-10 text-center">
                <h4 class="text-info">{{$user->first_name}} {{$user->first_name}}</h4>
            </div>
            <div class="row">
                <div class="col-md-10">
                    <form  action="{{ route('super_admin.UpdateUser') }}" class="mt-5 mb-5" method="post"  enctype="multipart/form-data">
                        @csrf
                        <input type='hidden' name="id" value="{{ Crypt::encrypt($user->id) }}">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="col-md-10 offset-1">
                                    <div class="col-md-12 text-center">
                                        @if(!empty($user->avatar))
                                            <img class="img_for_details_page mb-2" src="{{asset("images/Users/" . $user->avatar)}}">
                                        @else
                                            <img class="img_for_details_page mb-2" src="{{asset("images/Users/default.jpg")}}">
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="avatar">Picture <span class="text-danger">*</span> </label>
                                        @if ($errors->has('avatar'))
                                            <p role="alert" class='text-danger'><strong>{{ $errors->first('avatar') }}</strong></p>
                                        @endif
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="avatar" name="avatar">
                                            <label class="custom-file-label" for="avatar">Choose file</label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="first_name">First Name <span class="text-danger">*</span> </label>
                                        @if ($errors->has('first_name'))
                                            <p role="alert" class='text-danger'><strong>{{ $errors->first('name') }}</strong></p>
                                        @endif
                                        <input type='text' value="{{$user->first_name}}" name="first_name"  required="" id="first_name" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="last_name">Last Name <span class="text-danger">*</span> </label>
                                        @if ($errors->has('last_name'))
                                            <p role="alert" class='text-danger'><strong>{{ $errors->first('last_name') }}</strong></p>
                                        @endif
                                        <input type='text' value="{{$user->last_name}}" name="last_name"  required="" id="last_name" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email <span class="text-danger">*</span> </label>
                                        @if ($errors->has('email'))
                                            <p role="alert" class='text-danger'><strong>{{ $errors->first('email') }}</strong></p>
                                        @endif
                                        <input type='text' value="{{$user->email}}" name="email"  required="" id="email" class="form-control">
                                    </div>
                                    @if ($user->linkedin == 1)
                                        <div class="form-group text-center">
                                            <a href="{{$user->linkedin_url}}">
                                                <img class="img_for_some_icon mb-2" src="{{asset("images/Custom/linkdin.png")}}">
                                            </a>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="col-md-10 offset-1">
                                    <div class="form-group">
                                        <label for="category">Category <span class="text-danger">*</span></label>
                                        @if ($errors->has('category'))
                                            <p role="alert" class='text-danger'><strong>{{ $errors->first('category') }}</strong></p>
                                        @endif
                                        <select id="category" name="category"  class="form-control" required="">
                                            <option value="" disabled {{ old('category')?'':'selected' }}>Select Category</option>
                                            @foreach(App\Category::all() as $category)
                                                <option {{(App\CategoryOfTheUser::where('user_id',$user->id)->first())? 'selected' : ""}} value="{{ $category->id }}">{{$category->title}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="schools">Schools  <span class="text-danger">*</span></label>
                                        @if ($errors->has('schools.*') > 0)
                                            @foreach ($errors->get('schools.*') as $error)
                                                <p role="alert" class='text-danger'><strong>{{ $error[0] }}</strong></p>
                                            @endforeach
                                        @endif
                                        <select name="schools[]" id="schools" class='form-control multiple w-100 school_input_for_user' multiple="multiple" required="">
                                            <option value="" disabled="" >Schools</option>
                                            @foreach(App\School::all() as $school)
                                                @if(App\SchoolOfTheUser::where('school_id',$school->id)->where('user_id',$user->id)->first())
                                                    <option selected value="{{$school->id}}">{{$school->name}}</option>
                                                @else
                                                    <option value="{{$school->id}}">{{$school->name}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="current_degree">Current Degree </label>
                                        <input type="text" id="current_degree" value="{{ (isset($DegreeOfTheUser[0]))? $DegreeOfTheUser[0]->degree->name : ""}}" disabled class="form-control" >
                                    </div>
                                    <div class="form-group div_for_degree_of_the_school class_for_display_none">
                                        <label for="degree">New Degree</label>
                                        @if ($errors->has('degree') > 0)
                                            @foreach ($errors->get('degree') as $error)
                                                <p role="alert" class='text-danger'><strong>{{ $errors->first('degree') }}</strong></p>
                                            @endforeach
                                        @endif
                                        <select name="degree" id="degree" class='form-control' >
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="graduation_year">Year of graduation <span class="text-danger">*</span></label>
                                        @if ($errors->has('graduation_year'))
                                            <p role="alert" class='text-danger'><strong>{{ $errors->first('graduation_year') }}</strong></p>
                                        @endif
                                        <select name="graduation_year" id="graduation_year" class='form-control multiple w-100' required="">
                                            <option value="" disabled="" >Year of graduation</option>
                                            @foreach(App\GraduationYear::all() as $graduation_year)
                                                <option {{($user->graduation_year_id)? ($user->graduation_year_id == $graduation_year->id)? 'selected':"" :''}} value="{{$graduation_year->id}}">{{$graduation_year->year}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="city">City </label>
                                        <input type="text" id="city" value="{{ $user->city }}"  class="form-control" placeholder="Enter City" name="city" >
                                    </div>
                                    <div class="form-group">
                                        <label class="switch switch-label switch-pill switch-success switch-sm">
                                            <input name="mentorat" {{($user->mentorat )? 'checked' : ''}} class="switch-input user_status" type="checkbox">
                                            Mentor
                                            <span class="switch-slider" data-checked="Yes" data-unchecked="No"></span>
                                        </label>
                                    </div>

                                    <button class="btn btn-outline-danger float-right">Save</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-8 offset-1 mb-4">
                    <div class="col-md-12 text-center">
                        <a href="{{route('super_admin.DownloadSurveyAnswersUser', $user->id)}}" class="btn btn-outline-secondary">Survey answers</a>
                    </div>
                </div>
                <div class="col-md-8 offset-1 mb-4">
                    <div class="col-md-12 text-center">
                        <h4 class="text-info">List Of Job Offer</h4>
                    </div>
                    <table class="datatable table table-hover nowrap w-100" >
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Link</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach(App\JobOfTheUser::where('user_id',$user->id)->get() as $JobOfTheUser)
                            <tr>
                                <td><p> {{$JobOfTheUser->job->id}}</p> </td>
                                <td><p> {{$JobOfTheUser->job->title}}</p> </td>
                                <td><a href="{{$JobOfTheUser->job->link}}" class="btn btn-outline-success">Link</a></td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        </tfoot>
                    </table>
                </div>
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
        </script>
@endsection