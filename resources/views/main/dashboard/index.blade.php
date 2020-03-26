@extends('layouts.master')

@section('content')
<!--================Cart Area =================-->
<section class="cart_area">
  <div class="container">
    <div class="row">
      <div class="col-lg-8">
        <div class="container">
            <h3>My Ads</h3>
            <hr>
          <div class="cart_inner">
            <h5>Gear Ads</h5>
            <div class="table-responsive">
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">Title</th>
                    <th scope="col">Category</th>
                    <th scope="col">Price</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>
                      <div class="media">
                          <div class="d-flex">
                              <img src="{{asset('images/site-content/home/hero-slide1.png')}}" alt="" width="100" height="100">
                          </div>
                          <div class="media-body">
                              <p>Dummy Ads Name</p>
                          </div>
                      </div>
                    </td>
                    <td>
                      <h5>Dummy Category</h5>
                    </td>
                    <td>
                      <h5>Rp&nbsp999.999</h5>
                    </td>
                    <td>
                      <div class="btn-group">
                        <button type="button" class="btn btn-default dropdown-toggle" id="dropdownAction" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Manage
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownAction">
                            <a href="#" class="dropdown-item">Edit</a>
                            <a href="#" class="dropdown-item">Detail</a>
                            <form action="#" method="POST">
                                @csrf
                                <input name="_method" type="hidden" value="#">
                                <a href="#" onclick="this.parentNode.submit(); return false" class="dropdown-item">Delete</a>
                            </form>
                        </div>
                      </div>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
          <!-- Cart Inner -->
          <br>
          <div class="cart_inner">
            <h5>Course Ads</h5>
            <div class="table-responsive">
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">Title</th>
                    <th scope="col">Agency</th>
                    <th scope="col">Dive Center</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>
                      <div class="media">
                          <div class="d-flex">
                              <img src="{{asset('images/site-content/home/hero-slide1.png')}}" alt="" width="100" height="100">
                          </div>
                          <div class="media-body">
                              <p>Dummy Ads Name</p>
                          </div>
                      </div>
                    </td>
                    <td>
                      <h5>Dummy Agency</h5>
                    </td>
                    <td>
                      <h5>Dummy Dive Center</h5>
                    </td>
                    <td>
                      <div class="btn-group">
                        <button type="button" class="btn btn-default dropdown-toggle" id="dropdownAction" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Manage
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownAction">
                            <a href="#" class="dropdown-item">Edit</a>
                            <a href="#" class="dropdown-item">Detail</a>
                            <form action="#" method="POST">
                                @csrf
                                <input name="_method" type="hidden" value="#">
                                <a href="#" onclick="this.parentNode.submit(); return false" class="dropdown-item">Delete</a>
                            </form>
                        </div>
                      </div>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
          <!-- Cart Inner -->
          <br>
          <div class="cart_inner">
            <h5>Trip Ads</h5>
            <div class="table-responsive">
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">Title</th>
                    <th scope="col">Location</th>
                    <th scope="col">Price</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>
                      <div class="media">
                          <div class="d-flex">
                              <img src="{{asset('images/site-content/home/hero-slide1.png')}}" alt="" width="100" height="100">
                          </div>
                          <div class="media-body">
                              <p>Dummy Ads Names</p>
                          </div>
                      </div>
                    </td>
                    <td>
                      <h5>Dummy Location</h5>
                    </td>
                    <td>
                      <h5>Rp&nbsp999.999</h5>
                    </td>
                    <td>
                      <div class="btn-group">
                        <button type="button" class="btn btn-default dropdown-toggle" id="dropdownAction" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Manage
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownAction">
                            <a href="#" class="dropdown-item">Edit</a>
                            <a href="#" class="dropdown-item">Detail</a>
                            <form action="#" method="POST">
                                @csrf
                                <input name="_method" type="hidden" value="#">
                                <a href="#" onclick="this.parentNode.submit(); return false" class="dropdown-item">Delete</a>
                            </form>
                        </div>
                      </div>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
          <!-- Cart Inner -->
        </div>
        <!-- List Container -->
      </div>
      <!-- List Col -->

      <div class="col-lg-4">
        <div class="blog_right_sidebar">
          <aside class="single_sidebar_widget author_widget">
              <img class="author_img rounded-circle" src="{{asset($user->image)}}" alt="" width="120" height="120">
              <h4>{{$user->name}}</h4>
              @if(Auth::guard('partner')->check())
                  <p>Official Partner</p>
              @elseif(Auth::guard('web')->check())
                  <p>Regular User</p>
              @endif
              <hr>
              
          </aside>
        
          <aside class="single_sidebar_widget post_category_widget">
            <p class="text-center">
                {{$user->address}}
                @if(Auth::guard('partner')->check())
                    {{$user->city}}&nbsp{{$user->province}}&nbsp{{$user->country}}
                @endif
              </p>
              <ul class="list cat-list">
                  <li>
                      <a href="#" class="d-flex justify-content-between">
                          <p>Email</p>
                          <p>{{$user->email}}</p>
                      </a>
                  </li>
                  <li>
                      <a href="#" class="d-flex justify-content-between">
                          <p>Phone</p>
                          <p>{{$user->phone}}</p>
                      </a>
                  </li>
              </ul>
              <h4 class="widget_title">Edit Profile</h4>
          </aside>
        </div>
      </div>
      <!-- Profile Col -->
    </div>
    <!-- Row -->
  </div>
  <!-- Page container -->
</section>
<!--================End Cart Area =================-->


@endsection