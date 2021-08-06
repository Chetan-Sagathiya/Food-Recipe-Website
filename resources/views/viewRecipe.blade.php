@extends('layouts')

@section('content')
<div id="page-title" class="padding-tb-30px gradient-white">
  <div class="container text-left">
    <ol class="breadcrumb opacity-5">
      <li><a href="#">Home</a></li>
      <li class="active">Recipe</li>
    </ol>
    <h1 class="font-weight-300">{{ $recipe->name }}</h1>
  </div>
</div>
<div class="container">
		<div class="row">

			<div class="col-lg-8">
				<div class="margin-bottom-40px card border-0 box-shadow">
					<div class="card-img-top"><a href="#"><img src="{{ asset('images/'. $recipe->image) }}" alt="" height="400px" width="700px"></a></div>
					<div class="padding-lr-30px padding-tb-20px">
						<h5 class="margin-bottom-20px margin-top-10px"><a class="text-dark" href="#">{{ $recipe->name }}</a></h5>
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
            {!! $recipe->description !!}
            <hr>
            <form>
              @csrf
  						<div class="row no-gutters">
  							<div class="col-4 text-left text-red">
                  @if(in_array($recipe->id, $favorite))
                    <i class="fas fa-heart save"></i> Saved
                  @else
                    <i class="far fa-heart save"></i> Save
                  @endif
                </div>
  							<div class="col-8 text-right"><a href="#" class="text-grey-2"><i class="fas fa-users"></i> 6-8 servings</a></div>
  						</div>
            </form>
					</div>
					<div class="background-light-grey border-top-1 border-grey padding-lr-30px padding-tb-20px">
						<a href="#" class="d-inline-block text-grey-3 h6 margin-bottom-0px margin-right-15px"><img src="http://placehold.it/50x50" class="height-30px border-radius-30 margin-right-15px" alt=""> Salim Aldosery</a>
					</div>
				</div>

				<div class="margin-bottom-40px box-shadow">
					<div class="padding-30px background-white">
						<h3><i class="far fa-star margin-right-10px text-main-color"></i> Review &amp; Rating</h3>
						<hr>
						<ul class="commentlist padding-0px margin-0px list-unstyled text-grey-3">
              @foreach($recipe->review as $review)
  							<li class="border-bottom-1 border-grey-1 margin-bottom-20px">
  								<img src="http://placehold.it/60x60" class="float-left margin-right-20px border-radius-60 margin-bottom-20px" alt="">
  								<div class="margin-left-85px">
  									<a class="d-inline-block text-dark text-medium margin-right-20px" href="#"></a>
  									<span class="text-extra-small">Date :{{ $review->updated_at }}</span>
  									<div class="rating">
  										<ul>
                       @for ($i = 1; $i <= $review->ratings; $i++)
                           <li class="active"></li>
                       @endfor
  										</ul>
  									</div>
  									<p class="margin-top-15px text-grey-2">{{ $review->review_detail }} </p>
  								</div>
  							</li>
               @endforeach
						</ul>
					</div>
				</div>
        @if(Session::get('LoggedUser') == $recipe->user_id)
        @else
        <div class="margin-bottom-80px box-shadow">
					<div class="padding-30px background-white">
						<h3><i class="far fa-star margin-right-10px text-main-color"></i> Add Review </h3>
						<hr>
            <div class="alert alert-block" style="display: none;">
                <button type="button" class="close" data-dismiss="alert">×</button>
                  <strong class="success-msg"></strong>
            </div>
						<form>
              @csrf
							<div class="form-group">
								<label for="comment">Comment :</label>
								<textarea class="form-control" id="comment" name="review_detail" rows="3" placeholder="Comment"></textarea>
							</div>
              @error('review_detail')
              <div class="alert alert-danger">{{ $message }} </div>
              @enderror
              <div class="form-group label-floating">
    						<label class="control-label">Ratings: </label>
    						<input class="form-control" placeholder="Review Out Of 5" type="number"
                max=5 min=1 name="rating" id="rating">
    					</div>
              <button type="submit" class="btn btn-success full-width btn-comment">Add Comment! </button>
						</form>
					</div>
				</div>
        @endif
			</div>
		</div>
	</div>
@endsection
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript">
  $(document).ready(function() {
    $(".btn-comment").click(function(e){
      $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
        }
      });

      e.preventDefault();

      var recipe = {!! json_encode($recipe->toArray()) !!};
      var user_id = {!! json_encode(Session::get('LoggedUser')) !!}
      var _token = $("input[name='_token']").val();
      var comment = $("#comment").val();
      var ratings = $("#rating").val();
      var recipe_id = recipe.id;

      $.ajax({
          url: "{{ route('ajax.comment.store') }}",
          type:'POST',
          data: {_token:_token, review_detail:comment, recipe_id:recipe_id, ratings:ratings,
                user_id:user_id },
          success: function(data) {
              printMsg(data);
          }
      });
      function printMsg (msg) {
        if($.isEmptyObject(msg.error)){
            console.log(msg.success, msg);
            $('.alert-block').css('display','block').append('<strong>'+msg.success+'</strong>').addClass("alert-success");
            $('.alert-block').delay(2000).fadeOut('slow');
        }else{
          $('.alert-block').css('display','block', 'class', 'alert-danger').append('<strong>'+msg.error+'</strong>').addClass("alert-danger");
          $('.alert-block').delay(2000).fadeOut('slow');
        }
      }
      $('.alert-block').empty();
    });

    $(".save").click(function(e){
      $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
        }
      });
      e.preventDefault();

      var _token = $("input[name='_token']").val();
      var class_name = "has";
      var user_id = {!! json_encode(Session::get('LoggedUser')) !!}
      var recipe = {!! json_encode($recipe->toArray()) !!};
      var recipe_id = recipe.id;

      if($(this).hasClass("far")){
        $(this).removeClass('far');
        $(this).addClass('fas');
        class_name="has";
      }else{
        $(this).removeClass('fas');
        $(this).addClass('far');
        class_name="far";
      }

      $.ajax({
          url: "{{ route('favorite.recipe') }}",
          type:'POST',
          data: {_token:_token, class:class_name, user_id:user_id,
                recipe_id:recipe_id},
          success: function(data) {
              printMsg(data);
          }
      });
      function printMsg (msg) {
        if($.isEmptyObject(msg.error)){
          alert(msg.success);
        }else{
          alert(msg.error);
        }
      }
    });
  });
</script>
