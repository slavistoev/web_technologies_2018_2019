<?php
function checkIfPictureExists($img) {
    $img = $img;
    $path = dirname(dirname(__DIR__)) . "/public/images/";
    $fullpath =  $path .  $img;

    if (file_exists($fullpath)) {
        return true;
    }
    else {
        return false;
    }
}

?>


<!DOCTYPE html>
<html lang="bg">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pixel.com</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <style>
        <?php 
           $path = dirname(dirname(dirname(__FILE__)));

           $path .= "/public/css/style.css";
           include($path);
        ?>
    </style>
</head>

<body>
        <a href="./home" ><img src="./images/pixel-logo.png" class="logo" alt="logo"></a>
        
        <nav>
        <?php
        $path = dirname(dirname(dirname(__FILE__)));
        $path .= "/app/models/Pixel.php";
        include($path);
        if ($_SESSION) {
            if($_SESSION["username"]) {
               echo '<div class="nav"><a href="./profile" class="button3">Profile</a>
                   <a href="./logout" class="button3">Logout</a>';
               echo '<p class="greeting"> Welcome, ' . $_SESSION["username"] . '! Choose your pixel NOW!</p></div>';
            } else {
                echo "<p>Error username</p>";
            }
        } else {
            echo '<div class="nav"><a href="./register" class="button3">SignUp</a>
                <a href="./login" class="button3">SignIn</a></div>';
        }
        ?>
        </nav>
        <section>
        <div class="container">
            <?php 
            $result = Pixel::getAllPixels();
            if ($result['success']) {
                $result['pixels']->setFetchMode(PDO::FETCH_ASSOC);
                while ($pixel = $result['pixels']->fetch()) {
                    if ($pixel['empty'] == 0) {
                        if (checkIfPictureExists($pixel['img']))  { 
                            echo '<a href="' . $pixel['link'] . '" class="cell" target="_blank"><img src="../public/images/' . $pixel['img'] . '" title="' . $pixel['text'] . '"/>'. '</a>';
                        } else {
                            echo '<a href="' . $pixel['link'] . '" class="cell-empty" ><img src="../public/images/imagenotfound.png" title="' . $pixel['text'] . '"/>'. '</a>';
                        }
                        
                    }
                    else if ($pixel['empty'] == 1){
                        echo '<a href="#" class="cell-empty" id="' . $pixel['id'] . '" onClick="reply_click(this.id)"> <img src="./images/Free-cell.png" class="free" alt="Free"></a>';
                    }
                }
            } else {
                echo $result['error'];
            }
            ?>
    </div>
    </section>
</body>

<script language="javascript" type="text/javascript">
    function reply_click(clicked_id) {
        window.location.href = "./add?id=" + clicked_id; 
    };
</script>

</html>