<!DOCTYPE html>
<html lang="bg">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pixel.com</title>

    <style>
        <?php 
           $path = $_SERVER['DOCUMENT_ROOT'];
           $path .= "/web_technologies_2018_2019/public/css/profile_style.css";
           include($path);
        ?>
    </style>
</head>

<body>
    <nav>
        <a href="./home" ><img src="./images/pixel-logo.png" class="logo" alt="logo"></a>
        
        <?php
        if ($_SESSION) {
            if($_SESSION["username"]) {
               echo '<a href="./logout" class="button3">Logout</a>
                   <a href="./profile" class="button3">Profile</a>';
            } else {
                echo "<p>Error username</p>";
            }
        }
        ?>
    </nav>
    <article>
        <div class="container">
            <div>
                
            </div>
        </div>
    </article>
</body>

</html>