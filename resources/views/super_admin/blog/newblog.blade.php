@extends('super_admin_inc.template')
@section('content')
    <div class="container mt-5 mb-5">
        <form action="{{ route('super_admin.NewBlog') }}" enctype="multipart/form-data" method="post">
            @csrf
            <div class="form-group">
                <label for="title">Title <span class="text-danger">*</span></label>
                @if ($errors->has('title'))
                    <p role="alert" class='text-danger'><strong>{{ $errors->first('title') }}</strong></p>
                @endif
                <input type="text" id="title" value="{{ old('title') }}"  class="form-control" placeholder="Enter Title Of The Blog" name="title" required >
            </div>
            <div class="form-group">
                @if ($errors->has('editor'))
                    <p role="alert" class='text-danger'><strong>{{ $errors->first('editor') }}</strong></p>
                @endif
                <textarea class="editor" name="content"></textarea>
            </div>
            <div class="form-group">
                <label for="image_for_blog">Logo  <span class="text-danger">*</span></label>
                @if ($errors->has('image_for_blog'))
                    <p role="alert" class='text-danger'><strong>{{ $errors->first('image_for_blog') }}</strong></p>
                @endif
                <div class="custom-file">
                    <input type="file" class="custom-file-input" required="" id="image_for_blog" name="image_for_blog">
                    <label class="custom-file-label" for="image_for_blog">Choose file</label>
                </div>
            </div>
            <div class="form-group">
                <label for="date_of_creation">Date Of Creation <span class="text-danger">*</span></label>
                @if ($errors->has('date_of_creation'))
                    <p role="alert" class='text-danger'><strong>{{ $errors->first('date_of_creation') }}</strong></p>
                @endif
                <input type='date' value="{{ old('date_of_creation') }}" name="date_of_creation" id="date_of_creation" class='form-control' required="">
            </div>
            <div class="form-group">
                <label class="switch switch-label switch-pill switch-success switch-sm">
                    <input name="active" class="switch-input user_status" type="checkbox">
                    Active
                    <span class="switch-slider" data-checked="On" data-unchecked="Off"></span>
                </label>
            </div>
            <div class="form-group">
                <label for="sender">Sender <span class="text-danger">*</span></label>
                @if ($errors->has('sender'))
                    <p role="alert" class='text-danger'><strong>{{ $errors->first('sender') }}</strong></p>
                @endif
                <input type="email" id="sender" value="{{ old('sender') }}"  class="form-control" placeholder="Sender" name="sender" required >
            </div>
            <div class="form-group text-right mt-5">
                <button class="btn btn-outline-danger">Create</button>
            </div>
        </form>
    </div>
@endsection