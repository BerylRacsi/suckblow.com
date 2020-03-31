@extends('layouts.master')

@section('content')
<!--================Single Product Area =================-->
<section class="section-margin--small mt-0">
<div class="product_image_area">
	<div class="container">
		<div class="row s_product_inner">
			<div class="col-lg-6">
				<div class="owl-carousel owl-theme s_Product_carousel">
					<div class="single-prd-item">
						<img class="img-fluid" src="{{asset($course->image)}}" alt="">
					</div>
				</div>
			</div>
			<div class="col-lg-5 offset-lg-1">
				<div class="card lister-contact">
					@if(Auth::guard('partner')->check() || Auth::guard('web')->check())
					<div class="card-body">
						<div class="row">
							<div class="col-4">
								<img src="{{asset('images/layout/suckblow-logo.png')}}" class="img-fluid" width="50" height="50">
							</div>
							<div class="col-8">
								<a href="#">
									<strong>
										<span style="display: inline-block; width: 50px;">
											Lister
										</span> : Suck Blow 
									</strong>
								</a>
								<br>
								<a href="#">
									<strong>
										<span style="display: inline-block; width: 50px;">
											Phone
										</span> : +6281399998888
									</strong>
								</a>
							</div>
						</div>
					</div>
					@else
					<div class="card-body text-center" style="display: flex; align-items: center; margin: 0 auto; vertical-align: center">
						<a href="{{route('login')}}">
							<strong>
								<i>You need to login to see lister contact</i>
							</strong>
						</a>
					</div>
					@endif
				</div>
				<div class="s_product_text">
					<h3>{{$course->name}}</h3>
					<h2>{{$course->agency}}</h2>
					<hr>
					<ul class="list">
						<li>
							<a href="#">
								<strong>
								<span>Dive Center</span> : {{$course->center}}
								</strong>
							</a>
						</li>
						<li>
							<a href="#">
								<strong>
								<span>Diver ID</span> : {{$course->diver}}
								</strong>
							</a>
						</li>
						<li>
							<a href="#">
								<strong>
								<span>Total Dive</span> : {{$course->total}}
								</strong>
							</a>
						</li>
						<li>
							<a href="#">
								<strong>
								<span>Dive Since</span> : {{$course->since}}
								</strong>
							</a>
						</li>
						<hr>
						<li>
							<a href="#">
								<strong>
								<span>Qualification</span> : 
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
								</strong>
							</a>
						</li>
						<hr>
						<li>
							<a href="#">
								<strong>
								<span>Social Media</span> :
                <a href="https://{{$course->fb}}">
                  <i class="fab fa-facebook fa-2x" style="margin-left: 5px"></i>
                </a>
                <a href="https://{{$course->ig}}">
                  <i class="fab fa-instagram fa-2x" style="margin-left: 5px"></i>
                </a>
                </strong>
							</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
</section>
<!--================End Single Product Area =================-->
@endsection