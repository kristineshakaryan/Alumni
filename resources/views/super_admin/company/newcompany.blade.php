@extends('super_admin_inc.template')
@section('content')
    <div class="container-fluid page-body-wrapper">
        <!-- partial -->
        <div class="main-panel p-4">
            <div class="super_admin_content">
                <form action="{{ route('super_admin.Newcompany') }}" method="post" class="form" enctype="multipart/form-data">
                    @csrf
                    <h4 class="text-info">Company Information</h4>
                    @if(session()->has('success_group'))
                        <div class="text-danger">
                            {{ session()->get('success_group') }}
                        </div>
                    @endif
                    <div class="form-group">
                        <label for="name">Name <span class="text-danger">*</span></label>
                        @if ($errors->has('name'))
                            <p role="alert" class='text-danger'><strong>{{ $errors->first('name') }}</strong></p>
                        @endif
                        <input type="text" id="name" value="{{ old('name') }}"  class="form-control" placeholder="Name" name="name" required >
                    </div>
                    <div class="form-group">
                        <label for="name">Description</span></label>
                        <textarea name="description" class="form-control">
                        </textarea>
                    </div>
                    <div class="form-group">
                        <label for="logo">Logo  <span class="text-danger">*</span></label>
                        @if ($errors->has('logo'))
                            <p role="alert" class='text-danger'><strong>{{ $errors->first('logo') }}</strong></p>
                        @endif
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" required="" id="logo" name="logo">
                            <label class="custom-file-label" for="logo">Choose file</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="first_name">First Name <span class="text-danger">*</span></label>
                        @if ($errors->has('first_name'))
                            <p role="alert" class='text-danger'><strong>{{ $errors->first('first_name') }}</strong></p>
                        @endif
                        <input type="text" id="first_name" value="{{ old('first_name') }}"  class="form-control" placeholder="First Name" name="first_name" required >
                    </div>
                    <div class="form-group">
                        <label for="last_name">Last Name <span class="text-danger">*</span></label>
                        @if ($errors->has('last_name'))
                            <p role="alert" class='text-danger'><strong>{{ $errors->first('last_name') }}</strong></p>
                        @endif
                        <input type="text" id="last_name" value="{{ old('last_name') }}"  class="form-control" placeholder="Last Name" name="last_name" required >
                    </div>
                    <div class="form-group">
                        <label for="function_of_the_person">Function of the person<span class="text-danger">*</span></label>
                        @if ($errors->has('function_of_the_person'))
                            <p role="alert" class='text-danger'><strong>{{ $errors->first('function_of_the_person') }}</strong></p>
                        @endif
                        <input type="text" id="function_of_the_person" value="{{ old('function_of_the_person') }}"  class="form-control" placeholder="Last Name" name="function_of_the_person" required >
                    </div>
                    <div class="form-group">
                        <label for="email_of_the_person">Email of the person<span class="text-danger">*</span></label>
                        @if ($errors->has('email_of_the_person'))
                            <p role="alert" class='text-danger'><strong>{{ $errors->first('email_of_the_person') }}</strong></p>
                        @endif
                        <input type="text" id="email_of_the_person" value="{{ old('email_of_the_person') }}"  class="form-control" placeholder="Last Name" name="email_of_the_person" required >
                    </div>
                    <div class="form-group">
                        <label for="schools">Schools </label>
                        @if ($errors->has('schools.*') > 0)
                            @foreach ($errors->get('schools.*') as $error)
                                <p role="alert" class='text-danger'><strong>{{ $error[0] }}</strong></p>
                            @endforeach
                        @endif
                        <select name="schools[]" id="schools" class='form-control multiple w-100' multiple="multiple">
                            <option value="" disabled="" >Schools</option>
                            @foreach(App\School::all() as $school)
                                <option value="{{$school->id}}">{{$school->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="btn btn-outline-primary mt-4">Create</button>
                </form>
            </div>

        </div>
    </div>
@endsection