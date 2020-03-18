@extends('admin.app')

@section('content')

<!-- Main content -->
<section class="content">
	<div class="container-fluid">
		<!-- Small boxes (Stat box) -->
		<div class="row">
			<div class="col-lg-3 col-6">
				<!-- small box -->
				<div class="small-box bg-info">
					<div class="inner">
						<h3>0</h3>

						<p>Gear</p>
					</div>
					<div class="icon">
						<i class="ion ion-tshirt"></i>
					</div>
					<a href="{{url('admin/gear')}}" class="small-box-footer">
						More info <i class="fas fa-arrow-circle-right"></i>
					</a>
				</div>
			</div>
			<!-- ./col -->
			<div class="col-lg-3 col-6">
				<!-- small box -->
				<div class="small-box bg-success">
					<div class="inner">
						<h3>0</h3>

						<p>Course</p>
					</div>
					<div class="icon">
						<i class="ion ion-android-contacts"></i>
					</div>
					<a href="{{url('admin/course')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
				</div>
			</div>
			<!-- ./col -->
			<div class="col-lg-3 col-6">
				<!-- small box -->
				<div class="small-box bg-warning">
					<div class="inner">
						<h3>0</h3>

						<p>Trip by User</p>
					</div>
					<div class="icon">
						<i class="ion ion-android-boat"></i>
					</div>
					<a href="{{url('admin/usertrip')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
				</div>
			</div>
			<!-- ./col -->
			<div class="col-lg-3 col-6">
				<!-- small box -->
				<div class="small-box bg-danger">
					<div class="inner">
						<h3>0</h3>

						<p>Trip by Partner</p>
					</div>
					<div class="icon">
						<i class="ion ion-android-plane"></i>
					</div>
					<a href="{{url('admin/partnertrip')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
				</div>
			</div>
			<!-- ./col -->
		</div>
		<!-- row -->

		<div class="row">
			<div class="col-md-6">
				<!-- PRODUCT LIST -->
				<div class="card">
					<div class="card-header">
						<h3 class="card-title">Recently Added Advertisements</h3>

						<div class="card-tools">
							<button type="button" class="btn btn-tool" data-card-widget="collapse">
								<i class="fas fa-minus"></i>
							</button>
							<button type="button" class="btn btn-tool" data-card-widget="remove">
								<i class="fas fa-times"></i>
							</button>
						</div>
					</div>
					<!-- /.card-header -->
					<div class="card-body p-0">
						<ul class="products-list product-list-in-card pl-2 pr-2">
							<li class="item">
								<div class="product-img">
									<img src="adminpanel/dist/img/default-150x150.png" alt="Product Image" class="img-size-50">
								</div>
								<div class="product-info">
									<a href="javascript:void(0)" class="product-title">Diving Mask
										<span class="badge badge-info float-right">Rp 1.500.000</span></a>
										<span class="product-description">
											in <strong>Gear</strong>
										</span>
								</div>
							</li>

							<li class="item">
								<div class="product-img">
									<img src="adminpanel/dist/img/default-150x150.png" alt="Product Image" class="img-size-50">
								</div>
								<div class="product-info">
									<a href="javascript:void(0)" class="product-title">Scuba Diving
										<span class="badge badge-success float-right">Rp 750.000</span></a>
										<span class="product-description">
											in <strong>Course</strong>
										</span>
								</div>
							</li>

							<li class="item">
								<div class="product-img">
									<img src="adminpanel/dist/img/default-150x150.png" alt="Product Image" class="img-size-50">
								</div>
								<div class="product-info">
									<a href="javascript:void(0)" class="product-title">
										A Trip to Maldives 
										<span class="badge badge-danger float-right">
											Rp 75.000.000
										</span>
									</a>
									<span class="product-description">
										in <strong>Trip by Partner</strong>
									</span>
								</div>
							</li>

							<li class="item">
								<div class="product-img">
									<img src="adminpanel/dist/img/default-150x150.png" alt="Product Image" class="img-size-50">
								</div>
								<div class="product-info">
									<a href="javascript:void(0)" class="product-title">
										Deep Ocean Exploration
										<span class="badge badge-warning float-right">Rp 30.000.000</span>
									</a>
									<span class="product-description">
										in <strong>Trip by User</strong>
									</span>
								</div>
							</li>

							<li class="item">
								<div class="product-img">
									<img src="adminpanel/dist/img/default-150x150.png" alt="Product Image" class="img-size-50">
								</div>
								<div class="product-info">
									<a href="javascript:void(0)" class="product-title">
										Deep Ocean Exploration
										<span class="badge badge-warning float-right">Rp 30.000.000</span>
									</a>
									<span class="product-description">
										in <strong>Trip by User</strong>
									</span>
								</div>
							</li>
						</ul>
					</div>
					<!-- /.card-body -->
				</div>
				<!-- /.card -->
			</div>
			<!-- /.col -->

			<div class="col-md-6">
				<!-- USERS LIST -->
				<div class="card">
					<div class="card-header">
						<h3 class="card-title">Latest Users</h3>

						<div class="card-tools">
							<button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
							</button>
							<button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i>
							</button>
						</div>
					</div>
					<!-- /.card-header -->
					<div class="card-body p-0">
						<ul class="users-list clearfix">
							<li>
								<img src="adminpanel/dist/img/user1-128x128.jpg" alt="User Image">
								<a class="users-list-name" href="#">Alexander Pierce</a>
								<span class="users-list-date">Today</span>
							</li>
							<li>
								<img src="adminpanel/dist/img/user8-128x128.jpg" alt="User Image">
								<a class="users-list-name" href="#">Norman</a>
								<span class="users-list-date">Yesterday</span>
							</li>
							<li>
								<img src="adminpanel/dist/img/user7-128x128.jpg" alt="User Image">
								<a class="users-list-name" href="#">Jane</a>
								<span class="users-list-date">12 Jan</span>
							</li>
							<li>
								<img src="adminpanel/dist/img/user6-128x128.jpg" alt="User Image">
								<a class="users-list-name" href="#">John</a>
								<span class="users-list-date">12 Jan</span>
							</li>
							<li>
								<img src="adminpanel/dist/img/user2-160x160.jpg" alt="User Image">
								<a class="users-list-name" href="#">Alexander</a>
								<span class="users-list-date">13 Jan</span>
							</li>
							<li>
								<img src="adminpanel/dist/img/user5-128x128.jpg" alt="User Image">
								<a class="users-list-name" href="#">Sarah</a>
								<span class="users-list-date">14 Jan</span>
							</li>
							<li>
								<img src="adminpanel/dist/img/user4-128x128.jpg" alt="User Image">
								<a class="users-list-name" href="#">Nora</a>
								<span class="users-list-date">15 Jan</span>
							</li>
							<li>
								<img src="adminpanel/dist/img/user3-128x128.jpg" alt="User Image">
								<a class="users-list-name" href="#">Nadia</a>
								<span class="users-list-date">15 Jan</span>
							</li>
						</ul>
					</div>
					<!-- /.card-body -->
				</div>
				<!--/.card -->
			</div>
			<!-- /.col -->
		</div>
		<!-- /.row -->				
	</div>

</section>
@endsection