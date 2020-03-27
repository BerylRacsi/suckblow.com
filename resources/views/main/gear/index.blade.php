@extends('layouts.master')

@section('content')
<!-- ================ category section start ================= -->		  
  <section class="section-margin--small mb-5">
    <div class="container">
      <div class="row">
        <div class="col-xl-3 col-lg-4 col-md-5">
          <div class="sidebar-categories">
            <div class="head">Browse Categories</div>
            <ul class="main-categories">
              <li class="common-filter">
                <form action="#">
                  <ul>
                    <li class="filter-list">
                    	<input class="pixel-radio" type="radio" id="Regulator" name="gearCategory" onclick="window.location = '{{url('/gear/category/Regulator')}}' ;">
                    	<label for="Regulator">
                    		Regulator
                    	</label>
                    </li>
                    <li class="filter-list">
                    	<input class="pixel-radio" type="radio" id="Mask" name="gearCategory" onclick="window.location = '{{url('/gear/category/Mask')}}' ;">
                    	<label for="Mask">
                    		Mask
                    	</label>
                    </li>
                    <li class="filter-list">
                    	<input class="pixel-radio" type="radio" id="Fins" name="gearCategory" onclick="window.location = '{{url('/gear/category/Fins')}}' ;">
                    	<label for="Fins">
                    		Fins
                    	</label>
                    </li><li class="filter-list">
                    	<input class="pixel-radio" type="radio" id="Buoyancy Compensation Device (BCD)" name="gearCategory" onclick="window.location = '{{url('/gear/category/Buoyancy Compensation Device (BCD)')}}' ;">
                    	<label for="BCD">
                    		BCD
                    	</label>
                    </li><li class="filter-list">
                    	<input class="pixel-radio" type="radio" id="Wetsuit" name="gearCategory" onclick="window.location = '{{url('/gear/category/Wetsuit')}}' ;">
                    	<label for="Wetsuit">
                    		Wetsuit
                    	</label>
                    </li><li class="filter-list">
                    	<input class="pixel-radio" type="radio" id="Torch" name="gearCategory" onclick="window.location = '{{url('/gear/category/Torch')}}' ;">
                    	<label for="Torch">
                    		Torch
                    	</label>
                    </li><li class="filter-list">
                    	<input class="pixel-radio" type="radio" id="Hook" name="gearCategory" onclick="window.location = '{{url('/gear/category/Hook')}}' ;">
                    	<label for="Hook">
                    		Hook
                    	</label>
                    </li><li class="filter-list">
                    	<input class="pixel-radio" type="radio" id="SMB & Reels" name="gearCategory" onclick="window.location = '{{url('/gear/category/SMB & Reels')}}' ;">
                    	<label for="SMB & Reels">
                    		SMB & Reels
                    	</label>
                    </li><li class="filter-list">
                    	<input class="pixel-radio" type="radio" id="Accessories" name="gearCategory" onclick="window.location = '{{url('/gear/category/Accessories')}}' ;">
                    	<label for="Accessories">
                    		Accessories
                    	</label>
                    </li>
                  </ul>
                </form>
              </li>
            </ul>
          </div>
        </div>
        <div class="col-xl-9 col-lg-8 col-md-7">
          <!-- Start Filter Bar -->
          <div class="filter-bar d-flex flex-wrap align-items-center">
            <form action="{{url('/gear/search')}}" method="GET">
              <div class="form-group">
                <div class="input-group filter-bar-search">
                    <input type="text" name="search" class="form-control" placeholder="Search for Gear" value="{{ old('search') }}">
                    <div class="input-group-prepend">
                      <button type="submit"><i class="ti-search"></i></button>
                    </div>
                </div>
              </div>
            </form>
          </div>
          <!-- End Filter Bar -->
          <!-- Start Best Seller -->
          <section class="lattest-product-area pb-40 category-list">
            <div class="row">
              @foreach($gears as $gear)
              <div class="col-md-6 col-lg-4">
                <div class="card text-center card-product">
                  <div class="card-product__img">
                  	@foreach (explode(',', $gear->image) as $image)
                    <img class="card-img" src="{{asset($image)}}" alt="">
                    @break
                    @endforeach
                  </div>
                  <div class="card-body">
                    <p>{{$gear->category}}</p>
                    <h4 class="card-product__title">
                    	<a href="{{url('/gear/'.$gear->id)}}">
                    		{{$gear->name}}
                    	</a>
                    </h4>
                    <p class="card-product__price">Rp {{$gear->price}}</p>
                  </div>
                </div>
              </div>
              @endforeach
            </div>
          </section>
          <!-- End Best Seller -->
        </div>
      </div>
    </div>
  </section>
	<!-- ================ category section end ================= -->
@endsection