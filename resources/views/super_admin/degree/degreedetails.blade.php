@extends('super_admin_inc.template')
@section('content')
    <div class="container-fluid page-body-wrapper">
        <!-- partial -->
        <div class="main-panel p-4">
            <div class="col-md-12 text-center">
                <h4 class="text-info">{{$degree->name}}</h4>
            </div>
            <form  action="{{ route('super_admin.UpdateDegree') }}" class="mt-5 mb-5" method="post"  enctype="multipart/form-data">
                @csrf
                <input type='hidden' name="id" id="id_for_school" value="{{ Crypt::encrypt($degree->id) }}">
                <div class="row">
                    <div class="col-md-4 offset-4">
                        <div class="col-md-10 offset-1">
                            <div class="form-group">
                                <label for="name">Name <span class="text-danger">*</span> </label>
                                @if ($errors->has('name'))
                                    <p role="alert" class='text-danger'><strong>{{ $errors->first('name') }}</strong></p>
                                @endif
                                <input type='text' value="{{$degree->name}}" name="name"  required="" id="name" class="form-control">
                            </div>
                            <button class="btn btn-success float-right">Edit</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection