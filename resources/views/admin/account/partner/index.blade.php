@extends('admin.app')

@section('content')

<div class="card">
    <div class="card-header">
        <h3 class="card-title" style="float: left;">Partner Account</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <div class="table-responsive">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Company</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Category</th>
                        <th>Address</th>
                        <th>Avatar</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($partners as $partner)
                    <tr>
                        <td>{{$partner->name}}</td>
                        <td>{{$partner->email}}</td>
                        <td>{{$partner->phone}}</td>
                        <td>{{$partner->category}}</td>
                        <td>
                            {{$partner->address}}
                            {{$partner->city}}
                            {{$partner->province}}
                            {{$partner->country}}
                        </td>
                        <td>
                            <ul class="list-inline">
                                <li class="list-inline-item">
                                    <img alt="Avatar" class="table-avatar" src="{{asset($partner->image)}}"  width="100" height="100">
                                </li>
                            </ul>
                        </td>
                        <td style="display: flex; justify-content: center;">
                            <div class="btn-group">
                                <button type="button" class="btn btn-default dropdown-toggle" id="dropdownAction" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Manage
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownAction">
                                    <a href="{{url('admin/partner-account/'.$partner->id.'/edit')}}" class="dropdown-item">Edit</a>
                                    <form action="{{action('PartnerController@destroy', $partner->id)}}" method="POST">
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