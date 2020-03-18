@extends('admin.app')

@section('content')

<div class="card">
    <div class="card-header">
        <h3 class="card-title" style="float: left;">User Account</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <div class="table-responsive">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Address</th>
                        <th>Nationality</th>
                        <th>Avatar</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->phone}}</td>
                        <td>{{$user->address}}</td>
                        <td>{{$user->nationality}}</td>
                        <td>
                            <ul class="list-inline">
                                <li class="list-inline-item">
                                    <img alt="Avatar" class="table-avatar" src="{{asset($user->image)}}"  width="100" height="100">
                                </li>
                            </ul>
                        </td>
                        <td style="display: flex; justify-content: center;">
                            <div class="btn-group">
                                <button type="button" class="btn btn-default dropdown-toggle" id="dropdownAction" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Manage
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownAction">
                                    <a href="{{url('admin/user-account/'.$user->id.'/edit')}}" class="dropdown-item">Edit</a>
                                    <form action="{{action('UserController@destroy', $user->id)}}" method="POST">
                                        @csrf
                                        <input name="_method" type="hidden" value="DELETE">
                                        <a href="#" onclick="this.parentNode.submit(); return false" class="dropdown-item">Delete</a>
                                    </form>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <!-- /.card-body -->
</div>
<!-- /.card -->

@endsection