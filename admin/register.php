<?php ob_start(); ?>
<?php session_start(); ?>
<?php require 'inc/db.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">



    <!-- Meta -->
    <meta name="description" content="Premium Quality and Responsive UI for Dashboard.">
    <meta name="author" content="ThemePixels">

    <title>One Blog-register</title>

    <!-- vendor css -->
    <link href="assets/lib/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="assets/lib/ionicons/css/ionicons.min.css" rel="stylesheet">
    <link href="assets/lib/select2/css/select2.min.css" rel="stylesheet">

    <!-- Bracket CSS -->
    <link rel="stylesheet" href="assets/css/bracket.css">
</head>

<body>

    

    <div class="d-flex align-items-center justify-content-center bg-br-primary ht-100v">

        <div class="login-wrapper wd-300 wd-xs-400 pd-25 pd-xs-40 bg-white rounded shadow-base">

            <div class="signin-logo tx-center tx-28 tx-bold tx-inverse"><span class="tx-normal"></span> One <span
                    class="tx-info">Blog</span> <br> <span class="tx-normal"></span></div>
            <div class="tx-center mg-b-40">Please Sign Up!</div>
             <?php  
           $error_message = null;
              if(isset($_POST['sign_up'])){   

                $name              = mysqli_real_escape_string($db, $_POST['user_name']);
                $email             = mysqli_real_escape_string($db, $_POST['user_email']);
                $phone             = mysqli_real_escape_string($db, $_POST['user_phone']);
                $address           = mysqli_real_escape_string($db, $_POST['user_address']);
                // image 
                $imageName         = $_FILES["user_image"]['name'];
                $password          = mysqli_real_escape_string($db, $_POST['user_password']);
                $confirmPassword   = mysqli_real_escape_string($db, $_POST['user_confirm_pass']);
              
                $img = '/image/';
                $role              = 3;
                $status            = 1;

                

               // echo $sql;

                if(!empty($name) && !empty($email)){
                  if($password === $confirmPassword){
                    
                  if ($imageName) {

                    $imageSize         = $_FILES['user_image']['size'];
                    $imageType         = $_FILES['user_image']['type'];

                    $image_extension   = strtolower(end(explode('.', $imageName)));
                    $allowe_extension  = array("jpg", "jpeg", "png");

                    // move the image into the server temporary folder 
                    $image_tmp = $_FILES['user_image']['tmp_name'];

                    if (in_array($image_extension, $allowe_extension) === false) {
                        $error_message = "Your uploaded file is not an image";
                    }

                    if ($imageSize > 1048574) {
                        $error_message = "Your uploaded file is too large. Max size 1 MB";
                    }


                    if (empty($error)) {                    
                        $img =  date('Y-m-d') . '-' . $imageName;
                         $hassedPass = sha1($password);

                        $sql = "INSERT INTO `users`( `name`, `email`, `password`, `phone`, `address`, `role`, `status`, `join_date`,`image`) VALUES ('$name','$email','$hassedPass','$phone','$address','$role','$status',now(), '$img')";
                    // adduser                  
                        $addUser = mysqli_query($db, $sql);

                         $addUser = mysqli_query($db, $sql);

                        move_uploaded_file($image_tmp, "assets/images/" . $img);

                         if ($addUser) {
                             header("Location:dashboard.php");
                         };
                    }
                }

                    
                  }else {
                    echo "Password didnt match";
                  }
                }else {
                  $error_message = 'Name and email cant be empty';
                }
                  

                }


            ?>
            <!-- name -->
            <?php  echo $error_message; ?>
            <form enctype="multipart/form-data" action="" method="POST">
                <div class="form-wrapper">
                    <div class="form-group">
                        <input name="user_name" type="text" class="form-control" placeholder="Enter your name">
                    </div>
                    <!-- email -->
                    <div class="form-group">
                        <input name="user_email" type="email" class="form-control" placeholder="Enter your email">
                    </div>
                    <!-- phone -->
                    <div class="form-group">
                        <input name="user_phone" type="number" class="form-control" placeholder="Enter your phone number">
                    </div>
                    <!-- address -->
                    <div class="form-group">
                        <textarea name="user_address" type="number" class="form-control text-start" placeholder="">
                            Enter your Address. 
                       </textarea>
                    </div>
                    <!-- image -->
                    <div class="form-group">
                        <input name="user_image" type="file"  />
                    </div>
                    <!-- password -->
                    <div class="form-group">
                        <input name="user_password" type="password" class="form-control mb-2" placeholder="Password">
                        <input name="user_confirm_pass" type="password" class="form-control" placeholder="Confirm passwrod">
                    </div><!-- form-group -->

                </div>
                 <div class="form-group tx-12">By clicking the Sign Up button below, you agreed to our privacy policy and
                terms of use of our website.</div>
            <input name="sign_up" type="submit" class="btn btn-info btn-block" placeholder="Sign Up" />
            </form>

            <?php  
            echo '--'. $error_message; echo '<br />';

             if($error_message == null ){
                echo $error_message;
              }
            ?>
            
       

            <div class="mg-t-40 tx-center">Already a member? <a href="index.php" class="tx-info">Sign in</a></div>
        </div><!-- login-wrapper -->

    </div><!-- d-flex -->









    <script src="../lib/jquery/jquery.min.js"></script>
    <script src="../lib/jquery-ui/ui/widgets/datepicker.js"></script>
    <script src="../lib/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../lib/select2/js/select2.min.js"></script>
    <script>
    $(function() {
        'use strict';

        $('.select2').select2({
            minimumResultsForSearch: Infinity
        });
    });
    </script>

</body>
  <?php ob_end_flush(); ?>
</html>