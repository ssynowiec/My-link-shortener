<?php 
    session_start();

    $host = $_SERVER['HTTP_HOST'];

    echo $host;

    if (isset($_SESSION['success']) &&  $_SESSION['success'] === true) {
        $short_url = $host.'/s/'.$_SESSION['short_code'];
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>URL Shortner</title>
</head>
<body>
    <form action="shorten.php" method="post">
        <input type="text" name="url" required>
        <input type="submit" name="shorten" value="Shorten">
    </form>
    <div class="short-url">
        <?php
            if (isset($_SESSION['success']) &&  $_SESSION['success'] === true) {
                echo $short_url;
            }
        ?>
    </div>
</body>
</html>

<?php 
    session_destroy();
?>