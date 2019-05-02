@extends('super_admin_inc.template')
@section('content')
    <div class="container-fluid page-body-wrapper">
        <!-- partial -->
        <div class="main-panel p-4">
            <div class="super_admin_content">
                <form action="{{ route('super_admin.NewUser') }}" method="post" class="form" enctype="multipart/form-data">
                    @csrf
                    <h4 class="text-info">User Information</h4>
                    @if(session()->has('success_user'))
                        <div class="text-danger">
                            {{ session()->get('success_user') }}
                        </div>
                    @endif
                    <div class="form-group">
                        <label for="first_name">First Name <span class="text-danger">*</span></label>
                        @if ($errors->has('first_name'))
                            <p role="alert" class='text-danger'><strong>{{ $errors->first('first_name') }}</strong></p>
                        @endif
                        <input type="text" id="first_name" value="{{ old('first_name') }}"  class="form-control" placeholder="Enter First Name" name="first_name" required >
                    </div>
                    <div class="form-group">
                        <label for="last_name">Last Name <span class="text-danger">*</span></label>
                        @if ($errors->has('last_name'))
                            <p role="alert" class='text-danger'><strong>{{ $errors->first('last_name') }}</strong></p>
                        @endif
                        <input type="text" id="last_name" value="{{ old('last_name') }}"  class="form-control" placeholder="Enter Last Name" name="last_name" required >
                    </div>
                    <div class="form-group">
                        <label for="email">Email <span class="text-danger">*</span></label>
                        @if ($errors->has('email'))
                            <p role="alert" class='text-danger'><strong>{{ $errors->first('email') }}</strong></p>
                        @endif
                        <input type="text" id="email" value="{{ old('email') }}"  class="form-control" placeholder="Enter Email" name="email" required >
                    </div>
                    <div class="form-group">
                        <label for="category">Category <span class="text-danger">*</span></label>
                        @if ($errors->has('category'))
                            <p role="alert" class='text-danger'><strong>{{ $errors->first('category') }}</strong></p>
                        @endif
                        <select id="category" name="category"  class="form-control" required="">
                            <option value="" disabled {{ old('category')?'':'selected' }}>Select Category</option>
                            @if (old('category'))
                                @foreach(App\Category::all() as $category)
                                    <option value="{{ $category->id }}"  <?php if($category->id == old('category')) {echo 'selected';} ?>>{{$category->title}}</option>
                                @endforeach
                            @else
                                @foreach(App\Category::all() as $category)
                                    <option value="{{ $category->id }}">{{$category->title}}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="city">City</label>
                        @if ($errors->has('city'))
                            <p role="alert" class='text-danger'><strong>{{ $errors->first('city') }}</strong></p>
                        @endif
                        <input type="text" id="city" value="{{ old('city') }}"  class="form-control" placeholder="Enter City" name="city" >
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
                                <option value="{{$school->id}}">{{$school->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group div_for_degree_of_the_school class_for_display_none">
                        <label for="degree">Degree</label>
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
                                <option value="{{$graduation_year->id}}">{{$graduation_year->year}}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-outline-primary mt-4">Create</button>
                </form>
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