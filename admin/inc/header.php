
<?php ob_start();
    session_start();
    include 'inc/db.php'; 

   
if(empty($_SESSION['email']) && empty($_SESSION['id'])){
    header("Location:index.php");
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Meta -->
    <meta name="description" content="Premium Quality and Responsive UI for Dashboard.">
    <meta name="author" content="ThemePixels">

    <title>One Blog-Dashboard</title>

    <!-- vendor css -->


    <link href="assets/lib/ionicons/css/ionicons.min.css" rel="stylesheet">
    <link href="assets/lib/rickshaw/rickshaw.min.css" rel="stylesheet">
    <link href="assets/lib/select2/css/select2.min.css" rel="stylesheet">



    <!-- Bracket CSS -->
    <link rel="stylesheet" href="./assets/css/bracket.css">
    <link rel="stylesheet" href="./lib/style.css">

    <script src="https://kit.fontawesome.com/1090098403.js" crossorigin="anonymous"></script>
</head>

<body>
    <?php  include  'inc/menubar.php'; ?>
    <?php  include 'inc/topbar.php'; ?>
    <div class="br-mainpanel">