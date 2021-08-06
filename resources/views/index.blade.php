@extends('layouts')

@section('content')
<div class="banner padding-tb-20px background-overlay" style="background-image: url('http://placehold.it/1600x747');">
<div class="container">
  <header class="background-main-color">
    <div class="header-output" style="height:110px;">
      <div class="header-in">

        <div class="row">
          <div class="col-lg-3 col-md-12 padding-left-30px">
            <a id="logo" href="index.html" class="d-inline-block margin-tb-10px"><img src="assets/img/logo-1.png" alt=""></a>
            <a class="mobile-toggle padding-13px background-main-color" href="#"><i class="fas fa-bars"></i></a>
          </div>
          <div class="col-lg-7 col-md-12 position-inherit">
            <ul id="menu-main" class="white-link dropdown-dark text-lg-center nav-menu link-padding-tb-24px">
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
              <li><a href="page-contact-us.html">Contact Us</a></li>
              <li><a href="{{ route('favorite') }}">Favorites</a></li>
            </ul>
          </div>

          <div class="col-lg-2 col-md-12 d-none d-lg-block">
            <hr class="margin-bottom-0px d-block d-sm-none">
            <a href="{{ route('add-recipe') }}" class="text-white ba-2 box-shadow float-right padding-lr-23px padding-tb-23px text-extra-large"><i class="fas fa-plus"></i></a>
            <a href="{{ route('login') }}" class="text-white ba-1 box-shadow float-right padding-lr-23px padding-tb-23px text-extra-large"><i class="far fa-user"></i></a>
          </div>
        </div>
      </div>
      <form method="POST" style="margin-left:300px;" action="{{ route('search-by-category') }}">
        @csrf
          <span style="display:inline;">
            <input style="height:30px; border-radius:5px;" id="search-categories"
                   placeholder="search by categories" type="text" class"mb-5 pb-5"
                   name="search-categories">
                <span id="list-categories"></span>
                <button type="submit" class="btn btn-primary"> <i class="fas fa-search"></i></button>
          </span>
      </form>
    </div>
  </header>
  <!-- // Header  -->
  @if(Session::get('fail'))
    <div class="alert alert-danger">
      {{ Session::get('fail') }}
    </div>
  @endif
</div>
<!-- //container  -->
</div>

