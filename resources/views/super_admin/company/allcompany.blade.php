@extends('super_admin_inc.template')
@section('content')
    <div class="container-fluid page-body-wrapper">
        <!-- partial -->
        <div class="main-panel p-3">
            <table class="datatable table table-hover nowrap w-100 table_for_school" >
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Logo</th>
                    <th>Name</th>
                    <th>Number of job offer posted</th>
                    <th>Last Activité</th>
                    <th>Schools</th>
                    <th></th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($companies as $key => $company)
                    <tr >
                        <td  class="row_for_details" data-type="Company" data-id="{{$company->id}}"><p>{{$company->id}}</p></td>
                        <td  class="row_for_details" data-type="Company" data-id="{{$company->id}}"> <img class="img_for_table" src="{{asset("images/Companies/" . $company->logo)}}"></td>
                        <td  class="row_for_details" data-type="Company" data-id="{{$company->id}}"><p>{{$company->name}}</p></td>
                        <td  class="row_for_details" data-type="Company" data-id="{{$company->id}}">  </td>
                        <td  class="row_for_details" data-type="Company" data-id="{{$company->id}}"> <p> {{$company->last_activity}}</p> </td>
                        <td  class="row_for_details" data-type="Company" data-id="{{$company->id}}">
                            @foreach(App\SchoolsOfTheCompany::where('company_id',$company->id)->get() as $school)
                                <p> {{$school->GetSchoolInfo->name}} </p>
                            @endforeach
                        </td>
                        <td  class="row_for_details" data-type="Company" data-id="{{$company->id}}">
                            <button access="{{ Crypt::encrypt($company->id) }}" class="btn btn-outline-warning editCompany" >Edit</button>
                        </td>
                        <td>
                            <button access="{{ Crypt::encrypt($company->id) }}" data="Company" class="btn btn-outline-danger SADelete ml-1">Delete</button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>


@endsection














