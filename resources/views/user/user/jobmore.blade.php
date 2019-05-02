@foreach($jobs as $job)
    <div class="todo todo-default" style="display: none">
        <div class="sm-avater list-avater">
            {{--                        <img src="{{ asset('images/custom/com-1.jpg') }}" class="img-responsive img-circle" alt="">--}}
            <span class="com-status bage-warning"></span>
        </div>
        <h5 class="ct-title">{{$job->title}}
            {{--                        <span class="ct-designation">UI/UX Designer</span>--}}
        </h5>
        <div class="badge badge-action">
            <a href="#" class="btn btn-default btn-default btn-round btn-outline">consulter</a>
        </div>
    </div>
@endforeach