<section class="padding-tb-100px">
<div class="container">
  <div class="title text-center">
    <h2 class="font-weight-700 text-main-color">Latest Recipes</h2>
    <div class="row justify-content-center margin-bottom-45px">
      <div class="col-md-7">
        <p class="text-grey-2">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s</p>
      </div>
    </div>
  </div>

  <!-- display search recipes -->
  @if(session::get('recipes_filter'))
  <div class="recipes-masonry">
  @foreach(session::get('recipes_filter') as $recipe)
    <div class="col-xl-3 col-lg-4 col-md-6 recipe-item margin-bottom-40px">
      <div class="card border-0 box-shadow">
        <div class="card-img-top"><a href="/show-recipe/{{ $recipe->id }}"><img src="{{ asset('images/'. $recipe->image )}}" alt=""></a></div>
        <div class="padding-lr-30px padding-tb-20px">
          <h5 class="margin-bottom-20px margin-top-10px"><a class="text-dark" href="/show-recipe/{{ $recipe->id }}">{{ $recipe->name }}</a></h5>
          <div class="rating">
            <ul>
              <li class="active"></li>
              <li class="active"></li>
              <li class="active"></li>
              <li class="active"></li>
              <li></li>
            </ul>
          </div>
          <hr>
          <div class="row no-gutters">
            <div class="col-4 text-left"><a href="#" class="text-red"><i class="far fa-heart"></i> Save</a></div>
            <div class="col-8 text-right"><a href="#" class="text-grey-2"><i class="fas fa-users"></i> 6-8 servings</a></div>
          </div>
        </div>
        <div class="background-light-grey border-top-1 border-grey padding-lr-30px padding-tb-20px">
          <a href="#" class="d-inline-block text-grey-3 h6 margin-bottom-0px margin-right-15px"><img src="http://placehold.it/50x50" class="height-30px border-radius-30 margin-right-15px" alt=""> Salim Aldosery</a>
        </div>
      </div>
    </div>
  @endforeach
  </div>
  @endif
  <div class="recipes-masonry">
  @if(empty (session::get('recipes_filter')))
  @foreach($recipes as $recipe)
    <div class="col-xl-3 col-lg-4 col-md-6 recipe-item margin-bottom-40px">
      <div class="card border-0 box-shadow">
        <div class="card-img-top"><a href="/show-recipe/{{ $recipe->id }}"><img src="{{ asset('images/'. $recipe->image )}}" alt=""></a></div>
        <div class="padding-lr-30px padding-tb-20px">
          <h5 class="margin-bottom-20px margin-top-10px"><a class="text-dark" href="/show-recipe/{{ $recipe->id }}">{{ $recipe->name }}</a></h5>
          <div class="rating">
            <ul>
              <li class="active"></li>
              <li class="active"></li>
              <li class="active"></li>
              <li class="active"></li>
              <li></li>
            </ul>
          </div>
          <hr>
          <div class="row no-gutters">
            <div class="col-4 text-left"><a href="#" class="text-red"><i class="far fa-heart"></i> Save</a></div>
            <div class="col-8 text-right"><a href="#" class="text-grey-2"><i class="fas fa-users"></i> 6-8 servings</a></div>
          </div>
        </div>
        <div class="background-light-grey border-top-1 border-grey padding-lr-30px padding-tb-20px">
          <a href="#" class="d-inline-block text-grey-3 h6 margin-bottom-0px margin-right-15px"><img src="http://placehold.it/50x50" class="height-30px border-radius-30 margin-right-15px" alt=""> Salim Aldosery</a>
        </div>
      </div>
    </div>
  @endforeach
  </div>
  {!! $recipes->links() !!}
@endif
  <div class="text-center">
    <a href="#" class="btn box-shadow margin-top-50px padding-tb-10px btn-sm border-2 border-radius-30 btn-inline-block width-210px background-third-color text-white">Show All Recipes</a>
  </div>
</div>
<!-- // container -->
</section>


<section class="padding-tb-100px background-white">
<div class="container">

  <div class="title text-center">
    <h2 class="font-weight-700 text-main-color"> Top Authors</h2>
    <div class="row justify-content-center margin-bottom-45px">
      <div class="col-md-7">
        <p class="text-grey-2">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s</p>
      </div>
    </div>
  </div>

  <div class="row">

    <div class="col-lg-2 col-md-3 text-center">
      <div class="hvr-float">
        <div class="thum"><a href="#"><img class="border-radius-8 box-shadow" src="http://placehold.it/270x270" alt=""></a></div>
        <a class="h4 d-block margin-top-20px" href="#">Ali haleem</a>
        <small class="text-grey-2">(145 Recipes)</small>
      </div>
    </div>


    <div class="col-lg-2 col-md-3 text-center">
      <div class="hvr-float">
        <div class="thum"><a href="#"><img class="border-radius-8 box-shadow" src="http://placehold.it/270x270" alt=""></a></div>
        <a class="h4 d-block margin-top-20px" href="#">Salim Aldosery</a>
        <small class="text-grey-2">(145 Recipes)</small>
      </div>
    </div>


    <div class="col-lg-2 col-md-3 text-center">
      <div class="hvr-float">
        <div class="thum"><a href="#"><img class="border-radius-8 box-shadow" src="http://placehold.it/270x270" alt=""></a></div>
        <a class="h4 d-block margin-top-20px" href="#">Rabie Khair</a>
        <small class="text-grey-2">(145 Recipes)</small>
      </div>
    </div>


    <div class="col-lg-2 col-md-3 text-center">
      <div class="hvr-float">
        <div class="thum"><a href="#"><img class="border-radius-8 box-shadow" src="http://placehold.it/270x270" alt=""></a></div>
        <a class="h4 d-block margin-top-20px" href="#">Momen Alsho</a>
        <small class="text-grey-2">(145 Recipes)</small>
      </div>
    </div>


    <div class="col-lg-2 col-md-3 text-center">
      <div class="hvr-float">
        <div class="thum"><a href="#"><img class="border-radius-8 box-shadow" src="http://placehold.it/270x270" alt=""></a></div>
        <a class="h4 d-block margin-top-20px" href="#">M.Salman ali</a>
        <small class="text-grey-2">(145 Recipes)</small>
      </div>
    </div>


    <div class="col-lg-2 col-md-3 text-center">
      <div class="hvr-float">
        <div class="thum"><a href="#"><img class="border-radius-8 box-shadow" src="http://placehold.it/270x270" alt=""></a></div>
        <a class="h4 d-block margin-top-20px" href="#">Khalid Ziaad</a>
        <small class="text-grey-2">(145 Recipes)</small>
      </div>
    </div>

  </div>

  <div class="text-center">
    <a href="#" class="btn box-shadow margin-top-50px padding-tb-10px btn-sm border-2 border-radius-30 btn-inline-block width-210px background-dark text-white">Show All Authors</a>
  </div>

