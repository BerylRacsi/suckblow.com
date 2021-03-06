@extends('admin.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit Trip Ads</div>

                <div class="card-body">
                    <div class="card-body">
                    <form method="POST" action="{{action('PartnerTripController@update',$trip->id)}}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Company Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name"  placeholder="Trip Title" value="{{$trip->name}}" required autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="description" class="col-md-4 col-form-label text-md-right">Description</label>

                            <div class="col-md-6">
                                <textarea id="description" type="textarea" class="form-control @error('description') is-invalid @enderror" name="description"  placeholder="Describe your trip here" required>{{$trip->description}}</textarea>

                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="price" class="col-md-4 col-form-label text-md-right">Price</label>

                            <div class="col-md-6">
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">Rp.</div>
                                    </div>
                                    <input id="price" data-type="currency" type="text" class="form-control @error('price') is-invalid @enderror" name="price"  placeholder="Price" value="{{$trip->price}}" required>
                                </div>

                                @error('price')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="location" class="col-md-4 col-form-label text-md-right">Location</label>

                            <div class="col-md-6">
                                <input id="location" type="text" class="form-control @error('location') is-invalid @enderror" name="location"  placeholder="Trip Destination" value="{{$trip->location}}" required>

                                @error('location')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="address" class="col-md-4 col-form-label text-md-right">Address</label>

                            <div class="col-md-6">
                                <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address"  placeholder="Detailed Address" value="{{$trip->address}}" required>

                                @error('location')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="since" class="col-md-4 col-form-label text-md-right">Operate Since</label>
                            <div class="col-md-2">
                                <input class="form-control @error('Operate Since') is-invalid @enderror" type="number" name="since" value="{{$trip->since}}" min="1900" max="2020">

                                @error('since')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="agency" class="col-md-4 col-form-label text-md-right">Agency</label>

                            <div class="col-md-6" style="padding-top: 5px">
                                @foreach($agencies as $key => $agency)
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" value="{{$agency->name}}" name="agency[]" id="agency{{$agency->id}}" {{$agencyArray[$key]}}>
                                    <label class="form-check-label" for="">
                                        {{$agency->name}}
                                    </label>
                                </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="facility" class="col-md-4 col-form-label text-md-right">Facility</label>

                            <div class="col-md-6" style="padding-top: 5px">
                                @foreach($facilities as $key => $facility)
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" value="{{$facility->name}}" name="facility[]" id="facility{{$facility->id}}" {{$facilityArray[$key]}}>
                                    <label class="form-check-label" for="">
                                        {{$facility->name}}
                                    </label>
                                </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="logo" class="col-md-4 col-form-label text-md-right">Company Logo</label>

                            <div class="col-md-6">
                                <input type="file" name="logo" class="form-control-file @error('logo.*') is-invalid @enderror"">
                                @error('logo.*')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="image" class="col-md-4 col-form-label text-md-right">
                                Upload Photos
                                <p class="text-muted">* Maximum 5 images allowed</p>
                            </label>

                            <div class="col-md-6">
                                <input type="file" name="image[]" class="form-control-file @error('image.*') is-invalid @enderror" multiple="true">
                                @error('image.*')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <input type="hidden" name="_method" value="PUT">
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Submit') }}
                                </button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection