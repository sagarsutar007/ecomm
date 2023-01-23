
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Change Password</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= ASSETSURL; ?>adminlte/plugins/fontawesome-free/css/all.css">
  <link rel="stylesheet" href="<?= ASSETSURL; ?>adminlte/plugins/fontawesome-free/css/sharp-solid.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?= ASSETSURL; ?>adminlte/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= ASSETSURL; ?>adminlte/css/adminlte.min.css">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <?php if(isset($record)){ ?>
  <!-- /.login-logo -->
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="<?= base_url(); ?>" class="h1">
        <?php 
          if( isset($record['logo']) && file_exists("assets/web/images/brand-logo/". $record['logo'])){
            $brand = base_url("assets/web/images/brand-logo/" . $record['logo']);
          } else {
            $brand = PROVIDERLOGO;
          }
        ?>
        <img src="<?= $brand; ?>" width="100px" alt="Brand Logo">
      </a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Chnage your password!</p>
      <form action="" method="post" id="change-password-form">
        <input type="hidden" name="authtoken" value="<?= $_GET['token']??''; ?>">
        <div class="input-group mb-3">
          <input type="password" class="form-control" name="password" placeholder="Password" id="input-password" autofocus>
          <div class="input-group-append">
            <div class="input-group-text" id="toggle-password">
              <span class="fa-sharp fa-solid fa-eye"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" name="confirm_password" placeholder="Confirm Password" id="input-cpassword">
          <div class="input-group-append">
            <div class="input-group-text" id="toggle-cpassword">
              <span class="fa-sharp fa-solid fa-eye"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block">Change Password</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
      <div class="text-center my-3">
        - OR -
      </div>
      <p class="mb-1 text-center">
        <a href="<?= base_url('dashboard/login'); ?>">Login Here!</a>
      </p>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
  <?php } else { ?>
    <p class="text-muted text-center">ERROR 400</p>
    <div class="h3 text-center text-dark">No Store found!</div>
  <?php } ?>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="<?= ASSETSURL; ?>adminlte/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?= ASSETSURL; ?>adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?= ASSETSURL; ?>adminlte/js/adminlte.min.js"></script> 
<script>
    $(function() {
        $(document).on('click', '.input-group-text', function(event) {
            if ($(this).find('span').hasClass('fa-eye')) {
                $(this).find('span').removeClass('fa-eye').addClass('fa-eye-slash');
                $(this).closest(".input-group").find('[type="password"]').attr('type','text');
            } else {
                $(this).find('span').removeClass('fa-eye-slash').addClass('fa-eye');
                $(this).closest(".input-group").find('[type="text"]').attr('type','password');
            }
        });

        $("#change-password-form").on("submit", function(e){
            var password = $("#input-password").val();
            var cpassword = $("#input-cpassword").val();
            if(password != cpassword){
              e.preventDefault();
              alert("Please match password!");
            } 
        });
    });
</script> 
</body>
</html>
