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
      <a href="{{url('/course')}}" class="hero-carousel__slideOverlay">
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

@endsection