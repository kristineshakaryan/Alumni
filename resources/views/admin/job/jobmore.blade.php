@foreach($jobs as $job)
    <div class="jobofferpg-post-col col-lg-6" style="display: none">
        <div class="jobofferpg-post-col-wrp d-flex bg-white box-shadow p-4">
            <div class="jobofferpg-post-content pl-3">
                <h6 class="jobofferpg-post-title mb-2">{{ $job->title }}</h6>
                @if($job->chooseUser)
                <p class="mb-1">{{ $job->chooseUser->city}}</p>
                @endif
            </div>
            <div class="jobofferpg-post-btnc ml-auto">
                <div class="jobofferpg-post-btnc-wrp d-flex align-items-end flex-column h-100">
                    <div class="jobofferpg-post-date text-right mb-auto">{{ date('d M, Y',strtotime($job->created_at)) }}</div>
                    @if($job->status == \App\JobBoard::status_active)
                        <small class="badge badge-success ">Active</small>
                    @else
                        <small class="badge badge-danger ">Inactive</small>
                    @endif
                    <div class="jobofferpg-post-btnc-wrp  align-center">
                        <div class="d-flex mt-3 align-items-center">
                            <div class="jobofferpg-post-btn mr-2">
                                <a href="#" class="btn btn-theme">Edit</a>
                            </div>
                            <div class="jobofferpg-post-btn">
                                <a href="#" class="btn btn-theme">Consulter</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach