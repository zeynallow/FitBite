<!-- Modal -->
<div class="modal fade" id="loginModal" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Login</h4>
      </div>
      <div class="modal-body">
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
      </div>
      <div class="modal-footer">
        <p>Hesabınız yoxdursa, <a href="#" data-toggle="modal" data-backdrop="true" class="registerModal bold-href" data-target="#registerModal">Qeydiyyatdan keçin</a></p>
        <p><a href="#" class="bold-href">Şifrəni unutmusunuz?</a></p>
      </div>
    </div>
  </div>
</div>


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
