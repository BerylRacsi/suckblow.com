@extends('admin.app')

@section('content')

<div class="card">
    <div class="card-header">
        <h3 class="card-title" style="float: left;">Admin Account</h3>
        <a class="btn btn-sm btn-success" href="{{url('/admin/admin-account/create')}}" style="float: right;">
            <i class="fas fa-plus-circle"></i> 
            Add Account
        </a>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <div class="table-responsive">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($admins as $admin)
                    <tr>
                        <td>{{$admin->name}}</td>
                        <td>{{$admin->email}}</td>
                        <td style="display: flex; justify-content: center;">
                            <div class="btn-group">
                                <button type="button" class="btn btn-default dropdown-toggle" id="dropdownAction" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Manage
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownAction">
                                    <a href="{{url('admin/admin-account/'.$admin->id.'/edit')}}" class="dropdown-item">Edit</a>
                                    <form action="{{action('AdminController@destroy', $admin->id)}}" method="POST">
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