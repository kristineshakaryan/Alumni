@extends('super_admin_inc.template')
@section('content')
    <div class="container-fluid page-body-wrapper">
        <!-- partial -->
        <div class="main-panel p-3">
            <table class="datatable table table-hover nowrap w-100 table_for_school" >
                <thead>
                <tr>
                    <th>ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Send Email</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $key => $user)
                    <tr >
                        <td> <p> {{$user->id}}</p> </td>
                        <td> <p> {{$user->first_name}}</p> </td>
                        <td> <p> {{$user->last_name}}</p> </td>
                        <td> <p> {{$user->email}}</p> </td>
                        <td>
                            <button access="{{ Crypt::encrypt($user->id) }}" class="btn btn-outline-danger SendEmailToUser" >Send Email</button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <th>ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Send Email</th>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>
@endsection