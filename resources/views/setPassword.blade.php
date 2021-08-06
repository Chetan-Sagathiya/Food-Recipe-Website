@extends('layouts')
@section('content')
<div class="container">
<div class="row">
  <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
    <div class="card border-0 shadow rounded-3 my-5">
      <div class="card-body p-4 p-sm-5">
        <h5 class="card-title text-center mb-5 fw-light fs-5">Set Password</h5>
            <form action="/post-setPassword/{{ $user->id }}" method="POST">
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
              <label> Password </label>
              <div class="form-floating mb-3">
                <input type="password" class="form-control" name="password">
              </div>
              <span> @error('password') {{ $message }} @enderror </span>
              <label> Confirm Password </label>
              <div class="form-floating mb-3">
                <input type="password" class="form-control" name="confirm-password">
                <span> @error('confirm-password') {{ $message }} @enderror </span>
              </div>
              <div class="d-grid">
                <center>
                <button class="btn btn-primary btn-login text-uppercase fw-bold" type="submit">
                Set Password</button> </center>
              </div> </br>
            </form>
          </div>
        </div>
      </div>
    </div>
</div>
@endsection
