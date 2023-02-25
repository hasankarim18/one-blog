<?php
    $host         = "localhost";
    $dbName       = "one_blog";
    $dbUser       = "root";
    $dbPass       = "";   
    $db = mysqli_connect($host, $dbUser,$dbPass,$dbName);

    if($db){
       // echo 'database connection ok';
    }

if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}
?>