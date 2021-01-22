<?php 
    session_start();

    if(is_null($_POST['url']))
    {
        header('Location: index.php');
    } else {
        require 'connect.php';
        $long_URL = $_POST['url'];

        if (isset($_POST['my-prefix']) && $_POST['my-prefix'] !== '') {
            $myprefix = $_POST['my-prefix'];
            $condition = mysqli_query($mysqli, "SELECT Id FROM urls WHERE short_code = '$myprefix'");
            $hm = $condition->num_rows;
            if ($hm > 0) {
                $_SESSION['error'] = "This link already exists";
                header('Location: index.php');
            } else {
                $short_code = $myprefix;
            }
        } else {
            $short_code = substr(sha1(time()), 0, 8);

            $correct = false;

            while ($correct != true) {
                $condition = mysqli_query($mysqli, "SELECT * FROM urls WHERE short_code = '$short_code'");
                $hm = $condition->num_rows;
                if ($hm > 0) {
                    $short_code = substr(sha1(time()), 0, 8);
                    $correct = false;
                } else {
                    $correct = true;
                }
            }
        }

        $tocheck = parse_url($long_URL, PHP_URL_PATH);
        $ext = '';

        for ($i=strlen($tocheck); $i > 0; $i--) { 
            if($tocheck[$i] === '.') {
                for ($p=$i; $p < strlen($tocheck); $p++) { 
                    $ext .= $tocheck[$p];
                }
                break;
            }
        }

        if ($ext !== '.html' || '.php' || '.xml') {
            $short_code .= $ext;
        }

        if (isset($short_code)) {
            $created = date('Y-m-d h:i:sa');

            $query = mysqli_query($mysqli, "INSERT INTO urls VALUES(NULL, '$long_URL', '$short_code', '$created', 0)");

            if($query)
            {
                $_SESSION['short_code'] = $short_code;
                $_SESSION['success'] = true;
                header('Location: index.php');
            }
        }
    }
?>