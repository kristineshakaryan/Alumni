@extends('super_admin_inc.template')
@section('content')
    <div class="container-fluid page-body-wrapper">
        <!-- partial -->
        <div class="main-panel p-3">
            <table class="datatable table table-hover nowrap w-100" >
                <thead>
                <tr>
                    <th>Title</th>
                    <th>Image</th>
                    <th>Date Of Creation</th>
                    <th>Status</th>
                    <th>Sender</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($blogs as $blog)
                    <tr>
                        <td>{{$blog->title}}</td>
                        <td><img class="img_for_table" src="{{asset("images/Blogs/" . $blog->image)}}"></td>

                        <td>{{$blog->date_of_creation}}</td>
                        <td>{{($blog->status)? 'Active' : 'Inactive'}}</td>
                        <td>{{$blog->sender}}</td>

                        <td>
                            <button access="{{ Crypt::encrypt($blog->id) }}" data="BlogPost" class="btn btn-outline-danger SADelete" >Delete</button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <th>Title</th>
                    <th>Image</th>
                    <th>Date Of Creation</th>
                    <th>Status</th>
                    <th>Sender</th>
                    <th></th>
                </tr>
                </tfoot>
            </table>

            <!-- Modal -->
            <div class="modal fade" id="editJobBoard" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Edit Group</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="{{ route('super_admin.UpdateJobBoard') }}" method="post" enctype="multipart/form-data">
                            <div class="modal-body">
                                @csrf
                                <input type='hidden' name="id" id="id_for_jobboard" value="{{old('id')}}">
                                <div class="form-group">
                                    <label for="title">Title <span class="text-danger">*</span></label>
                                    @if ($errors->has('title'))
                                        <p role="alert" class='text-danger'><strong>{{ $errors->first('title') }}</strong></p>
                                    @endif
                                    <input type='text' value="{{ old('title') }}" name="title" id="title" class="form-control" required="">
                                </div>

                                <div class="form-group">
                                    <label for="link">Link <span class="text-danger">*</span></label>
                                    @if ($errors->has('link'))
                                        <p role="alert" class='text-danger'><strong>{{ $errors->first('link') }}</strong></p>
                                    @endif
                                    <input type='text' value="{{ old('link') }}" name="link" id="link" class="form-control" required="">
                                </div>
                                <div class="form-group">
                                    <label class="switch switch-label switch-pill switch-success switch-sm">
                                        <input name="status" class="switch-input job_status" type="checkbox">
                                        Active
                                        <span class="switch-slider" data-checked="On" data-unchecked="Off"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button  class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button  class="btn btn-primary btn_for_trigger_form_edit">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if($errors->has('jobs'))
        <script>
            setTimeout(function(){
                $('#editJobBoard').modal()
                @if(old('status') == 'on')
                $('.job_status').attr('checked',true);
                @endif
            },1000)

        </script>
    @endif

@endsection