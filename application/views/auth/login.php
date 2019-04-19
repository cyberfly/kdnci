<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../../../favicon.ico">

    <title>Signin Template for Bootstrap</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.0/examples/sign-in/">

    <!-- Bootstrap core CSS -->
    <link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Custom styles for this template -->
    <link href="<?php echo base_url(); ?>assets/css/signin.css" rel="stylesheet" />
</head>
<body class="text-center">
<form class="form-signin" action="<?php echo site_url('auth/login'); ?>" method="post" >
  <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
  <label for="inputEmail" class="sr-only">Email address</label>
  <input type="text" name="identity" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
  <label for="inputPassword" class="sr-only">Password</label>
  <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required>
  <div class="checkbox mb-3">
    <label>
      <input type="checkbox" value="remember-me"> Remember me
    </label>
  </div>
  <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
  <p class="mt-5 mb-3 text-muted">&copy; 2019</p>
</form>
</body>
</html>
<!--load Jquery-->
<script src="<?php echo base_url(); ?>assets/js/jquery-3.4.0.min.js"></script>
<!--load Sweet Alert-->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
<script>

    $(document).ready(function(){

        <?php

            if(isset($announcement)) {

        ?>
            // load JS here

            Swal.fire(
                '<?php echo $announcement->title; ?>',
                '<?php echo $announcement->description; ?>',
                'question'
            );

        <?php } ?>

    }); // end of document ready

</script>