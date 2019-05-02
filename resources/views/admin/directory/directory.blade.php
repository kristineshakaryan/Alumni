@extends('admin_inc.template')
@section('content')
<main>
    <div class="directory-pg jbpgs">
        <div class="container-fluid">
            <div class="directory-pg-wrp jbpgs-wrp">
                <div class="jbpgs-searchbox">
                    <form action="{{ route('admin.directory') }}" method="get">
                        <div class="jbpgs-searchbox-wrp m-auto bg-white box-shadow">
                            <div class="row p-2 jbpgs-searchbox-row align-items-center">
                                <div class="col-md-2">
                                    <div class="jbpgs-searchbox-col">
                                        <input type="text" class="form-control pt-1 border-0" value="{{ $free_search }}"  name="free_search" placeholder="Free search">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="jbpgs-searchbox-col">
                                        <div class="form-control-select-wrp">
                                            <select class="form-control pt-0 border-0" name="degree">
                                                <option value="">Select Degree</option>
                                                @foreach(App\Degree::all() as $degree)
                                                    <option {{ $degrees == $degree->name?'selected':''  }}>{{ $degree->name }}</option>
                                                @endforeach
                                            </select>
                                            <i class="fa fa-angle-down" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="jbpgs-searchbox-col">
                                        <input type="number" class="form-control pt-1 border-0"  value="{{ $year_of_graduation }}" name="year_of_graduation" placeholder="year of graduation">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="jbpgs-searchbox-col">
                                        <div class="form-control-select-wrp">
                                            <select class="form-control pt-0 border-0" name="category">
                                                <option value="">Select Category</option>
                                                @foreach(App\Category::all() as $category)
                                                    <option {{ $categorys == $category->title?'selected':'' }}>{{ $category->title }}</option>
                                                @endforeach
                                            </select>
                                            <i class="fa fa-angle-down" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="jbpgs-searchbox-col">
                                        <div class="form-control-select-wrp">
                                            <select class="form-control pt-0 border-0" name="job">
                                                <option value="">Select job</option>
                                                @foreach(App\JobBoard::all() as $job)
                                                    <option {{ $jobs == $job->title?'selected':'' }}>{{ $job->title }}</option>
                                                @endforeach
                                            </select>
                                            <i class="fa fa-angle-down" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="jbpgs-searchbox-col ">
                                        <button class="btn btn-theme btn-block ">Search</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <section class="jbpgs-post-start m-auto pb-5">
                    <div>
                        <div class="d-flex mb-4 pb-3 align-items-center">
                            <div class="">
                                <a href="{{ route('admin.new-user') }}" class="btn btn-theme">Add new user</a>
                            </div>
                            <div class="ml-2">
                                <a href="{{ route('admin.user-csv') }}" class="btn btn-theme">CSV</a>
                            </div>
                        </div>
                    </div>
                    <div class="row jbpgs-post-start-row more_content">
                        @foreach($users as $user)
                        <div class="col-sm-3 jbpgs-post-start-col">
                            <div class="jbpgs-post-start-col-wrp bg-white box-shadow">
                                <div class="jbpgspost-col-img">
                                    <img src="{{ asset("images/avatar/$user->avatar") }}" class="img-responsive img-circle" alt="">
                                </div>
                                <div class="jbpgs-post-start-content p-4">
                                    @if($user->mentorat == \App\User::mentorat)
                                        <small class="badge badge-warning ">MENTOR</small>
                                    @endif
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
                                        <p class="d-inline-block mb-0">{{$user->city}}</p>
                                      </span>
                                    </div>
                                    <div class="badge1 badg1e-action text-center ml-0 pl-0 mt-2">
                                        <ul>
                                            <li><a href="{{ route('admin.user.profile',['id' => $user->id]) }}" title="" class="followw" tabindex="-1">Profile</a></li>
                                            <li> <a href="#" title="" class="envlp" tabindex="-1"><img src="{{ asset('images/custom/envelop.png') }}" alt=""></a> </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @if($users->lastPage() > 1)
                        <?php $url = (request()->fullUrl() == url()->current())?'?':'&'; ?>
                        <div class="jobofferpg-post-btn text-center">
                            <a class="btn btn-theme VoirPlus" data_url="{{ urlencode(request()->fullUrl().''.$url.'page='.(int)($users->currentPage()+1)) }}"  count="{{ $users->lastPage() }}">Voir plus</a>
                        </div>
                    @endif
                </section>
            </div>
        </div>
    </div>
</main>
@endsection
