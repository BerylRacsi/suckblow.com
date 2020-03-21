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
                                    <td>{{$trip->name}}</td>
                                </tr>
                                <tr>
                                    <th>Description</th>
                                    <td>{{$trip->description}}</td>
                                </tr>
                                <tr>
                                    <th>Price</th>
                                    <td>{{$trip->price}}</td>
                                </tr>
                                <tr>
                                    <th>Location</th>
                                    <td>{{$trip->location}}</td>
                                </tr>
                                <tr>
                                    <th>Duration</th>
                                    <td>{{$trip->length}}</td>
                                </tr>
                                <tr>
                                    <th>Itinerary</th>
                                    <td>
                                        <img src="{{ asset('/'.$trip->itinerary) }}" alt="IMG-PRODUCT" width="150" height="150">
                                    </td>
                                </tr>
                                <tr>
                                    <th>Photos</th>
                                    <td>
                                        @foreach (explode(',', $trip->image) as $image)
                                        <div class="col-md-4">
                                            <img src="{{ asset('/'.$image) }}" alt="IMG-PRODUCT" width="150" height="150">
                                        </div>
                                        <br>
                                        @endforeach
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