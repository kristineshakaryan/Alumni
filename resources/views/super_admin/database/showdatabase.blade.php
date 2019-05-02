@extends('super_admin_inc.template')
@section('content')
    <div class="container-fluid page-body-wrapper">
        <!-- partial -->
        <div class="main-panel p-3">

            <div class="row mt-3">
                <div class="col-md-2">
                    @foreach($tables as $key => $table)
                            <a  href="{{ route('super_admin.ShowDatabase') }}/{{$key}}"><p class="alert alert-dark">{{$table->Tables_in_datalumni}}</p></a>
                    @endforeach
                </div>
                <div class="col-md-10">
                    @if($columns)
                    <table class="datatable table table-hover nowrap w-100" >
                        <thead>
                            <tr>
                                @foreach($columns as $column)
                                    <th>{{$column->Field}}</th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($feilds as $feild)
                                <tr>
                                    @foreach($columns as $column)
                                    <?php $key = $column->Field; ?>
                                        <td>{{$feild->$key}}</td>
                                    @endforeach
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            @foreach($columns as $column)
                                <th>{{$column->Field}}</th>
                            @endforeach
                        </tr>
                        </tfoot>
                    </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection









