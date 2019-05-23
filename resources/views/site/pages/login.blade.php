@extends('site.app')

@section('content')

  <section class="banner sample-menu-banner">
    <div class="bannerwrap">
      <figure><img src="/images/sample-menu-banner.jpg" alt="Sample menu banner" /></figure>
      <div class="banner-text text-center banner-text-page">
        <h1>Login</h1>
      </div>
    </div>
  </section>

  <main>
    <section class="block">

      <div id="loginResponse"></div>

      <form id="loginForm" role="form" class="s-submit" style="width: 70%; margin: 0 auto;">
        <div class="form-group">
          <label>E-mail<span>*</span></label>
          <input placeholder="" class="form-control" type="text" name="email">
        </div>

        <div class="form-group">
          <label>Password <span>*</span></label>
          <input type="password" class="form-control" name="password" placeholder="">
        </div>

        <div class="form-group">
          <button type="submit" style="margin:0;"  class="btn btn-sm btn-primary color-white form-control"><span id="loginLoadResp"></span> Enter</button>
        </div>
      </form>


      <p>Hesabınız yoxdursa, <a href="#" data-toggle="modal" data-backdrop="true" class="registerModal bold-href" data-target="#registerModal">Qeydiyyatdan keçin</a></p>
      <p><a href="#" class="bold-href">Şifrəni unutmusunuz?</a></p>

      </section>
    </main>


  @endsection


  @push('js')
    <script type="text/javascript">
    $(document).ready(function(){

      $("#loginForm").submit(function(){

        $("#loginResponse").empty();
        $("#loginLoadResp").html('<i class="fas fa-circle-notch fa-spin"></i>');

        $.ajax({
          url:"/login",
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          method:"POST",
          data:$(this).serialize(),
          success: function(response){
            if(response.message == "success"){
              location.reload();
            }else{
              $("#loginResponse").empty().html('<div class="alert alert-danger">'+ response.message +'</div>');
            }
            $("#loginLoadResp").empty();
          },
          error: function(response){
            $("#loginResponse").empty().html('<div class="alert alert-danger">Something went error...</div>');
            $("#loginLoadResp").empty();
          }
        });

        return false;

      });

    });
  </script>
  @endpush
