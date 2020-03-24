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
                    	<input class="pixel-radio" type="radio" id="Regulator" name="Regulator">
                    	<label for="Regulator">
                    		Regulator
                    		<span> (100)</span>
                    	</label>
                    </li>
                    <li class="filter-list">
                    	<input class="pixel-radio" type="radio" id="Mask" name="Mask">
                    	<label for="Mask">
                    		Mask
                    		<span> (100)</span>
                    	</label>
                    </li>
                    <li class="filter-list">
                    	<input class="pixel-radio" type="radio" id="Fins" name="Fins">
                    	<label for="Fins">
                    		Fins
                    		<span> (100)</span>
                    	</label>
                    </li><li class="filter-list">
                    	<input class="pixel-radio" type="radio" id="BCD" name="BCD">
                    	<label for="BCD">
                    		BCD
                    		<span> (100)</span>
                    	</label>
                    </li><li class="filter-list">
                    	<input class="pixel-radio" type="radio" id="Wetsuit" name="Wetsuit">
                    	<label for="Wetsuit">
                    		Wetsuit
                    		<span> (100)</span>
                    	</label>
                    </li><li class="filter-list">
                    	<input class="pixel-radio" type="radio" id="Torch" name="Torch">
                    	<label for="Torch">
                    		Torch
                    		<span> (100)</span>
                    	</label>
                    </li><li class="filter-list">
                    	<input class="pixel-radio" type="radio" id="Hook" name="Hook">
                    	<label for="Hook">
                    		Hook
                    		<span> (100)</span>
                    	</label>
                    </li><li class="filter-list">
                    	<input class="pixel-radio" type="radio" id="SMB & Reels" name="SMB & Reels">
                    	<label for="SMB & Reels">
                    		SMB & Reels
                    		<span> (100)</span>
                    	</label>
                    </li><li class="filter-list">
                    	<input class="pixel-radio" type="radio" id="Accessories" name="Accessories">
                    	<label for="Accessories">
                    		Accessories
                    		<span> (100)</span>
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
            <div>
              <div class="input-group filter-bar-search">
                <input type="text" placeholder="Search">
                <div class="input-group-append">
                  <button type="button"><i class="ti-search"></i></button>
                </div>
              </div>
            </div>
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