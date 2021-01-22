<?php 
    session_start();

    function check($prefix)
    {
        $condition = mysqli_query($mysqli, "SELECT * FROM urls WHERE");
    }


    if(is_null($_POST['url']))
    {
        header('Location: index.php');
    } else {
        require 'connect.php';
        $long_URL = $_POST['url'];
        echo $long_URL;

        $short_code = substr(sha1(time()), 0, 8);
        echo $short_code;

        $created = date('Y-m-d h:i:sa');

        $query = mysqli_query($mysqli, "INSERT INTO urls VALUES(NULL, '$long_URL', '$short_code', '$created', 0)");

        if($query)
        {
            $_SESSION['short_code'] = $short_code;
            $_SESSION['success'] = true;
            header('Location: index.php');
        }
    }
?>