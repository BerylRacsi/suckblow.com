@extends('admin.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Ads Detail</div>

                <div class="card-body">
                    <table class="table">
                        <tbody>
                            <tr>
                                <th>Name</th>
                                <td>{{$course->name}}</td>
                            </tr>
                            <tr>
                                <th>Agency</th>
                                <td>{{$course->agency}}</td>
                            </tr>
                            <tr>
                                <th>Diver ID</th>
                                <td>{{$course->diver}}</td>
                            </tr>
                            <tr>
                                <th>Dive Center</th>
                                <td>{{$course->center}}</td>
                            </tr>
                            <tr>
                                <th>Total Dive Log</th>
                                <td>{{$course->total}}</td>
                            </tr>
                            <tr>
                                <th>Dive Since</th>
                                <td>{{$course->since}}</td>
                            </tr>
                            <tr>
                                <th>Qualification</th>
                                <td>
                                    <div class="col-md-6" style="padding-top: 5px">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" name="qual1" id="qual1" disabled {{ ($course->open == 1) ? 'checked = "checked" ' :''}}>
                                    <label class="form-check-label" for="qual1">
                                        Open Water Diver
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" name="qual2" id="qual2" disabled {{ ($course->advance == 1) ? 'checked = "checked" ' :''}}>
                                    <label class="form-check-label" for="qual2">
                                        Advanced Diver
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" name="qual3" id="qual3" disabled {{ ($course->rescue == 1) ? 'checked = "checked" ' :''}}>
                                    <label class="form-check-label" for="qual3">
                                        Rescue Diver
                                    </label>
                                </div><div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" name="qual4" id="qual4" disabled {{ ($course->master == 1) ? 'checked = "checked" ' :''}}>
                                    <label class="form-check-label" for="qual4">
                                        Dive Master
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" name="qual5" id="qual5" disabled {{ ($course->instructor == 1) ? 'checked = "checked" ' :''}}>
                                    <label class="form-check-label" for="qual5">
                                        Instructor Training Course
                                    </label>
                                </div>
                            </div>
                                </td>
                            </tr>
                            <tr>
                                <th>Facebook</th>
                                <td>{{$course->fb}}</td>
                            </tr>
                            <tr>
                                <th>Instagram</th>
                                <td>{{$course->ig}}</td>
                            </tr>
                            <tr>
                                <th>Photo</th>
                                <td>
                                    <img src="{{ url('/',$course->image) }}" alt="IMG-PRODUCT" width="150" height="150">
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="row">
                        <div class="col-md-4">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection