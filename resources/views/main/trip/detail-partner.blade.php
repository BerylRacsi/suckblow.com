@extends('layouts.master')

@section('content')
<!--================Single Product Area =================-->
<section class="section-margin--small mt-0">
<div class="product_image_area">
	<div class="container">
		<div class="row s_product_inner">
			<div class="col-lg-6">
				<div class="owl-carousel owl-theme s_Product_carousel">
					@foreach (explode(',', $trip->image) as $image)
					<div class="single-prd-item">
						<img class="img-fluid" src="{{asset($image)}}" alt="">
					</div>
					@endforeach
				</div>
			</div>
			<div class="col-lg-5 offset-lg-1">
				<div class="s_product_text">
					<h3>Destination : {{$trip->location}}</h3>
					<h2>Rp {{$trip->price}}</h2>
					<hr>
					<div class="row">
						<div class="col-4">
							<img src="{{asset($trip->logo)}}" class="img-fluid" width="100" height="100">
						</div>
						<div class="col-8" style="display: flex; align-items: center;">
							<h5>Trip by {{$trip->name}}</h5>
						</div>
					</div>
					<hr>
					<ul class="list">
						<li>
							<a href="#">
								<strong>
								<span>Address</span> : {{$trip->address}}
								</strong>
							</a>
						</li>
						<li>
							<a href="#">
								<strong>
								<span>Since</span> : {{$trip->since}}
								</strong>
							</a>
						</li>
						<hr>
						<li>
							<a href="#">
								<strong>
								<div class="row">
									<div class="col-4">
										<span>Agencies</span> : 
									</div>
									<div class="col-8" style="padding-left: 0;">
										@foreach($agencies as $key => $agency)
		                  <div class="form-check form-check-inline">
		                      <input class="form-check-input" type="checkbox" value="{{$agency->name}}" name="agency[]" id="agency{{$agency->id}}" {{$agencyArray[$key]}} disabled>
		                      <label class="form-check-label" for="">
		                          {{$agency->name}}
		                      </label>
		                  </div>
		                 @endforeach
									</div>
								</div>
								</strong>
							</a>
						</li>
						<li>
							<a href="#">
								<strong>
								<div class="row">
									<div class="col-4">
										<span>Facilities</span> : 
									</div>
									<div class="col-8" style="padding-left: 0;">
										@foreach($facilities as $key => $facility)
                      <div class="form-check form-check-inline">
                          <input class="form-check-input" type="checkbox" value="{{$facility->name}}" name="facility[]" id="facility{{$facility->id}}" {{$facilityArray[$key]}} disabled>
                          <label class="form-check-label" for="">
                              {{$facility->name}}
                          </label>
                      </div>
                    @endforeach
									</div>
								</div>
								</strong>
							</a>
						</li>
					</ul>
					<p>
						{{$trip->description}}
					</p>
				</div>
			</div>
		</div>
	</div>
</div>
</section>
<!--================End Single Product Area =================-->
@endsection