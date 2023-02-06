<?php ob_start(); ?>
<?php session_start(); ?>
<?php require './inc/db.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">



  <title>Administration | Login</title>

  <!-- vendor css -->
  <link href="assets/lib/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
  <link href="assets/lib/ionicons/css/ionicons.min.css" rel="stylesheet">

  <!-- Bracket CSS -->
  <link rel="stylesheet" href="assets/css/bracket.css">
</head>

<body>

  <div class="d-flex align-items-center justify-content-center bg-br-primary ht-100v">

    <div class="login-wrapper wd-300 wd-xs-350 pd-25 pd-xs-40 bg-white rounded shadow-base">
      <div class="signin-logo tx-center tx-28 tx-bold tx-inverse"><span class="tx-normal"></span> One <span class="tx-info">Blog</span> <br> <span class="tx-normal">Please Log in.</span></div>
      <div class="tx-center mg-b-60"></div>
      
      <!-- login form -->
      <form action="" method="POST">
        <div class="form-group">
          <!-- userName or email address -->
          <input name="email" type="text" class="form-control" placeholder="Enter your username">
        </div><!-- form-group -->
        <div class="form-group">
          <!-- user password -->
          <input name="password" type="password" class="form-control" placeholder="Enter your password">
          <!-- forget password -->
          <a href="" class="tx-info tx-12 d-block mg-t-10">Forgot password?</a>
        </div><!-- form-group -->
        <!-- submit -->
        <input type="submit" class="btn btn-info btn-block" value="Sign in" name="login" />
      </form>

      <?php
      if (isset($_POST['login'])) {
        $email      = mysqli_real_escape_string($db, $_POST['email']);
        $password   = mysqli_real_escape_string($db, $_POST['password']);
        $hassedPass = sha1($password);

        // check the email is valid or not 
        $loginSql = "SELECT * FROM users where email = '$email'";
        $authUser = mysqli_query($db, $loginSql);
        $countUser = mysqli_num_rows($authUser);

        if ($countUser == 0) {
          echo "User does not exists!";
          // display login error 
        } else {
          while ($row = mysqli_fetch_array($authUser)) {
            $_SESSION['id']          =  $row['id'];
            $_SESSION['email']       =  $row['email'];
            $userPassword            =  $row['password'];
            $_SESSION['role']        =  $row['role'];
            $_SESSION['status']      =  $row['status'];

            // email and password checking 
            // 1 for active
            // 0 for inactive

            if ($_SESSION['status'] == '1' && $_SESSION['role'] != '3') {
              if ($_SESSION['email'] == $email && $userPassword == $hassedPass) {
                echo "Log successful";
                header("Location:dashboard.php");
              }
               else if ($_SESSION['email'] != $email || $userPassword != $hassedPass) {
                session_unset();
                session_destroy();
                header("Location:index.php");
                echo "Credential error";
              } else {
                session_unset();
                session_destroy();
                header("Location:index.php");
                // echo "Credential error";
              }
            } else if ($_SESSION['status'] == '1' && $_SESSION['role'] == '3') {
              session_unset();
              session_destroy();
             // header("Location:index.php");
             echo "Subscriber cant't access in admin area.";
            } else if ($_SESSION['status'] == '0' ) {
              echo "User not active";
            }
             else {
              echo "Not Recognize";
            }
          }
        }
      }
      ?>
   
   
      <div class="mg-t-60 tx-center">Not yet a member? <a href="register.php" class="tx-info">Sign Up</a></div>
    </div><!-- login-wrapper -->
  </div><!-- d-flex -->





  <script src="./assets/lib/jquery/jquery.min.js"></script>
  <script src="./assets/lib/jquery-ui/ui/widgets/datepicker.js"></script>
  <script src="./assets/lib/bootstrap/js/bootstrap.bundle.min.js"></script>

  <?php ob_end_flush(); ?>
</body>

</html>