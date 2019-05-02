@extends('user_inc.template')
@section('content')
    <main>
        <div class="joboffer-pg jbpgs">
            <div class="container-fluid">
                <div class="joboffer-pg-wrp jbpgs-wrp">
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
                    <section class="jbpgs-post-start jobofferpg-post-start m-auto pb-5">
                        <div class="section-title-wrp text-center">
                            <h2 class="section-title">Les dernières offres d'emploi</h2>
                        </div>
                        <div class="jobofferpg-post-start-wrp">
                            <div class="row jobofferpg-post-wrp more_content">
                                @foreach($jobs as $job)
                                    <div class="jobofferpg-post-col col-lg-6">
                                        <div class="jobofferpg-post-col-wrp d-flex bg-white box-shadow p-4">
                                        <div class="jobofferpg-post-content pl-3">
                                            <h6 class="jobofferpg-post-title mb-2">{{ $job->title }}</h6>
{{--                                            <p class="mb-1">Total</p>--}}
{{--                                            <p class="mb-1">Paris</p>--}}
{{--                                            <p class="mb-1"><span>CDI</span> </p>--}}
{{--                                            <p class="mb-1">Auteur: Capucine Durand</p>--}}
                                        </div>
                                        <div class="jobofferpg-post-btnc ml-auto">
                                            <div class="jobofferpg-post-btnc-wrp d-flex align-items-end flex-column h-100">
                                                <div class="jobofferpg-post-date text-right mb-auto">{{ date('d M, Y',strtotime($job->created_at)) }}</div>
                                                @if($job->status == \App\JobBoard::status_active)
                                                    <small class="badge badge-success ">Active</small>
                                                @else
                                                    <small class="badge badge-danger ">Inactive</small>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            @if($jobs->lastPage() > 1)
                                <div class="mt-3 text-right">
                                    <a href="#" class="btn btn-theme VoirPlus" data_url="{{ urlencode($jobs->nextPageUrl()) }}"  count="{{ $jobs->lastPage() }}">Voir plus</a>
                                </div>
                            @endif

                        </div>
                    </section>
                </div>
            </div>
        </div>
    </main>
@endsection
