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
                              <p>Minimalistic shop for multipurpose use</p>
                          </div>
                      </div>
                    </td>
                    <td>
                      <h5>Diving Mask</h5>
                    </td>
                    <td>
                      <h5>Rp 1500000</h5>
                    </td>
                    <td style="display: flex; justify-content: center;">
                      <div class="btn-group">
                        <button type="button" class="btn btn-default dropdown-toggle" id="dropdownAction" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Manage
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownAction">
                            <a href="#" class="dropdown-item">Edit</a>
                            <a href="{#" class="dropdown-item">Detail</a>
                            <form action="#" method="POST">
                                @csrf
                                <input name="_method" type="hidden" value="DELETE">
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
                              <p>Minimalistic shop for multipurpose use</p>
                          </div>
                      </div>
                    </td>
                    <td>
                      <h5>PADI</h5>
                    </td>
                    <td>
                      <h5>ITS</h5>
                    </td>
                    <td style="display: flex; justify-content: center;">
                      <div class="btn-group">
                        <button type="button" class="btn btn-default dropdown-toggle" id="dropdownAction" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Manage
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownAction">
                            <a href="#" class="dropdown-item">Edit</a>
                            <a href="{#" class="dropdown-item">Detail</a>
                            <form action="#" method="POST">
                                @csrf
                                <input name="_method" type="hidden" value="DELETE">
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
                              <p>Minimalistic shop for multipurpose use</p>
                          </div>
                      </div>
                    </td>
                    <td>
                      <h5>Maldives</h5>
                    </td>
                    <td>
                      <h5>$720.00</h5>
                    </td>
                    <td style="display: flex; justify-content: center;">
                      <div class="btn-group">
                        <button type="button" class="btn btn-default dropdown-toggle" id="dropdownAction" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Manage
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownAction">
                            <a href="#" class="dropdown-item">Edit</a>
                            <a href="{#" class="dropdown-item">Detail</a>
                            <form action="#" method="POST">
                                @csrf
                                <input name="_method" type="hidden" value="DELETE">
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
              <img class="author_img rounded-circle" src="{{asset('images/site-content/home/hero-slide1.png')}}" alt="" width="120" height="120">
              <h4>Charlie Barber</h4>
              <p>Regular User</p>
              <hr>
              
          </aside>
        
          <aside class="single_sidebar_widget post_category_widget">
            <p class="text-center">
                Jl. Mrica IV No. 51 Perumahan Lembah Hijau
              </p>
              <ul class="list cat-list">
                  <li>
                      <a href="#" class="d-flex justify-content-between">
                          <p>Email</p>
                          <p>racsiberyl@gmail.com</p>
                      </a>
                  </li>
                  <li>
                      <a href="#" class="d-flex justify-content-between">
                          <p>Phone</p>
                          <p>081329519877</p>
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