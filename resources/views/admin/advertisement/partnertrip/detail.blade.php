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
                                    <th>Address</th>
                                    <td>{{$trip->address}}</td>
                                </tr>
                                <tr>
                                    <th>Since</th>
                                    <td>{{$trip->since}}</td>
                                </tr>
                                <tr>
                                    <th>Agency</th>
                                    <td>
                                        @foreach($agencies as $key => $agency)
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" value="{{$agency->name}}" name="agency[]" id="agency{{$agency->id}}" {{$agencyArray[$key]}} disabled>
                                            <label class="form-check-label" for="">
                                                {{$agency->name}}
                                            </label>
                                        </div>
                                        @endforeach
                                    </td>
                                </tr>
                                <tr>
                                    <th>Facility</th>
                                    <td>
                                        @foreach($facilities as $key => $facility)
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" value="{{$facility->name}}" name="facility[]" id="facility{{$facility->id}}" {{$facilityArray[$key]}} disabled>
                                            <label class="form-check-label" for="">
                                                {{$facility->name}}
                                            </label>
                                        </div>
                                        @endforeach
                                    </td>
                                </tr>
                                <tr>
                                    <th>Company Logo</th>
                                    <td>
                                        <img src="{{ asset('/'.$trip->logo) }}" alt="IMG-PRODUCT" width="150" height="150">
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