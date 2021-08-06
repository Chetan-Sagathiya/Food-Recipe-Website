@extends('layouts')

@section('content')
<header class="background-main-color">
		<div class="container">
			<div class="header-output">
				<div class="header-in">

					<div class="row">
						<div class="col-lg-2 col-md-12">
							<a id="logo" href="index.html" class="d-inline-block margin-tb-5px"><img src="assets/img/logo-1.png" alt=""></a>
							<a class="mobile-toggle padding-13px background-main-color" href="#"><i class="fas fa-bars"></i></a>
						</div>
						<div class="col-lg-8 col-md-12 position-inherit">
							<ul id="menu-main" class="white-link dropdown-dark text-lg-center nav-menu link-padding-tb-17px">
								<li class="has-dropdown"><a href="#">Home</a>
									<ul class="sub-menu text-left">
										<li><a href="index.html">Home 1</a></li>
										<li><a href="index-2.html">Home 2</a></li>
										<li><a href="index-3.html">Home 3</a></li>
									</ul>
								</li>
								<li class="has-dropdown"><a href="#">Recipes</a>
									<ul class="sub-menu text-left">
										<li><a href="recipes-grid-layout.html">Recipes - Grid Layout </a></li>
										<li><a href="recipes-list-layout.html">Recipes - List Layout</a></li>
										<li><a href="authors-layout-1.html">Authors - Layout (1)</a></li>
										<li><a href="authors-layout-2.html">Authors - Layout (2)</a></li>
										<li><a href="single-recipe.html">Single Recipe</a></li>
									</ul>
								</li>
								<li class="has-dropdown"><a href="#">Blog</a>
									<ul class="sub-menu text-left">
										<li><a href="blog-grid.html">Blog Grid </a></li>
										<li><a href="blog-list.html">Blog List</a></li>
										<li><a href="blog-classic.html">Blog Classic</a></li>
										<li><a href="blog-single.html">Blog Single</a></li>
									</ul>
								</li>
								<li class="has-dropdown"><a href="#">Pages</a>
									<ul class="sub-menu text-left">
										<li><a href="page-about.html">About Us </a></li>
										<li><a href="add-recipe.html">Add Recipe</a></li>
										<li><a href="page-login.html">Login Page</a></li>
										<li><a href="page-sign-up.html">Sign up</a></li>
										<li><a href="search-page.html">Search  Page</a></li>
										<li><a href="page-contact-us.html">Contact Us</a></li>
										<li><a href="page-404.html">Pages 404</a></li>
									</ul>
								</li>
								<li><a href="page-contact-us.html">Conact Us</a></li>
							</ul>
						</div>
						<div class="col-lg-2 col-md-12 d-none d-lg-block">
							<hr class="margin-bottom-0px d-block d-sm-none">
							<a href="add-recipe.html" class="text-white ba-2 box-shadow float-right padding-lr-23px padding-tb-15px text-extra-large"><i class="fas fa-plus"></i></a>
							<a href="page-login.html" class="text-white ba-1 box-shadow float-right padding-lr-23px padding-tb-15px text-extra-large"><i class="far fa-user"></i></a>
						</div>
					</div>

				</div>
			</div>
		</div>
	</header>
	<!-- // Header  -->


	<div id="page-title" class="padding-tb-30px gradient-white text-center">
		<div class="container">
			<ol class="breadcrumb opacity-5">
				<li><a href="#">Home</a></li>
				<li class="active">Login Page</li>
			</ol>
			<h1 class="font-weight-300">Login Page</h1>
		</div>
	</div>


	<div class="container margin-bottom-100px">
		<!--======= log_in_page =======-->
		<div id="log-in" class="site-form log-in-form box-shadow border-radius-10">

			<div class="form-output">
				<form action="{{ route('post-login') }}" method="POST">
          @if(Session::get('fail'))
            <div class="alert alert-danger">
              {{ Session::get('fail') }}
            </div>
          @endif

          @if(Session::get('success'))
            <div class="alert alert-success">
              {{ Session::get('success') }}
            </div>
          @endif
          @csrf
					<div class="form-group label-floating">
						<label class="control-label">Your Email</label>
						<input class="form-control" placeholder="" type="email" name="email">
					</div>
          @error('email')
          <div class="alert alert-danger"> {{ $message }} </div>
          @enderror
					<div class="form-group label-floating">
						<label class="control-label">Your Password</label>
						<input class="form-control" placeholder="" type="password" name="password">
					</div>
          @error('password')
          <div class="alert alert-danger"> {{ $message }} </div>
          @enderror
					<div class="remember">
						<div class="checkbox">
							<label>
							<input name="optionsCheckboxes" type="checkbox">
								Remember Me
						</label>
					</div>
						<a href="{{ route('forget-password') }}" class="forgot">Forgot my Password</a>
					</div>
          <button type="submit" class="btn btn-md btn-primary full-width">Login</button>

					<div class="or"></div>
					<p>Don't you have an account? <a href="{{ route('register') }}">Register Now!</a> </p>
				</form>
			</div>
		</div>
		<!--======= // log_in_page =======-->

	</div>
@endsection
