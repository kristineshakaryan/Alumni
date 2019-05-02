@foreach($users as $user)
    <div class="col-sm-3 jbpgs-post-start-col" style="display: none">
        <div class="jbpgs-post-start-col-wrp bg-white box-shadow">
            <div class="jbpgspost-col-img">
                <img src="{{ asset("images/avatar/$user->avatar") }}" class="img-responsive img-circle" alt="">
            </div>
            <div class="jbpgs-post-start-content p-4">
                <small class="badge badge-warning ">MENTOR</small>
                <h4 class="jbpgs-post-start-title text-center">{{$user->first_name}} {{$user->last_name}}</h4>
                <div class="jbpgs-post-start-col-row text-center">
                  <span class="">
                    <p  class="d-inline-block mb-0">
                        @if($user->chooseColor)
                            @if($user->chooseColor->category)
                                {{$user->chooseColor->category->title}}
                            @endif
                        @endif
                    </p>
                    <br />
                    <p class="d-inline-block mb-0">{{$user->graduation_year}}</p>
                    <br />
                    {{--<p class="d-inline-block mb-0">Paris</p>--}}
                  </span>
                </div>
                <div class="badge1 badg1e-action text-center ml-0 pl-0 mt-2">
                    <ul>
                        <li><a href="{{ route('user.user.profile',['id' => $user->id]) }}" title="" class="followw" tabindex="-1">Profile</a></li>
                        <li> <a href="#" title="" class="envlp" tabindex="-1"><img src="{{ asset('images/custom/envelop.png') }}" alt=""></a> </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endforeach