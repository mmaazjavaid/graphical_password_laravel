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
              <div class="brand-logo d-flex justify-content-center">
               <h3 >Novel graphical password</h3>
              </div>
              <h4>Hello! let's get started</h4>
              <h6 class="fw-light">register to continue.</h6>
              <form method="POST" action="/select_password" class="pt-3" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <strong class="text-warning">*{{ $message }}</strong>
                  <input placeholder="username" id="username" type="text" class="form-control form-control-lg "
                   name="username" value="{{$username}}" required autocomplete="name" autofocus>

                               
                                    
                                        
                               
                </div>
                <div class="form-group">
                  
                    <input placeholder="user email" id="email" type="email" class="form-control form-control-lg @error('email') is-invalid @enderror"
                     name="email" value="{{$email}}" required autocomplete="email">

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                  
                    <input placeholder="Address" id="address" type="text" class="form-control form-control-lg @error('email') is-invalid @enderror"
                     name="address" value="{{$address}}" required autocomplete="address">

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                
                <div class="form-group">
                  
                    <input placeholder="Phone" id="contact" type="tel" class="form-control form-control-lg @error('email') is-invalid @enderror"
                     name="contact" value="{{$contact_num}}" required autocomplete="contact">

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
               
                <div class="form-group">
                  <label for="city"><h4>Choose a city: &nbsp;&nbsp;</h4></label>
                  <select class="text-dark"  placeholder="City" id="city" type="text" 
                   
                   name="city"   required autocomplete="city" >
                    <option value="Abudhabi">Abudhabi</option>
                    <option value="Dubai">Dubai</option>
                    <option value="Sharjah">Sharjah</option>
                    <option value="Ajman">Ajman</option>
                    <option value="Fujairah">Fujairah</option>
                    <option value="Ras al khaimah">Ras al khaimah</option>
                    <option value="Umm al Quwain">Umm al Quwain</option>
                  </select>      
              </div>
              
                
                <div class="mt-3">
                  <button type="submit" class="btn btn-primary">Register</button>
                </div>
                {{-- <div class="my-2 d-flex justify-content-between align-items-center">
                  <div class="form-check">
                    <label class="form-check-label text-muted">
                      <input type="checkbox" class="form-check-input">
                      Keep me signed in
                    </label>
                  </div>
                  <a href="#" class="auth-link text-black">Forgot password?</a>
                </div>
                <div class="mb-2">
                  <button type="button" class="btn btn-block btn-facebook auth-form-btn">
                    <i class="ti-facebook me-2"></i>Connect using facebook
                  </button>
                </div> --}}
                <div class="text-center mt-4 fw-light">
                  already have an account? <a href="/" class="text-primary">login</a>
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
