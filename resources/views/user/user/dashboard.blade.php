<?php
$user = \App\User::find(Session::get('userData')->id);
?>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
<meta name="token" content="{{ csrf_token() }}"/>
<meta name="url" content="{{ URL('/') }}"/>
<title>Datalumni</title>
<!-- jQuery library -->
@jquery
<!-- toastr library -->
@toastr_css
<!-- Select2 -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
<!-- Custom -->
<link href="{{ asset('css/custom/animate.css') }}" rel="stylesheet">
<link href="{{ asset('css/custom/bootstrap.min.css') }}" rel="stylesheet">
<link href="{{ asset('css/custom/custom-style.css') }}" rel="stylesheet">
<link href="{{ asset('css/custom/owl.carousel.min.css') }}" rel="stylesheet">
<link href="{{ asset('css/custom/owl.theme.default.min.css') }}" rel="stylesheet">

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-137180997-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-137180997-1');
</script>
<div class="page-wrpper">
  <div class="home-banner">
    <div class="owl-carousel owl-theme home-banner-slider">
      <div class="items">
        <img src="{{ asset('images/custom/top-header1.jpg') }}" />
        <div class="home-banner-content">
          <h2 class="wow fadeInUp" data-wow-duration="1s">Hey <span>{{ $user->first_name  }}</span> Nice to see you</h2>
          <p class="wow fadeInUp" data-wow-duration="2s">Let's discover what's new in your network today</p>
        </div>
      </div>
      <div class="items">
        <img src="{{ asset('images/custom/top-header1.jpg') }}" />
        <div class="home-banner-content">
          <h2 class="wow fadeInUp" data-wow-duration="3s">Hey <span>Alexander</span> Nice to see you</h2>
          <p class="wow fadeInUp" data-wow-duration="5s">Let's discover what's new in your network today</p>
        </div>
      </div>
      <div class="items">
        <img src="{{ asset('images/custom/top-header1.jpg') }}" />
        <div class="home-banner-content">
          <h2 class="wow fadeInUp" data-wow-duration="5s">Hey <span>John</span> Nice to see you</h2>
          <p class="wow fadeInUp" data-wow-duration="7s">Let's discover what's new in your network today</p>
        </div>
      </div>
    </div>
  </div>
  <header class="header home-header box-shadow">
    <div class="container-fluid">
      <div class="profile-section">
        <div class="row align-items-center">
          <div class="col col-lg-10 m-auto">
            <ul class="profile-menu" id="myTab">
              <li> <a href="{{ route('user.dashboard') }}" class="active">Accueil</a> </li>
              <li> <a href="#">Actualités</a> </li>
              <li> <a href="{{ route('user.directory') }}">Annuaire</a> </li>
              <li> <a href="{{ route('user.mentorship') }}">Mentorat</a> </li>
              <li> <a href="{{ route('user.job-offer') }}">Emplois / stages</a> </li>
              <li class="dropdown-li">
                <a href="{{ route('user.profile') }}">
                  @if(!is_null($user->avatar))
                    <img class="mr-3 d-inline-block header_img" src="{{ asset('/images/avatar/'.$user->avatar) }}" >
                  @else
                    <img class="mr-3 d-inline-block header_img" src="{{ asset('/images/avatar/default.jpg') }}" >
                  @endif
                </a>
                <div class="dropdown-content">
                  <ul class="dropdown-content-list">
                    <li><a href="{{ route('user.profile') }}">Profil</a></li>
                    <li><a href="#">Paramètres</a></li>
                    <li><a href="{{ route('logout.user') }}">Se déconnecter</a></li>
                  </ul>
                </div>
              </li>
            </ul>
          </div>
          <div class="home-logo logo"> <a href="{{ route('user.dashboard') }}"> <img src="{{ asset('images/custom/logo.png') }}" /> </a> </div>
        </div>
      </div>
    </div>
  </header>
  <main class="position-relative">
  <section class="section1 section">
    <div class="container-fluid">
      <div class="section1-wrp">
        <div class="section-title-wrp text-center">
          <h2 class="section-title">Ils ont récemment rejoint votre réseau </h2>
        </div>
      </div>
      <div class="section1-content">
        <div class="row">
          <div class="col-md-12 col-lg-6 pos-rel">
            <div class="section1-content-left">
              <div class="top-profiles">
                <div class="pf-hd">
                  <h3>Les derniers inscrits</h3>
                  <i class="la la-ellipsis-v"></i>
                </div>
                <div class="section1c-left-slider-wrp">
                  <div class="section1c-left-slider owl-carousel owl-theme">
                    @foreach($users as $user)
                      <div class="items">
                        <div class="sec1-cleftcol">
                          @if($user->mentorat == \App\User::mentorat)
                            <div class="text-right mentor-tag">
                              <small class="badge badge-warning text-left f-left mr-3">MENTOR</small>
                            </div>
                          @endif
                          @if(!is_null($user->avatar))
                            <img  class="image-circle-cus" src="{{ asset('/images/avatar/'.$user->avatar) }}" >
                          @else
                            <img  class="image-circle-cus"  src="{{ asset('/images/avatar/default.jpg') }}" >
                          @endif
                          <h3>{{$user->first_name}} {{$user->last_name}}</h3>
                          <span class="mb-0   ">
                            @if($user->chooseColor)
                              @if($user->chooseColor->category)
                                {{$user->chooseColor->category->title}}
                              @endif
                            @endif
                          </span>
                          <span class="text-center mb-0" style="font-size:12px;">{{$user->graduation_year}}</span>
                          <p class="text-center" style="font-size:12px;">{{$user->city}}</p>
                          <ul class="ul_followw">
                            <li><a href="{{ route('user.user.profile',['id' => $user->id]) }}" title="" class="followw" tabindex="-1">Profile</a></li>
                            <li> <a href="#" title="" class="envlp" tabindex="-1"><img src="{{ asset('images/custom/envelop.png') }}" alt=""></a> </li>
                          </ul>
                        </div>
                      </div>
                    @endforeach
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-12 col-lg-6">
            <div class="section1-content-right">
              <div class="card">
                <div class="card-header">
                  <h4>Les derniers matchs de mentor</h4>
                </div>
                <div class="card-body">
                  <div class="todo-list todo-list-hover todo-list-divided">
                    <div class="todo todo-default">
                      <div class="section1-content-right-wrp ">
                        <div class="row text-center justify-content-center1 mt-2">
                          <div class="col-sm-6 ">
                            <div class="matches-images">
                              <div class="d-flex justify-content-center">
                                @if(!empty($mentors[0]))
                                  <div class="matches-images-col pr-2">
                                    <div class="matches-image">
                                      @if(!is_null($mentors[0]->avatar))
                                        <img  src="{{ asset('/images/avatar/'.$mentors[0]->avatar) }}" >
                                      @else
                                        <img   src="{{ asset('/images/avatar/default.jpg') }}" >
                                      @endif
                                    </div>
                                    <div class="text-center mt-2 mb-2" style="margin-left:10px">{{ $mentors[0]->first_name }}</div>
                                  </div>
                                @endif
                                @if(!empty($mentors[1]))
                                  <div class="matches-images-col pr-2">
                                    <div class="matches-image">
                                      @if(!is_null($mentors[1]->avatar))
                                        <img  src="{{ asset('/images/avatar/'.$mentors[1]->avatar) }}" >
                                      @else
                                        <img   src="{{ asset('/images/avatar/default.jpg') }}" >
                                      @endif
                                    </div>
                                    <div class="text-center mt-2 mb-2" style="margin-left:10px">{{ $mentors[1]->first_name }}</div>
                                  </div>
                                @endif
                              </div>
                            </div>
                          </div>
                          <div class="col-sm-6">
                            <div class="matches-images">
                              <div class="d-flex justify-content-center">
                                @if(!empty($mentors[2]))
                                  <div class="matches-images-col pr-2">
                                    <div class="matches-image">
                                      @if(!is_null($mentors[2]->avatar))
                                        <img  src="{{ asset('/images/avatar/'.$mentors[2]->avatar) }}" >
                                      @else
                                        <img   src="{{ asset('/images/avatar/default.jpg') }}" >
                                      @endif
                                    </div>
                                    <div class="text-center mt-2 mb-2" style="margin-left:10px">{{ $mentors[2]->first_name }}</div>
                                  </div>
                                @endif
                                @if(!empty($mentors[3]))
                                  <div class="matches-images-col pr-2">
                                    <div class="matches-image">
                                      @if(!is_null($mentors[3]->avatar))
                                        <img  src="{{ asset('/images/avatar/'.$mentors[3]->avatar) }}" >
                                      @else
                                        <img   src="{{ asset('/images/avatar/default.jpg') }}" >
                                      @endif
                                    </div>
                                    <div class="text-center mt-2 mb-2" style="margin-left:10px">{{ $mentors[3]->first_name }}</div>
                                  </div>
                                @endif
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
      </div>
    </div>
  </section>
  <section class="section2 section bg-white pt-4 mt-5 pb-5">
    <div class="container-fluid">
      <div class="section2-wrp">
        <div class="section-title-wrp text-center">
          <h2 class="section-title">Les dernières actualités de mon réseau</h2>
        </div>
        <div class="section2-content section_class">
          <div class="row">
            <div class="col-md-6 pos-rel">
              @if(count($BlogPost) > 0)
                <div class="card">
                  <div class="card-header">
                    <h4>A la une</h4>
                  </div>
                  <div class="card-body">
                    <div class="todo-list todo-list-hover todo-list-divided">
                      @foreach($BlogPost as $blog_post)
                        <div class="todo todo-default">
                            <div class="sm-avater list-avater ">
                                <img src="{{ asset('images/Blogs/' . $blog_post->image) }}" class="img-responsive img-circle" alt="">
                                <span class="com-status bage-warning"></span>
                            </div>
                            <h5 class="ct-title"><span class="font-weight-bold mb-2">{{$blog_post->title}}</span><span class="ct-designation div_for_blogpost">{!! $blog_post->content !!}<a href="#">Lire plus</a></h5>
                        </div>
                      @endforeach
                    </div>
                  </div>
                  @if(count($BlogPost) > 3)
                    <div class="col-sm-12 sec3-content-btn-wrp mt-3 text-right mb-2">
                      <a href="#" class="btn btn-theme text-white">voir plus</a>
                    </div>
                  @endif
                </div>
              @endif
            </div>
            <div class="col-md-6 pos-rel">
              <div class="section2-content-right section_full">
                <div class="card">
                  <div class="card-header">
                    <h4>Dernières activités Linkedin</h4>
                  </div>
                  <div class="card-body">
                    <div class="todo-list todo-list-hover todo-list-divided">
                      <div class="todo todo-default flex-column">
                        <div class="mb-3">
                          <img src="{{ asset('images/custom/linkedin-news-img.png') }}" />
                        </div>
                        <div class="mb-3">
                          <img src="{{ asset('images/custom/linkedin-news-img2.png') }}" />
                        </div>
                        <div class="">
                          <img src="{{ asset('images/custom/linkedin-news-img3.png') }}" />
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-12 sec3-content-btn-wrp mt-3 text-right"> <a href="#" class="btn btn-theme text-white">voir plus</a> </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section class="section3 section">
    <div class="container-fluid">
      <div class="section3-wrp">
        <div class="section-title-wrp text-center">
          <h2 class="section-title">Ça bosse dur par ici !</h2>
        </div>
      </div>
      <div class="sec3-content">
        <div class="row">
          <div class="col-md-6 pos-rel">
            <div class="sec3-content-left section_full">
              <div class="card">
                <div class="card-header">
                  <h4>Statistiques</h4>
                </div>
                <div class="card-body">
                  <div class="todo-list todo-list-hover todo-list-divided">
                    <div class="todo todo-default">
                      <div class="row">
                        <div class="col-md-4">
                          <h4 style="font-size: 15px;" class="text-center mb-4">Temps de recherche du premier emploi</h4>
                          <img src="{{ asset('images/custom/grahp-img3.png') }}" />
                        </div>
                        <div class="col-md-4">
                          <h4 style="font-size: 15px;" class="text-center mb-4">Secteur d'activité</h4>
                          <img style="margin-top:18px;" src="{{ asset('images/custom/grahp-img2.png') }}" />
                        </div>
                        <div class="col-md-4">
                          <h4 style="font-size: 15px;" class="text-center mb-4">Pourcentage de comptes activés</h4>
                          <img src="{{ asset('images/custom/grahp-img1.png') }}" />
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-sm-12 sec3-content-btn-wrp mt-1 text-right">
                  <a href="#" class="btn btn-theme">voir plus</a>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-6 pos-rel">
            <div class="sec3-content-right-wrp section_full">
              <div class="card">
                <div class="card-header">
                  <h4>Dernière offres d'emploi</h4>
                </div>
                <div class="card-body">
                  <div class="todo-list todo-list-hover todo-list-divided more_content">
                    @foreach($jobs as $job)
                    <div class="todo todo-default">
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
                  </div>
                </div>
                @if($jobs->lastPage() > 1)
                  <div class="col-sm-12 sec3-content-btn-wrp mt-3 mb-2 text-right">
                    <a class="btn btn-theme VoirPlus" data_url="{{ urlencode($jobs->nextPageUrl()) }}"  count="{{ $jobs->lastPage() }}">Voir plus</a>
                  </div>
                @endif
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</main>
</div>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="{{ asset('js/custom/wow.min.js') }}"></script>
<script src="{{ asset('js/custom/owl.carousel.min.js') }}"></script>
<script src="{{ asset('js/custom/custom.js') }}"></script>

<!-- Select2 -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<!-- datatable -->
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.18/datatables.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/scroller/2.0.0/js/dataTables.scroller.min.js"></script>
<!-- toastr library -->
@toastr_js
@toastr_render