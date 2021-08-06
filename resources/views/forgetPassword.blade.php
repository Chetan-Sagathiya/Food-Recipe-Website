@extends('layouts')

@section('content')
  this is forget password page
  <div class="container">
  <div class="row">
    <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
      <div class="card border-0 shadow rounded-3 my-5">
        <div class="card-body p-4 p-sm-5">
          <h5 class="card-title text-center mb-5 fw-light fs-5">Log In</h5>
              <form action="{{ route('post-forget-password') }}" method="POST">
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
                <label> Email </label>
                <div class="form-floating mb-3">
                  <input type="email" class="form-control" name="email" placeholder="name@example.com">
                </div>
                <div class="d-grid">
                  <center>
                  <button class="btn btn-primary btn-login text-uppercase fw-bold" type="submit">
                  Forget Password</button> </center>
                </div> </br>
              </form>
            </div>
          </div>
        </div>
      </div>
</div>

@endsection
