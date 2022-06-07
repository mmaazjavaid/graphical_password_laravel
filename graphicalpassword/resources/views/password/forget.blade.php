{{-- @extends('layouts.app')
@section('content')


<form action="{{route('forgot_pass.user')}}" method="">
    <div class="py-3 form-group">
      <label for="exampleInputEmail1">Email</label>
      <input style="width: 20%"  class="form-control" 
      type="email" class="email" name="email" required>
    </div>    
    <button type="submit" class="btn btn-primary">proceed</button>
  </form>

        
        
      
   

@endsection --}}



<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Graphical password </title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="../../vendors/feather/feather.css">
  <link rel="stylesheet" href="../../vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="../../vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="../../vendors/typicons/typicons.css">
  <link rel="stylesheet" href="../../vendors/simple-line-icons/css/simple-line-icons.css">
  <link rel="stylesheet" href="../../vendors/css/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="../../css/vertical-layout-light/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="../../images/favicon.png" />
</head>

<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left py-5 px-4 px-sm-5">
              <div  class="brand-logo d-flex justify-content-center">
                <h3 >Novel graphical password</h3>
              </div>
              <h4>Forget password...? </h4>
              <h6 class="fw-light">Enter your email to continue.</h6>
              <form method="" action="{{route('forgot_pass.user')}}" class="pt-3">
                @csrf
                <div class="form-group">
                  
                  <input  type="email" placeholder="xyz@example.com"  name="email" required  id="email"  class="form-control form-control-lg @error('username') is-invalid @enderror"  autocomplete="email" autofocus>

                            
                </div>
                <div class="my-2 d-flex justify-content-between align-items-center">
                  
                  <div class="mt-3">
                    <button type="submit" class="btn btn-primary">Proceed</button>
                  </div>
                  
                </div>
                
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- plugins:js -->
  <script src="../../vendors/js/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <script src="../../vendors/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="../../js/off-canvas.js"></script>
  <script src="../../js/hoverable-collapse.js"></script>
  <script src="../../js/template.js"></script>
  <script src="../../js/settings.js"></script>
  <script src="../../js/todolist.js"></script>
  <!-- endinject -->
</body>

</html>
