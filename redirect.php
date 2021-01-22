<?php 
    session_start();

    require('connect.php');

    $short_code = $_GET['c'];

    $query = mysqli_query($mysqli, "SELECT * FROM urls WHERE short_code = '$short_code'");
    $result = mysqli_fetch_array($query);
    $orginal = $result['long_url'];
    $used = $result['used'] + 1;

    mysqli_query($mysqli, "UPDATE urls SET used='$used' WHERE short_code = '$short_code'");
    header('Location: '.$orginal);
?>