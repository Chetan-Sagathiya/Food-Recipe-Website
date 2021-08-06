<!DOCTYPE html>
<html>
<head>
    <title>Laravel 8|7 Datatables Tutorial</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <link href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-eMNCOe7tC1doHpGoWe/6oMVemdAVTMs2xqW4mwXrXsW0L84Iytr2wi5v2QjrP/xp" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.min.js" integrity="sha384-cn7l7gDp0eyniUwwAZgrzD06kc/tftFf19TOAs2zVinnD/C7E91j9yyk5//jjpt/" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap5.min.js"></script>

</head>
<body>
  <div class="container">
      <h1>Admin Panel</h1>
      @if(Session::get('success'))
        <div class="alert alert-success">
          {{ Session::get('success') }}
        </div>
      @endif
      @if(Session::get('fail'))
        <div class="alert alert-danger">
          {{ Session::get('fail') }}
        </div>
      @endif
      <table class="table table-bordered data-table">
          <thead>
              <tr>
                  <th>No</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th> Is Verified </th>
                  <th> Gift </th>
              </tr>
          </thead>
          <tbody>
          </tbody>
      </table>
      <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLongTitle">Gift User</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form method="POST" action="{{ route('send-gift') }}">
                @csrf
                <select name="gift_name" class="form-select form-control">
                  @foreach($gifts as $gift)
                  <option>{{$gift->name}}</option>
                  @endforeach
                </select>
                <input type="number" class="form-control mt-2" name="quantity"
                  minimum=1 placeholder="enter quantity">
                </div>
                <input type="hidden" value="" name="id">
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Send Gift</button>
              </div>
          </form>
          </div>
        </div>
</div>
  </div>

</body>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>

<script type="text/javascript">
  $(function () {

    var table = $('.data-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('display-users') }}",
        columns: [
            {data: 'id', name: 'id'},
            {data: 'name', name: 'name'},
            {data: 'email', name: 'email'},
            {data: 'is_verified', name:"is_verified"},
            {data:'gift', name:'gift'}
        ]
    });

  });
  function checkBoxEvent(id){
    var element = document.getElementById(id);
    var status='unchecked';
    if(element.checked){
      status = "checked"
    }
    console.log(status, element.id);
    $.ajax({
      url: "{{ route('update-isactive') }}",
      type:'POST',
      data: {id:element.id, _token:"{{ csrf_token()  }}", status:status},
      success:function(data){
        if(data.checked){
          alert('User Verified');
        }else{
          alert('User Unverified');
        }
      }
    });
  }

  function giftUser(id){
    console.log(id);
    var id=id;
    $('input[name="id"]').attr('value',id);
  }
</script>

</html>