</div>
</section>


<section class="padding-tb-100px">
<div class="container">
  <div class="row">
    <div class="col-md-8">
      <h1 class="text-grey-2 margin-bottom-12px margin-top-20px font-weight-300"><span class="text-dark">Download</span> Cook Note App</h1>
    </div>
    <div class="col-md-4 text-lg-right">

      <a href="#" class="btn box-shadow padding-lr-30px  padding-tb-10px btn-sm border-2 border-radius-30 btn-inline-block background-main-color text-white margin-right-20px margin-tb-12px"><i class="fab fa-google-play"></i> Google Play</a>

      <a href="#" class="btn box-shadow padding-lr-30px  padding-tb-10px btn-sm border-2 border-radius-30 btn-inline-block background-dark text-white margin-tb-12px"><i class="fab fa-apple"></i>  App Store</a>

    </div>
  </div>
</div>
</section>

<!-- <div class="instgram-feed">
<div class="row no-gutters">
  <div class="col-md-2 col-6">
    <a href="#"><img src="http://placehold.it/600x600" alt></a>
  </div>
  <div class="col-md-2 col-6">
    <a href="#"><img src="http://placehold.it/600x600" alt></a>
  </div>
  <div class="col-md-2 col-6">
    <a href="#"><img src="http://placehold.it/600x600" alt></a>
  </div>
  <div class="col-md-2 col-6">
    <a href="#"><img src="http://placehold.it/600x600" alt></a>
  </div>
  <div class="col-md-2 col-6">
    <a href="#"><img src="http://placehold.it/600x600" alt></a>
  </div>
  <div class="col-md-2 col-6">
    <a href="#"><img src="http://placehold.it/600x600" alt></a>
  </div>
</div>
</div> -->

@endsection


<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
  $("#search-categories").keyup(function(){
    var data;
    var categories = $(this).val();
    if(categories != ''){
      var _token = $('input[name="_token"]').val();
      $.ajax({
        url: "{{ route('search-categories') }}",
        method: "POST",
        data:{categories:categories, _token:_token},
        success: function(data){
          $('#list-categories').fadeIn();
          $('#list-categories').html(data);
        }
      });
    }else{
      $('#list-categories').fadeOut();
      $('#list-categories').html(data);
    }
  });

  $(document).on('click', '#find-categories', function(){
    $('#search-categories').val($(this).text());
    $('#list-categories').fadeOut();
  });
});
</script>
