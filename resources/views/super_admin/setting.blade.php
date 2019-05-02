@extends('super_admin_inc.template')
@section('content')
    <div class="container-fluid page-body-wrapper">
        <!-- partial -->
        <div class="main-panel p-4">
            <div class="super_admin_content">
                <form action="{{ route('changePassword') }}" method="post" >
                    @csrf
                    <div class="container float-left">
                        <h4 class="text-info">Change Password </h4>
                        @if(session()->has('success_group'))
                            <div class="text-danger">
                                {{ session()->get('success_group') }}
                            </div>
                        @endif
                        <div class="form-group">
                            <label for="">Old Password <span class="text-danger">*</span></label>
                            @if ($errors->has('old_password'))
                                <p role="alert" class='text-danger'>
                                    <strong>{{ $errors->first('old_password') }}</strong>
                                </p>
                            @endif
                            <input type="password" required="" class="form-control mt-2" name="old_password">
                        </div>
                        <div class="form-group">
                            <label for="">New Password <span class="text-danger">*</span></label>
                            @if ($errors->has('password'))
                                <p role="alert" class='text-danger'>
                                    <strong>{{ $errors->first('password') }}</strong>
                                </p>
                            @endif
                            <input type="password" required="" class="form-control mt-2" name="password">
                        </div>
                        <div class="form-group">
                            <label for="">Confirm Password <span class="text-danger">*</span></label>
                            <input type="password" required="" class="form-control mt-2" name="password_confirmation">
                        </div>
                        <button type="submit" class="btn btn-outline-primary mt-4">Change</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

