@extends('layouts.app')
@section('content')

<div class="container">
  
  <div class="col-12 ">
    <div class="row-md-6 pb-3">
      <strong> <h3>Select five images to login</h3></strong>
     </div>
     
 <!--<div class="row-md-6 pr-3 pb-3">-->
 <!--     <a  href="/logout"   class="btn btn-danger"  >-->
 <!--       Sign out-->
 <!--     </a>-->
 <!--    </div>-->
    
</div>

    <div class="row row-cols-6 pt-3">
      <?php 
      foreach ($users as $key => $user) { 
        ?>
<div class="col pb-5">
  
    <a href="{{route('password_checks.store',['username'=>$username,'img'=>$user->img])}}" ><img  @if (($user->selected_image)=='1')
      style=" border: 5px solid#4863A0; width:100px ;height:100px;"
    @else
    style="  width:100px ;height:100px;"   
    @endif  src="/images/<?php echo $user->img ?>" alt="" srcset=""></a>
   
</div>
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