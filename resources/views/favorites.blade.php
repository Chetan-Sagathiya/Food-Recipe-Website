@extends('layouts')
@section('content')
  <div class="container container-fluid">
    <div class="recipes-masonry">
    @foreach ($favorites->favorite as $favorite)
    <div class="col-xl-3 col-lg-4 col-md-6 recipe-item margin-bottom-40px">
      <div class="card border-0 box-shadow">
        <div class="card-img-top"><a href="/show-recipe/{{ $favorite->recipe->id }}"><img src="{{ asset('images/'. $favorite->recipe->image )}}" alt=""></a></div>
        <div class="padding-lr-30px padding-tb-20px">
          <h5 class="margin-bottom-20px margin-top-10px"><a class="text-dark" href="/show-recipe/{{ $favorite->recipe->id }}">{{ $favorite->recipe->name }}</a></h5>
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
</div>
@endsection
