@extends('layouts.master')

@section('content')

<!-- ================ carousel section start ================= -->
<div id="carouselExampleControls" class="carousel slide" data-ride="carousel" style="position: relative;">
  
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img class="d-block w-100" src="{{asset('images/site-content/trip/scene-1.jpg')}}" alt="First slide" style="max-height: 400px; width: 100%;">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="{{asset('images/site-content/trip/scene-2.jpg')}}" alt="Second slide" style="max-height: 400px; width: 100%;">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="{{asset('images/site-content/trip/scene-3.jpg')}}" alt="Third slide" style="max-height: 400px; width: 100%;">
    </div>
  </div>

  <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>

  <div class="card" style="width: 80%; margin: 0 auto; position: absolute; left: 0; right: 0; z-index: 1; display: inline-block; bottom: -50px">
		<div class="card-body">
			<div class="row">
				<div class="col-lg-10 col-md-8">
          <form action="{{url('/trip/search')}}" method="GET">
					<div class="form-group">
						<div class="input-group">
							<input type="text" name="search" class="form-control" placeholder="Search in Trip" value="{{ old('search') }}">
							<div class="input-group-prepend">
	          		<span class="input-group-text" id="search-icon">
	          			<i class="fas fa-search"></i>
	          		</span>
	        		</div>
						</div>
					</div>
				</div>
				<div class="col-lg-2 col-md-4">
					<button class="btn btn-primary btn-block" type="submit">Search</button>
				</div>
        </form>
			</div>
		</div>
	</div>
</div><br>
<!-- ================ carousel section end ================= -->

<!-- ================ category section start ================= -->
<section class="section-margin--small mb-5">
	<div class="container">
		<section class="lattest-product-area pb-40 category-list">
			<div class="container">
				<div class="row">
		      @foreach($trips as $trip)
		      <div class="col-md-6 col-lg-3">
		        <div class="card text-center card-product">
		          <div class="card-product__img">
		          	@foreach (explode(',', $trip->image) as $image)
		            <img class="card-img" src="{{asset($image)}}" alt="">
		            @break
		            @endforeach
		          </div>
		          <div class="card-body">
		            <h4 class="card-product__title">
		            	<a href="{{url('/'.$trip->link.'/'.$trip->id)}}">
		            		{{$trip->name}}
		            	</a>
		            </h4>
		          </div>
		        </div>
		      </div>
		      @endforeach
		    </div>
			</div>
		</section>
	</div>
</section>
<!-- ================ category section end ================= -->
@endsection