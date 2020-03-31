@extends('layouts.master')

@section('content')

<!--================ Hero Carousel start =================-->
<section class="section-margin mt-10">
  <div class="owl-carousel owl-theme hero-carousel">
    <div class="hero-carousel__slide">
      <img src="{{asset('images/site-content/home/hero-slide1.png')}}" alt="" class="img-fluid">
      <a href="{{url('/gear')}}" class="hero-carousel__slideOverlay">
        <h3>Gear</h3>
      </a>
    </div>
    <div class="hero-carousel__slide">
      <img src="{{asset('images/site-content/home/hero-slide2.png')}}" alt="" class="img-fluid">
      <a href="{{url('/course/agency')}}" class="hero-carousel__slideOverlay">
        <h3>Course</h3>
      </a>
    </div>
    <div class="hero-carousel__slide">
      <img src="{{asset('images/site-content/home/hero-slide3.png')}}" alt="" class="img-fluid">
      <a href="{{url('/trip')}}" class="hero-carousel__slideOverlay">
        <h3>Trip</h3>
      </a>
    </div>
  </div>
</section>
<!--================ Hero Carousel end =================-->

<!-- ================ offer section start ================= --> 
<section class="offer" id="parallax-1" data-anchor-target="#parallax-1" data-300-top="background-position: 0px 30px" data-top-bottom="background-position: 0 30px">
  <div class="container">
    <div class="row">
      <div class="col-xl-5">
        <div class="offer__content text-center">
          <h3>Up To 50% Off</h3>
          <h4>Winter Sale</h4>
          <p>Him she'd let them sixth saw light</p>
          <a class="button button--active mt-3 mt-xl-4" href="#">Shop Now</a>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- ================ offer section end ================= --> 

@endsection