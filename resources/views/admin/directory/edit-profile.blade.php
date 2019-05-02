@extends('admin_inc.template')
@section('content')
<main>
    <div class="postjob-pg py-5">
        <div class="container-fluid py-5">
            <div class="postjob-pg-wrp">
                <div class="postjobpg-box p-5 bg-white box-shadow m-auto">
                    <h3><i class="fa fa-pencil-square-o mr-3 tcolor" aria-hidden="true"></i> Edit Profile</h3>
                    <div class="postjobpg-fields-wrp">
                        <form action="{{ route('admin.user.update-profile') }}" method="post" class="form" enctype="multipart/form-data">
                            @csrf
                            <div class="d-flex">
                                <h6 class="postjobpg-lside-postjobpg">Profile Information</h6>
                                <div class="postjobpg-fields-summry">
                                    <div class="postjobpg-fields-summry-wrp">
                                        <div class="postjobpg-fields-summry-row row">
                                            <div class="col-md-6">
                                                <label>First Name <span class="text-danger">*</span></label>
                                                @if ($errors->has('first_name'))
                                                    <p role="alert" class='text-danger'><strong>{{ $errors->first('first_name') }}</strong></p>
                                                @endif
                                                <div class="postjobpg-fields-grp">
                                                    <input class="form-control" type="text"  value="{{ is_null(old('first_name'))?$user->first_name:old('first_name') }}" placeholder="Enter First Name"  name="first_name" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <label>Last Name <span class="text-danger">*</span></label>
                                                @if ($errors->has('last_name'))
                                                    <p role="alert" class='text-danger'><strong>{{ $errors->first('last_name') }}</strong></p>
                                                @endif
                                                <div class="postjobpg-fields-grp">
                                                    <input class="form-control" type="text"  value="{{ is_null(old('last_name'))?$user->last_name:old('last_name') }}" placeholder="Enter Last Name" name="last_name" required >
                                                </div>
                                            </div>
                                        </div>
                                        <input type="hidden" name="id" value="{{ Crypt::encrypt($user->id) }}">
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
                                            <div class="col-md-6">
                                                <label class="switch switch-label switch-pill switch-success switch-sm">
                                                    Active
                                                    <input name="active" class="switch-input user_status" type="checkbox">
                                                    <span class="switch-slider mt-3" data-checked="On" data-unchecked="Off"></span>
                                                </label>
                                            </div>
                                        </div>
                                        @if($user->status == \App\User::status_active || !is_null(old('active')))
                                            <script>
                                                $('.user_status').attr('checked',true);
                                            </script>
                                        @endif
                                        <div class="postjobpg-fields-summry-row row">
                                            <div class="col-md-12">
                                                <label >Email</label>
                                                <div class="postjobpg-fields-grp">
                                                    <input class="form-control" type="emial"  value="{{ $user->email }}"  disabled >
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
                                                    <input class="form-control" type="text"  value="{{ is_null(old('city'))?$user->city:old('city') }}" placeholder="Enter Your City" name="city" id="city" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="postjobpg-fields-btn mt-4">
                                            <button class="btn btn-theme w-100">Update</button>
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