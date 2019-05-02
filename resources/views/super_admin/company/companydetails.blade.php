@extends('super_admin_inc.template')
@section('content')
    <div class="container-fluid page-body-wrapper">
        <!-- partial -->
        <div class="main-panel p-4">
            <div class="col-md-12 text-center">
                <h4 class="text-info">{{$company->name}}</h4>
            </div>
            <form  action="{{ route('super_admin.UpdateCompany') }}" class="mt-5 mb-5" method="post"  enctype="multipart/form-data">
                @csrf
                <input type='hidden' name="id" id="id_for_school" value="{{ Crypt::encrypt($company->id) }}">
                <div class="row">
                    <div class="col-md-4 offset-4">
                        <div class="col-md-10 offset-1">
                            <div class="form-group">
                                <label for="name">Name <span class="text-danger">*</span> </label>
                                @if ($errors->has('name'))
                                    <p role="alert" class='text-danger'><strong>{{ $errors->first('name') }}</strong></p>
                                @endif
                                <input type='text' value="{{$company->name}}" name="name"  required="" id="name" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="name">Description</span></label>
                                <textarea name="description" class="form-control">{{$company->description}}
                                </textarea>
                            </div>
                            <div class="col-md-12 text-center">
                                @if(!empty($company->logo))
                                    <img class="img_for_details_page mb-2" src="{{asset("images/Companies/" . $company->logo)}}">
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="logo">Logo </label>
                                @if ($errors->has('logo'))
                                    <p role="alert" class='text-danger'><strong>{{ $errors->first('logo') }}</strong></p>
                                @endif
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="logo" name="logo">
                                    <label class="custom-file-label" for="logo">Choose file</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="first_name">First Name<span class="text-danger">*</span></label>
                                @if ($errors->has('first_name'))
                                    <p role="alert" class='text-danger'><strong>{{ $errors->first('first_name') }}</strong></p>
                                @endif
                                <input type='text' value="{{ $company->first_name }}" name="first_name" id="first_name" class="form-control" required="">
                            </div>
                            <div class="form-group">
                                <label for="last_name">Last Name<span class="text-danger">*</span></label>
                                @if ($errors->has('last_name'))
                                    <p role="alert" class='text-danger'><strong>{{ $errors->first('last_name') }}</strong></p>
                                @endif
                                <input type='text' value="{{ $company->first_name }}" name="last_name" id="last_name" class="form-control" required="">
                            </div>
                            <div class="form-group">
                                <label for="function_of_the_person">Function of the person<span class="text-danger">*</span></label>
                                @if ($errors->has('function_of_the_person'))
                                    <p role="alert" class='text-danger'><strong>{{ $errors->first('function_of_the_person') }}</strong></p>
                                @endif
                                <input type="text" id="function_of_the_person" value="{{ $company->function_of_the_person }}"  class="form-control" placeholder="Last Name" name="function_of_the_person" required >
                            </div>
                            <div class="form-group">
                                <label for="email_of_the_person">Email of the person<span class="text-danger">*</span></label>
                                @if ($errors->has('email_of_the_person'))
                                    <p role="alert" class='text-danger'><strong>{{ $errors->first('email_of_the_person') }}</strong></p>
                                @endif
                                <input type="text" id="email_of_the_person" value="{{ $company->email_of_the_person }}"  class="form-control" placeholder="Last Name" name="email_of_the_person" required >
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
                                        @if(App\SchoolsOfTheCompany::where('school_id',$school->id)->where('company_id',$company->id)->first())
                                            <option selected value="{{$school->id}}">{{$school->name}}</option>
                                        @else
                                            <option value="{{$school->id}}">{{$school->name}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <button class="btn btn-success float-right">Edit</button>
                        </div>
                    </div>
                </div>

            </form>

            <div class="col-md-8 offset-2 mb-4">
                <div class="col-md-12 text-center">
                    <h4 class="text-info">List Of Job Offers</h4>
                </div>
                <table class="datatable table table-hover nowrap w-100" >
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Visit School</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach(App\JobOfTheCompany::where('company_id' , $company->id)->get() as $JobOfTheCompany)
                        <tr>
                            <td><p> {{$JobOfTheCompany->GetJobInfo->id}}</p> </td>
                            <td><p> {{$JobOfTheCompany->GetJobInfo->title}}</p> </td>
                            <td><a target="_blank" href="{{$JobOfTheCompany->GetJobInfo->link}}" class="btn btn-outline-primary"> Visit </a> </td>
                        </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
@endsection