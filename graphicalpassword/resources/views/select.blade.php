@extends('layouts.app')
@section('content')

<div class="container">
  <div class="row row-12 ">
    <div class="col-md-6 pb-3">
      <strong> <h3>Select five images as your password</h3></strong>
     </div>
     
 <div class="col-md-3 pr-3 pb-3">
      <a  href="/rejected_user"   class="btn btn-danger"  >
        Return back to signup
      </a>
     </div>
     <div class="col-md-1 pr-3 pb-3">
      <a  href="/selection/reset"   class="btn btn-warning"  >
        Reset
      </a>
     </div>
     
     @if ($submit_button=='on')
     <div class="col-md-1 pr-3 pb-3">
      <a  href="{{route('submit.selection',[
        'username' => $username,
      ])}}"   class="btn btn-success"  >
        Submit
     </a>
     </div>
     @else
     <div class="col-md-1 pr-3 pb-3">
      <a  href="#"   class="btn btn-light"  >
        Submit
     </a>
     </div>
     @endif
     
  
    
</div>
    <div class="row row-cols-6 pt-3">
      <?php 
      foreach ($users as $key => $user) { 
        ?>


@if ($submit_button=='on')
<div class="col pb-5">
  
  <a href="#" 
  ><img  @if (($user->selected_image)=='1')
    style=" border: 5px solid#4863A0; width:100px ;height:100px;"
  @else
  style="  width:100px ;height:100px;"   
  @endif  src="/images/<?php echo $user->img ?>" alt="" srcset=""></a>
 
</div>
@else
<div class="col pb-5">
  
  <a href="{{route('newuser.store_user',
  [
  'username' => $username,
  'email' => $email,
  'address' => $address,
  'city' => $city,
  'contact_num' => $contact_num,
  'img'=>$user->img
  ])
  }}" 
  ><img  @if (($user->selected_image)=='1')
    style=" border: 5px solid#4863A0; width:100px ;height:100px;"
  @else
  style="  width:100px ;height:100px;"   
  @endif  src="/images/<?php echo $user->img ?>" alt="" srcset=""></a>
 
</div>
@endif









<?php 
} 
?>
        
        
      
    </div>
  </div>

@endsection
@section('scripts')
<script>

  //   $(document).ready(function () {
  //     $(document).on('click','.img', function (e) {
  //         e.preventDefault();
  //         var data={
  //           'img': $(".img:eq(2)").attr('src'),
  //         }
  //         console.log(data);
  //         $.ajaxSetup({
  //       headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') }
  //   });
  //         $.ajax({
  //           type: "POST",
  //           url: "/password_checks",
  //           data:data,
  //           dataType: "json",
  //           success: function (response) {
  //             console.log(response);
  //           }
  //         });
          
  //     });
  // });
</script>
    
@endsection