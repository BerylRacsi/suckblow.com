@extends('layouts.master')

@section('content')
<!--================Single Product Area =================-->
<div class="product_image_area">
	<div class="container">
		<div class="row s_product_inner">
			<div class="col-lg-6">
				<div class="owl-carousel owl-theme s_Product_carousel">
					@foreach (explode(',', $gear->image) as $image)
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
					<h3>{{$gear->name}}</h3>
					<h2>Rp {{$gear->price}}</h2>
					<hr>
					<ul class="list">
						<li>
							<a href="#">
								<strong>
								<span>Category</span> : {{$gear->category}}
								</strong>
							</a>
						</li>
						<li>
							<a href="#">
								<strong>
								<span>Condition</span> : 
								@if($gear->condition == 1)
                    New
                @else
                    Used
                @endif
              </strong>
							</a>
						</li>
						<li>
							<a href="#">
								<strong>
								<span>Warranty</span> : 
								@if($gear->warranty == 1)
                    Yes
                @else
                    No
                @endif
                </strong>
							</a>
						</li>
						<hr>
						<li>
							<a href="#">
								<strong>
								<span>Product Video</span> :
                <a href="https://{{$gear->link}}">
                  <i class="fab fa-youtube fa-2x" style="margin-left: 5px"></i>
                </a>
                </strong>
							</a>
						</li>
					</ul>
					<p>
						{{$gear->description}}
					</p>
				</div>
			</div>
		</div>
	</div>
</div>
<!--================End Single Product Area =================-->
<!--================ Start related Product area =================-->  
<section class="related-product-area section-margin--small mt-0">
	<div class="container">
		<div class="section-intro pb-60px">
			<br>
      <h2>Related <span class="section-intro__style">Product</span></h2>
    </div>
		<div class="row mt-30">
      @foreach($related->chunk(3) as $chunk)
      <div class="col-sm-6 col-xl-3 mb-4 mb-xl-0">
        <div class="single-search-product-wrapper">
          @foreach($chunk as $item)
          <div class="single-search-product d-flex">
            <a href="#">
            	@foreach (explode(',', $item->image) as $image)
            	<img src="{{url($image)}}" alt="">
            	@break
            	@endforeach
            </a>
            <div class="desc">
                <a href="#" class="title">{{$item->name}}</a>
                <div class="price">Rp {{$item->price}}</div>
            </div>
          </div>
          @endforeach
        </div>
      </div>
      @endforeach

    </div>
	</div>
</section>
<!--================ end related Product area =================-->
@endsection