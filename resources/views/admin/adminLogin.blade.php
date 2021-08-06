<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Hello, world!</title>
  </head>
  <body>
  <div class="container">
    <div class="row">
      <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
        <div class="card border-0 shadow rounded-3 my-5">
          <div class="card-body p-4 p-sm-5">
            <h5 class="card-title text-center mb-5 fw-light fs-5">Log In</h5>
            <form action="{{ route('post-admin-login') }}", method="POST">
              @if(Session::get('fail'))
                <div class="alert alert-danger">
                  {{ Session::get('fail') }}
                </div>
              @endif
              @csrf
              <labe> Email </label>
              <div class="form-floating mb-3">
                <input type="email" class="form-control" name="email" placeholder="name@example.com">
              </div>
              @error('email')
                <div class="alert alert-danger">{{ $message }} </div>
              @enderror
              <label> Password </label>
              <div class="form-floating mb-3">
                <input type="password" class="form-control" name="password" placeholder="Password">
              </div>
              @error('password')
                <div class="alert alert-danger">{{ $message }} </div>
              @enderror
              <div class="form-check mb-3">
                <center>
                    <input class="form-check-input" type="checkbox" value="" id="rememberPasswordCheck">
                    <label class="form-check-label" for="rememberPasswordCheck">
                      Remember password
                    </label> </center>
              </div>
              <div class="d-grid">
                <center>
                <button class="btn btn-primary btn-login text-uppercase fw-bold" type="submit">Sign
                  in</button> </center>
              </div> </br>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  </body>
</html>
