@extends('admin.app')

@section('content')

<div class="card">
    <div class="card-header">
        <h3 class="card-title" style="float: left;">User Trip Ads List</h3>
        <a class="btn btn-sm btn-success" href="{{url('admin/usertrip/create')}}" style="float: right;">
            <i class="fas fa-plus-circle"></i> 
            Post Ads
        </a>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <div class="table-responsive">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Location</th>
                        <th>Price</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($trips as $trip)
                    <tr>
                        <td>{{$trip->name}}</td>
                        <td>{{$trip->location}}</td>
                        <td>{{$trip->price}}</td>
                        <td style="display: flex; justify-content: center;">
                            <div class="btn-group">
                                <button type="button" class="btn btn-default dropdown-toggle" id="dropdownAction" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Manage
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownAction">
                                    <a href="{{url('admin/usertrip/'.$trip->id.'/edit')}}" class="dropdown-item">Edit</a>
                                    <a href="{{url('admin/usertrip/'.$trip->id)}}" class="dropdown-item">Detail</a>
                                    <form action="{{action('UserTripController@destroy', $trip->id)}}" method="POST">
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