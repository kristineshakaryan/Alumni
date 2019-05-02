@extends('admin_inc.template')
@section('content')
    <main>
        <div class="directory-pg jbpgs">
            <div class="container-fluid">
                <div class="directory-pg-wrp jbpgs-wrp">
                    <div class="jbpgs-searchbox">
                        <div class="jbpgs-searchbox-wrp m-auto bg-white box-shadow">
                            <div class="row p-2 jbpgs-searchbox-row align-items-center">
                                <div class="col-md-3">
                                    <div class="jbpgs-searchbox-col">
                                        <input type="text" class="form-control pt-1 border-0" id="" placeholder="Mots clés">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="jbpgs-searchbox-col">
                                        <div class="form-control-select-wrp">
                                            <select class="form-control pt-0 border-0">
                                                <option>Poste</option>
                                                <option>Banking</option>
                                                <option>Estate</option>
                                                <option>Retail</option>
                                                <option>Agency</option>
                                            </select>
                                            <i class="fa fa-angle-down" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="jbpgs-searchbox-col">
                                        <div class="form-control-select-wrp">
                                            <select class="form-control pt-0 border-0">
                                                <option>Type de contrat</option>
                                                <option>Banking</option>
                                                <option>Estate</option>
                                                <option>Retail</option>
                                                <option>Agency</option>
                                            </select>
                                            <i class="fa fa-angle-down" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="jbpgs-searchbox-col">
                                        <div class="form-control-select-wrp">
                                            <select class="form-control pt-0 border-0">
                                                <option>Lieux</option>
                                                <option>New York</option>
                                                <option>Washington</option>
                                                <option>Springfield</option>
                                                <option>Franklin</option>
                                            </select>
                                            <i class="fa fa-angle-down" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="jbpgs-searchbox-col ">
                                        <input type="submit" class="btn btn-theme btn-block " name="" value="chercher">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <section class="jbpgs-post-start m-auto pb-5">
                        <div>
                            <div class="d-flex mb-4 pb-3 align-items-center">
                                <div class="ml-2">
                                    <a href="{{ route('admin.mentor-csv') }}" class="btn btn-theme">CSV</a>
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
                                            <small class="badge badge-warning ">MENTOR</small>
                                            <h4 class="jbpgs-post-start-title text-center">{{$user->first_name}} {{$user->last_name}}</h4>
                                            <div class="jbpgs-post-start-col-row text-center">
                                       <span class="">
                                          <p  class="d-inline-block mb-0 text-center">
                                              @if($user->chooseColor)
                                                  @if($user->chooseColor->category)
                                                      {{$user->chooseColor->category->title}}
                                                  @endif
                                              @endif
                                          </p>
                                          <br />
                                          <p class="d-inline-block mb-0 text-center">{{$user->graduation_year}}</p>
                                          <br />
                                          <p class="d-inline-block mb-0 text-center"><p class="mb-1">{{$user->city}}</p></p>
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
        <section class="mentorship_last-sec py-5 bg-white">
            <div class="container-fluid">
                <div class="section-title-wrp text-center">
                    <h2 class="section-title">Les derniers matchs de mentor</h2>
                </div>
                <div class="section1-content-right-wrp ">
                    <div class="row text-center justify-content-center1 mt-2">
                        <div class="col-sm-3">
                            <div class="matches-images">
                                <div class="d-flex justify-content-center">
                                    <div class="matches-images-col pr-2">
                                        <div class="matches-image">
                                            <img src="assets/images/user-1.jpg" />
                                        </div>
                                        <div class="text-center mt-2 mb-2" style="margin-left:10px">Henry</div>
                                    </div>
                                    <div class="matches-images-col">
                                        <div class="matches-image">
                                            <img src="assets/images/user-2.jpg" />
                                        </div>
                                        <div class="text-center mt-2 mb-2" style="margin-left:0px">Amanda</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="matches-images">
                                <div class="d-flex justify-content-center">
                                    <div class="matches-images-col pr-2">
                                        <div class="matches-image">
                                            <img src="assets/images/user-3.jpg" />
                                        </div>
                                        <div class="text-center mt-2 mb-2" style="margin-left:10px">Henry</div>
                                    </div>
                                    <div class="matches-images-col">
                                        <div class="matches-image">
                                            <img src="assets/images/author-main1.jpg" />
                                        </div>
                                        <div class="text-center mt-2 mb-2" style="margin-left:10px">John</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="matches-images">
                                <div class="d-flex justify-content-center">
                                    <div class="matches-images-col pr-2">
                                        <div class="matches-image">
                                            <img src="assets/images/directory-img5.jpg" />
                                        </div>
                                        <div class="text-center mt-2 mb-2" style="margin-left:10px">Jérémy</div>
                                    </div>
                                    <div class="matches-images-col">
                                        <div class="matches-image">
                                            <img src="assets/images/team_1.jpg" />
                                        </div>
                                        <div class="text-center mt-2 mb-2" style="margin-left:0px">Laurie</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="matches-images">
                                <div class="d-flex justify-content-center">
                                    <div class="matches-images-col pr-2">
                                        <div class="matches-image">
                                            <img src="assets/images/directory-img1.jpg" />
                                        </div>
                                        <div class="text-center mt-2 mb-2" style="margin-left:10px">Henry</div>
                                    </div>
                                    <div class="matches-images-col">
                                        <div class="matches-image">
                                            <img src="assets/images/user-5.jpg"/>
                                        </div>
                                        <div class="text-center mt-2 mb-2" style="margin-left:10px">Emilie</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
