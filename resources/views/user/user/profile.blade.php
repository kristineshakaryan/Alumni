@extends('user_inc.template')
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
                            <div class="">
                                <div class="">
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
                                                        <span class="propg-location ml-3"><i class="fa fa-map-marker" aria-hidden="true"></i>&nbsp;&nbsp;{{$user->city}}</span>
                                                        <br/>
                                                        {{--Chef de projet" @ Datalumni<br/>--}}
                                                        {{ $user->graduation_year }}<br/>
{{--                                                        MBA Management - Gestion - EDHEC Business School<br/>--}}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="propg-content-left-tp mt-0">
                                                    <div class="propgclo-connnet d-flex align-items-center">
                                                        <div class="propgclo-connnet-s-messages"><a href="#"><i class="fa fa-commenting-o" aria-hidden="true"></i><span class="ml-3">Send Messages</span></a></div>
                                                        <div class="propgclo-connnet-contact mx-3 p-2">
                                                            <a href="#">
                                                                <div class="propgclo-connnet-contact-wrp">
                                                                    <i class="fa fa-check" aria-hidden="true"></i>
                                                                    <span class="ml-2">Solliciter comme mentor</span>
                                                                </div>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="propgcl-mr">
                                            <div class="row">
                                                <div class="col-lg-10 col-md-10">
                                                    <div class="propgcl-mr-row propgcl-mr-left-work-wrp">
                                                        <h5 class="my-4 font-weight-light"><i class="fa fa-info" aria-hidden="true"></i>  Information
                                                            <a href="{{ route('user.edit-profile') }}" class="float-right"><i class="fa fa-edit"></i></a>
                                                        </h5>
                                                        <h5 class="my-4 font-weight-light"><i class="fa fa-briefcase" aria-hidden="true"></i>  Expériences
                                                            <a href="#" class="float-right"><i class="fa fa-edit"></i></a>
                                                        </h5>
                                                        <div class="propgcl-mr-row-inner-row d-flex mb-3">
                                                            <div class="propgcl-mr-left my propgcl-mr-left-work"></div>
                                                            <div class="propgcl-mr-right">
                                                                <h6>CEO et Fondatrice</h6>
                                                                <p class=" mt-0">Datalumni</p>
                                                                <p class="mb-2">Oct 2018 – Present</p>
                                                                <p>Datalumni est une solution qui vise à accompagner les établissements à capitaliser sur la richesse de leur réseau d'anciens tout en les aidant dans l'automatisation de leurs rapports statistiques.
                                                                    A Datalumni, on pense sincèrement que l'orientation et l'insertion est une problématique qu'on ne peut plus décemment "remettre à plus tard". Celle-ci doit devenir la priorité numéro 1 des établissements. C'est la raison pour laquelle nous avons décidé de développer une solution permettant de recréer du lien entre les promotions et de faciliter la cooptation.
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <div class="propgcl-mr-row-inner-row d-flex mb-3">
                                                            <div class="propgcl-mr-left my propgcl-mr-left-work"></div>
                                                            <div class="propgcl-mr-right">
                                                                <h6>Consultante formatrice</h6>
                                                                <p class=" mt-0">Shaker Experience</p>
                                                                <p class="mb-2">Oct 2018 – Present</p>
                                                                <p>Shaker est une agence de conseil spécialisée dans la transformation des organisations. </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-10 col-md-6 mt-4">
                                                    <div class="propgcl-mr-row propgcl-mr-qualification">
                                                        <h5 class="mb-4 font-weight-light"> <i class="fa fa-graduation-cap" aria-hidden="true"></i> Formation
                                                            <a href="#" class="float-right"><i class="fa fa-edit"></i></a>
                                                        </h5>
                                                        <div class="propgcl-mr-row-inner-row mb-3 align-top">
                                                            <div class="propgcl-mr-left d-inline-block mr-2"><i class="fa fa-book" aria-hidden="true"></i></div>
                                                            <div class="d-inline-block align-top"  style="width: 90%">
                                                                <h6>Université Panthéon Assas (Paris II)</h6>
                                                                <p class="mb-0">Master of Business Administration - MBA / Master 2 Field Of StudyDroit des affaires et gestion d’entreprise</p>
                                                                <p class="mb-2">2013 – 2014</p>
                                                                <p>Double diplôme avec une composante business (management, RH, marketing, stratégie, entrepreneuriat, fiscalité) et une autre juridique (droit des sociétés, concurrence, droit du travail, IP)</p>
                                                            </div>
                                                        </div>
                                                        <div class="propgcl-mr-row-inner-row mb-3">
                                                            <div class="propgcl-mr-left mr-2 align-top d-inline-block"><i class="fa fa-book" aria-hidden="true"></i></div>
                                                            <div class="d-inline-block align-top"  style="width: 90%">
                                                                <h6>Université Jean Moulin Lyon 3</h6>
                                                                <p class="mb-0">Master 1 droit des affaires mention droit de l'entreprise Field Of Studydroit du travail, propriété intellectuelle, corporate, droit international, fiscalité Grade15,9/20</p>
                                                                <p class="bt-2">2012 – 2013</p>
                                                                <div class="propgcl-mr-right">Année réalisée en échange universitaire auprès de la Delhi University (Inde)</div>
                                                            </div>
                                                        </div>
                                                        <div class="propgcl-mr-row-inner-row mb-3 ">
                                                            <div class="propgcl-mr-left mr-2 align-top d-inline-block"><i class="fa fa-book" aria-hidden="true"></i></div>
                                                            <div class="align-top d-inline-block" style="width: 90%">
                                                                <h6>Université Jean Moulin (Lyon III)</h6>
                                                                <p class="mb-0">Bachelor's degree Field Of Studydroit, sociologie, science politique, fiscalité Grademention AB</p>
                                                                <p class="mb-2">2009 – 2012</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-10 mt-4 col-md-10">
                                                    <div class="propgcl-mr-row propgcl-mr-left-work-wrp">
                                                        <h5 class="my-4 font-weight-light"><i class="fa fa-music" aria-hidden="true"></i> Centres d'intérêt
                                                            <a href="#" class="float-right"><i class="fa fa-edit"></i></a>
                                                        </h5>
                                                        <div class="propgcl-mr-row-inner-row d-flex mb-2">
                                                            Gestion de projet
                                                        </div>
                                                        <div class="propgcl-mr-row-inner-row d-flex mb-2">
                                                            Human Resources
                                                        </div>
                                                        <div class="propgcl-mr-row-inner-row d-flex mb-2">
                                                            Journalism
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