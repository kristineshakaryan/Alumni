@extends('super_admin_inc.template')
@section('content')
    <div class="container-fluid page-body-wrapper">
        <!-- partial -->
        <div class="main-panel p-3">
            <table class="datatable table table-hover nowrap w-100 table_for_school" >
                <thead>
                <tr>
                    <th>Survey Name</th>
                    <th>Type</th>
                    <th></th>

                </tr>
                </thead>
                <tbody>
                @foreach($surveys as $key => $survey)
                    <tr >
                        <td>{{$survey->name}}</td>
                        <td><p> {{$survey->GetSurveyType->name}}</p> </td>
                        <td>
                            <button access="{{ Crypt::encrypt($survey->id) }}" data="Survey" class="btn btn-outline-danger SADelete ml-1">Delete</button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <th>Survey Name</th>
                    <th>Type</th>
                    <th></th>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>
@endsection














