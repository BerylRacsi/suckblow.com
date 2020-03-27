@extends('layouts.master')

@section('content')

<!--================Blog Categorie Area =================-->
<section class="blog_categorie_area">
  <div class="container">
    <div class="row">
      <div class="col-sm-6 col-lg-4 mb-4 mb-lg-0">
          <div class="categories_post">
            <a href="{{url('/post/gear')}}">
              <img class="card-img rounded-0" src="{{asset('images/site-content/home/hero-slide1.png')}}" alt="post">
              <div class="categories_details">
                  <div class="categories_text">
                      <h5>Gear</h5>
                      <div class="border_line"></div>
                      <p>Awesome gears for awesome divers</p>
                  </div>
              </div>
            </a>
          </div>
      </div>
      <div class="col-sm-6 col-lg-4 mb-4 mb-lg-0">
          <div class="categories_post">
            <a href="{{url('/post/course')}}">
              <img class="card-img rounded-0" src="{{asset('images/site-content/home/hero-slide2.png')}}" alt="post">
              <div class="categories_details">
                  <div class="categories_text">
                    <h5>Course</h5>  
                    <div class="border_line"></div>
                    <p>Share your diving knowledge</p>
                  </div>
              </div>
            </a>
          </div>
      </div>
      <div class="col-sm-6 col-lg-4 mb-4 mb-lg-0">
          <div class="categories_post">
            @if(Auth::guard('partner')->check())
                <a href="{{url('/post/partnertrip')}}">
            @elseif(Auth::guard('web')->check())
                <a href="{{url('/post/usertrip')}}">
            @endif
              <img class="card-img rounded-0" src="{{asset('images/site-content/home/hero-slide3.png')}}" alt="post">
              <div class="categories_details">
                  <div class="categories_text">
                    <h5>Trip</h5>  
                    <div class="border_line"></div>
                    <p>Help people enjoy their life</p>
                  </div>
              </div>
            </a>
          </div>
      </div>
    </div>
  </div>
</section>
<!--================Blog Categorie Area =================-->

@endsection