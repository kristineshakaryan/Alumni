<?php
$user = \App\User::find(Session::get('userData')->id);
?>
<div class="page-wrpper">
<header class="header inner-pages-header">
  <div class="container-fluid">
    <div class="profile-section">
      <div class="">
        <div class="logo text-center">
          <a href="{{ route('user.dashboard') }}">
            <img src="{{ asset('images/custom/logo.png') }}" />
          </a>
        </div>
        <div class="m-auto">
          <ul class="profile-menu" id="myTab">
            <li> <a href="{{ route('user.dashboard') }}">Accueil</a> </li>
            <li> <a href="#">Actualités</a> </li>
            <li> <a href="{{ route('user.directory') }}" class="{{ Route::current()->getName()=="user.directory"?'active':'' }}" >Annuaire</a> </li>
            <li> <a href="{{ route('user.mentorship') }}"  class="{{ Route::current()->getName()=="user.mentorship"?'active':'' }}" >Mentorat</a> </li>
            <li> <a href="{{ route('user.job-offer') }}"  class="{{ Route::current()->getName()=="user.job-offer"?'active':'' }}" >Emplois / stages</a> </li>
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
      </div>
    </div>
  </div>
</header>
  <div class="directory-pg-banner jbpgs-banner inner-banner mentorship_banner">
    <div class="container-fluid"></div>
  </div>