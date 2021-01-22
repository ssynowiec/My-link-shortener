<?php 
    session_start();

    $host = $_SERVER['HTTP_HOST'];

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

    <link rel="stylesheet" href="./style.css">
    <link rel="stylesheet" href="./fontawesome/css/all.min.css">
</head>
<body>
    <header>
        d
    </header>

    <main>
        <form action="shorten.php" method="post">
            <div class="inputs">
            <input class="input" type="text" name="url" placeholder="Paste your long link" required><br>
            <input class="input" type="text" name="my-prefix" placeholder="Enter your short prefix" title="If left blank, a random prefix will be generated" autocomplete="off">
            </div>
            <input type="submit" name="shorten" value="Shorten">
        </form>
            <?php if (isset($_SESSION['success']) &&  $_SESSION['success'] === true) { ?>
                <div class="short-url" id="container">
                    Your link:
                    <input id="short-link" type="text" value="https://<?php echo $short_url; ?>/" readonly>
                    <i class='far fa-copy'></i>
                </div>
            <?php } ?>

            <?php if (isset($_SESSION['error'])) { ?>
                <div class="error">
                    <?php echo $_SESSION['error']; ?> 
                </div>                    
            <?php }?>
    </main>

    <footer>
        <div class="footer__copyright">
            &copy; Copyright 2020 <a href="https://ssynowiec.pl" class="footer__copy-link">ssynowiec.pl</a>
        </div>
    </footer>

    <script>
        const link = document.querySelector('#short-link');

        const container = document.getElementById('container');

        container.addEventListener('click', event => {
            link.select();
            link.setSelectionRange(0, 99999);

            document.execCommand("copy");
        });
    </script>
</body>
</html>

<?php 
    session_destroy();
?>