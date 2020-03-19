@extends('admin.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Add Course Ads</div>

                <div class="card-body">
                    <form method="POST" action="{{action('CourseController@store')}}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row">
                            <label for="agency" class="col-md-4 col-form-label text-md-right">Dive Agency</label>

                            <div class="col-md-6">
                                <select id="agency" name="agency" class="form-control" required>
                                    @if(NULL !== old('agency'))
                                        <option value="{{ old('agency') }}" selected>{{ old('agency') }}</option>
                                    @else
                                        <option value="" disabled selected>Select Dive Agency</option>
                                    @endif
                                    
                                    @foreach ($agencies as $agency)
                                        <option value="{{$agency->name}}">{{$agency->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Full Name" value="{{ old('name') }}" required>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="diver" class="col-md-4 col-form-label text-md-right">Diver ID</label>

                            <div class="col-md-6">
                                <input id="diver" type="text" class="form-control @error('diver') is-invalid @enderror" name="diver" placeholder="Diver ID" value="{{ old('diver') }}" required>

                                @error('diver')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="qualification" class="col-md-4 col-form-label text-md-right">Qualification</label>

                            <div class="col-md-6" style="padding-top: 5px">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" name="qual1" id="qual1" @if(old('qual1') ==  "1") checked="checked" @endif>
                                    <label class="form-check-label" for="qual1">
                                        Open Water Diver
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" name="qual2" id="qual2" @if(old('qual2') ==  "1") checked="checked" @endif>
                                    <label class="form-check-label" for="qual2">
                                        Advanced Diver
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" name="qual3" id="qual3" @if(old('qual3') ==  "1") checked="checked" @endif>
                                    <label class="form-check-label" for="qual3">
                                        Rescue Diver
                                    </label>
                                </div><div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" name="qual4" id="qual4" @if(old('qual4') ==  "1") checked="checked" @endif>
                                    <label class="form-check-label" for="qual4">
                                        Dive Master
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" name="qual5" id="qual5" @if(old('qual5') ==  "1") checked="checked" @endif>
                                    <label class="form-check-label" for="qual5">
                                        Instructor Training Course
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="center" class="col-md-4 col-form-label text-md-right">Dive Center</label>

                            <div class="col-md-6">
                                <input id="center" type="text" class="form-control @error('center') is-invalid @enderror" name="center"  placeholder="Dive Center" value="{{ old('center') }}" required>

                                @error('center')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="total" class="col-md-4 col-form-label text-md-right">Total Dive Logs</label>
                            <div class="col-md-2">
                                <input class="form-control @error('total') is-invalid @enderror" type="number" name="total" value="{{ old('total') }}" min="1" max="35000" placeholder="1" required>

                                @error('total')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="since" class="col-md-4 col-form-label text-md-right">Dive Since</label>
                            <div class="col-md-2">
                                <input class="form-control @error('Dive Since') is-invalid @enderror" type="number" name="since" value="{{ old('since') }}" placeholder="1900" min="1900" max="2020" required>

                                @error('since')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="fb" class="col-md-4 col-form-label text-md-right">Facebook</label>

                            <div class="col-md-6">
                                <input id="fb" type="text" class="form-control @error('fb') is-invalid @enderror" name="fb"  placeholder="e.g. facebook.com/JohnDoe" value="{{ old('fb') }}" required>

                                @error('fb')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="ig" class="col-md-4 col-form-label text-md-right">Instagram</label>

                            <div class="col-md-6">
                                <input id="ig" type="text" class="form-control @error('ig') is-invalid @enderror" name="ig"  placeholder="e.g. instagram.com/JohnDoe" value="{{ old('ig') }}" required>

                                @error('ig')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="image" class="col-md-4 col-form-label text-md-right">Upload a Photo</label>

                            <div class="col-md-6">
                                <input type="file" name="image" class="form-control-file @error('image.*') is-invalid @enderror">
                                @error('image.*')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

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