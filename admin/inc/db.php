<?php
    $host         = "localhost";
    $dbName       = "one-blog";
    $dbUser       = "root";
    $dbPass       = "";
   
    $db = mysqli_connect($host, $dbUser,$dbPass,$dbName);

if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}

// if (!$db) {
//     printf("Errormessage: %s\n", mysqli_error($db));
// }
?>