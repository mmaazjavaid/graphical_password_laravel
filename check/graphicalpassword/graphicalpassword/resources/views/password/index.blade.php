@extends('layouts.app')
@section('content') --}}

{{-- <div class="row-md-6">
  <h1 style="color: brown;">
   <?php 
  // if(isset($message)){
  //   echo $message;
  // } 
  ?> 
  </h1>
</div>
<div class="py-5 container container-fluid d-flex justify-content-center">
  <div class=" col-4">
    <div class=" row-4">
      <h1>Graphical password</h1>
    </div>
    <div class="row-4 d-flex justify-content-center"> --}}
    <!--  <div class="row-4 ">-->
    <!--      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#login_modal">-->
    <!--        Login-->
    <!--      </button>-->
    <!--      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">-->
    <!--        Register-->
    <!--      </button>-->
    <!--</div>-->
    
    {{-- <div class="row-sm-4 px-2">
          <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#login_modal">
            Login
          </button>
          
    </div>
    <div class="row-sm-4 ">
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Register
          </button>
    </div>
    
  </div>
</div>
</div> --}}


{{-- 
<div class="modal fade" id="login_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-info">
        <h5 class="modal-title text-white" id="exampleModalLabel">Login</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="/passwords/show" method="get" enctype="multipart/form-data" >
          @csrf
          <div class="form-group mb-3">
            <label for="">User name</label>
            <input type="text" class="username" name="username" required>
        </div>
      <div class="modal-footer">
        
        <button type="submit" class="btn btn-primary">Login</button>
         <a href="/forget"><button type="button" class="btn btn-warning"  >forgotpassword?</button></a>
         <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
        </form>
        
      </div>
     
    </div>
  </div>
</div> --}}




  <!-- Modal -->
  {{-- <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-info">
          <h5 class="modal-title text-white" id="exampleModalLabel">Register</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="/select_password" method="post" enctype="multipart/form-data" >
            @csrf
            <div class="form-group mb-3">
              <label for="">User name</label>
              <input type="text" class="username" name="username" required>
          </div>
          <div class="form-group mb-3">
            <label for="">User email</label>
            <input type="text" class="email" name="email" required>
        </div>
        <div class="form-group mb-3">
          <label  for=""> Address &nbsp;&nbsp;&nbsp;</label>
          <input type="text" class="address" name="address" required>
      </div>
      <div class="form-group mb-3">
        <label for="">User city &nbsp;&nbsp;</label>
        <input type="text" class="city" name="city" required>
    </div>
    <div class="form-group mb-3">
      <label for="">Contactno</label>
      <input type="text" class="contact" name="contact" required>
  </div> --}}
          {{-- <div class="form-group mb-3">
            <label for="">image 1</label>
            <input type="file" name="img_1" id="img_1" required>
        </div>
        <div class="form-group mb-3">
            <label for="">image 2</label>
            <input type="file" id="img_2" name="img_2" required>
        </div>
        <div class="form-group mb-3">
            <label for="">image 3</label>
            <input type="file" id="img_3" name="img_3" required>
        </div>
        <div class="form-group mb-3">
            <label for="">image 4</label>
            <input type="file" class="img_4" name="img_4" required>
        </div>
        <div class="form-group mb-3">
            <label for="">image 5</label>
            <input type="file" class="img_5" name="img_5" required>
        </div> --}}
        {{-- <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
          </form>
          
        </div>
       
      </div>
    </div>
  </div>
{{-- @endsection
@section('scripts')
<script>
  $(document).ready(function () {
      $(document).on('click','.add_user', function (e) {
          e.preventDefault();
          var data={
            'username':$('.username').val(),
            'img_1':$('.image_1').val(),
            'img_2':$('.image_2').val(),
            'img_3':$('.image_3').val(),
            'img_4':$('.image_4').val(),
            'img_5':$('.image_5').val(),
          }
          console.log(data);
          $.ajaxSetup({
        headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') }
    });
          $.ajax({
            type: "POST",
            url: "/passwords",
            data:data,
            dataType: "json",
            success: function (response) {
              console.log(response.message);
            }
          });
          
      });
  });
</script>
@endsection--}}


