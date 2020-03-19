@extends('admin.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Ads Detail</div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <th>Name</th>
                                    <td>{{$gear->name}}</td>
                                </tr>
                                <tr>
                                    <th>Category</th>
                                    <td>{{$gear->category}}</td>
                                </tr>
                                <tr>
                                    <th>Description</th>
                                    <td>{{$gear->description}}</td>
                                </tr>
                                <tr>
                                    <th>Price</th>
                                    <td>Rp {{$gear->price}}</td>
                                </tr>
                                <tr>
                                    <th>Condition</th>
                                    <td>
                                        @if($gear->condition == 1)
                                            New
                                        @else
                                            Used
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Warranty</th>
                                    <td>
                                        @if($gear->warranty == 1)
                                            Yes
                                        @else
                                            No
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Youtube Link</th>
                                    <td>
                                        <a href="{{$gear->link}}">{{$gear->link}}</a>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Photos</th>
                                    <td>
                                        <div class="row">
                                            @foreach (explode(',', $gear->image) as $image)
                                            <div class="col-md-4">
                                                <img src="{{ asset('/'.$image) }}" alt="IMG-PRODUCT" width="150" height="150">
                                            </div>
                                            @endforeach
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection