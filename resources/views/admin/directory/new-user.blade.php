@extends('admin_inc.template')
@section('content')
<main>
    <div class="postjob-pg py-5">
        <div class="container-fluid py-5">
            <div class="postjob-pg-wrp">
                <div class="postjobpg-box p-5 bg-white box-shadow m-auto">
                    <h3><i class="fa fa-pencil-square-o mr-3 tcolor" aria-hidden="true"></i> Create User</h3>
                    <div class="postjobpg-fields-wrp">
                        <form action="{{ route('admin.new-user') }}" method="post" class="form" enctype="multipart/form-data">
                            @csrf
                            <div class="d-flex">
                                <h6 class="postjobpg-lside-postjobpg">User Information</h6>
                                <div class="postjobpg-fields-summry">
                                    <div class="postjobpg-fields-summry-wrp">
                                        <div class="postjobpg-fields-summry-row row">
                                            <div class="col-md-6">
                                                <label>First Name <span class="text-danger">*</span></label>
                                                @if ($errors->has('first_name'))
                                                    <p role="alert" class='text-danger'><strong>{{ $errors->first('first_name') }}</strong></p>
                                                @endif
                                                <div class="postjobpg-fields-grp">
                                                    <input class="form-control" type="text"  value="{{ old('first_name') }}" placeholder="Enter First Name"  name="first_name" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <label>Last Name <span class="text-danger">*</span></label>
                                                @if ($errors->has('last_name'))
                                                    <p role="alert" class='text-danger'><strong>{{ $errors->first('last_name') }}</strong></p>
                                                @endif
                                                <div class="postjobpg-fields-grp">
                                                    <input class="form-control" type="text"  value="{{ old('last_name') }}" placeholder="Enter Last Name" name="last_name" required >
                                                </div>
                                            </div>
                                        </div>
                                        <div class="postjobpg-fields-summry-row row">
                                            <div class="col-md-12">
                                                <label >Email<span class="text-danger">*</span></label>
                                                @if ($errors->has('email'))
                                                    <p role="alert" class='text-danger'><strong>{{ $errors->first('email') }}</strong></p>
                                                @endif
                                                <div class="postjobpg-fields-grp">
                                                    <input class="form-control" type="emial"  value="{{ old('email') }}" placeholder="Enter Your Email" name="email" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="postjobpg-fields-summry-row row">
                                            <div class="col-md-12">
                                                <label>Picture </label>
                                                @if ($errors->has('picture'))
                                                    <p role="alert" class='text-danger'><strong>{{ $errors->first('picture') }}</strong></p>
                                                @endif
                                                <div class="postjobpg-fields-grp">
                                                    <input  type="file" class="form-control" placeholder="Enter Picture"  name="picture" >
                                                </div>
                                            </div>
                                        </div>
                                        <div class="postjobpg-fields-summry-row row">
                                            <div class="col-md-12">
                                                <label >City<span class="text-danger">*</span></label>
                                            @if ($errors->has('city'))
                                                    <p role="alert" class='text-danger'><strong>{{ $errors->first('city') }}</strong></p>
                                                @endif
                                                <div class="postjobpg-fields-grp">
                                                    <input class="form-control" type="text"  value="{{ old('city') }}" placeholder="Enter Your City" name="city" id="city" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="postjobpg-fields-summry-row row">
                                            <div class="col-md-12">
                                                <label>Select Category <span class="text-danger">*</span></label>
                                                @if ($errors->has('category'))
                                                    <p role="alert" class='text-danger'><strong>{{ $errors->first('category') }}</strong></p>
                                                @endif
                                                <div class="form-control-select-wrp">
                                                    <select id="category" name="category"  class="form-control" required="">
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
                                                    <i class="fa fa-angle-down" aria-hidden="true"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="postjobpg-fields-btn mt-4">
                                            <button class="btn btn-theme w-100">Create</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
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