@extends('admin_inc.template')
@section('content')
<main>
    <div class="profilepg-content">
        <section class="profilepg-sec">
            <div class="container-fluid">
                <div class="propg-sec-wrp box-shadow bg-white">
                    <div class="propg-proimg">
                        @if(!is_null($user->avatar))
                            <img class="profile_img" src="{{ asset('/images/avatar/'.$user->avatar) }}" >
                        @else
                            <img class="profile_img" src="{{ asset('/images/avatar/default.jpg') }}" >
                        @endif
                    </div>
                    <div class="propg-content">
                        <div >
                            <div >
                                <div class="propg-content-left">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="propg-content-left-tp">
                                                <div class="propg-usename-row">
                                                    <h3 class="d-inline-block propg-usename mb-3">
                                                        {{ $user->first_name }} {{ $user->last_name }}
                                                    </h3>
                                                    @if($user->mentorat == \App\User::mentorat)
                                                        <small class="badge badge-warning ">MENTOR</small>
                                                    @endif
                                                    <span class="propg-location ml-3"><i class="fa fa-map-marker" aria-hidden="true"></i> {{$user->city}}</span>
                                                    <br/>
                                                        {{ $user->email }}
                                                    <br/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="propgcl-mr">
                                        <div class="row">
                                            <div class="col-lg-10 col-md-10">
                                                <div class="propgcl-mr-row propgcl-mr-left-work-wrp">
                                                    <h5 class="my-4 font-weight-light"><i class="fa fa-info" aria-hidden="true"></i>  Information
                                                        <a href="{{ route('admin.user.edit-profile',['id' => $user->id]) }}" class="float-right"><i class="fa fa-edit"></i></a>
                                                    </h5>
                                                    <div class="propgcl-mr-row-inner-row d-flex mb-3">
                                                        <div class="propgcl-mr-left my propgcl-mr-left-work"></div>
                                                        <div class="propgcl-mr-right">
                                                            <h6>Job offer posted</h6>
                                                            <p class=" mt-0">
                                                                @foreach($user->myJob as $job)
                                                                    <span class="border p-1">{{$job->title}}</span>
                                                                @endforeach
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="propgcl-mr-row-inner-row d-flex mb-3">
                                                        <div class="propgcl-mr-left my propgcl-mr-left-work"></div>
                                                        <div class="propgcl-mr-right">
                                                            <h6> Blog post posted </h6>
                                                            <p class=" mt-0">
                                                                @foreach($user->myBlog  as $blog)
                                                                    <span class="border p-1">{{$blog->title}}</span>
                                                                @endforeach
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</main>
@endsection