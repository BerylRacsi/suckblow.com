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
					<h3>Destination : {{$trip->location}}</h3>
					<h2>Rp {{$trip->price}}</h2>
					<hr>
					<h5>{{$trip->name}}</h5>
					<hr>
					<ul class="list">
						<li>
							<a href="#">
								<strong>
								<span>Trip Length</span> : {{$trip->length}} Days
								</strong>
							</a>
						</li>
						<li>
							<a href="#">
								<strong>
								<span>Itinerary</span> : 
								<a href="#" class="btn btn-primary" data-toggle="modal" data-target="#modal-itinerary" style="margin-left: 5px; color: white;">
                   <i class="fas fa-tasks fa-lg"></i>
                </a>
								</strong>
							</a>
						</li>
						<hr>
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

<div class="modal fade" id="modal-itinerary" style="z-index: 1000000;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Itinerary</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <img src="{{asset($trip->itinerary)}}" class="img-fluid">
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
@endsection