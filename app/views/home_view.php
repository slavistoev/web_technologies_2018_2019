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
           $path = $_SERVER['DOCUMENT_ROOT'];
           $path .= "/web_technologies_2018_2019/public/css/style.css";
           include($path);
        ?>
    </style>
</head>

<body>
        <a href="./home" ><img src="./images/pixel-logo.png" class="logo" alt="logo"></a>
        
        <nav>
        <?php
        if ($_SESSION) {
            if($_SESSION["username"]) {
               echo '<div class="nav"><a href="./logout" class="button3">Logout</a>
                   <a href="./profile" class="button3">Profile</a>';
               echo '<p class="greeting"> Welcome, ' . $_SESSION["username"] . '! Choose your pixel NOW!</p></div>';
            } else {
                echo "<p>Error username</p>";
            }
        } else {
            echo '<a href="./login" class="button3">SignIn</a>
                <a href="./register" class="button3">SignUp</a>';
        }
        ?>
        </nav>
        <section>
        <div class="container">
            <?php 
            try {
                $dir = dirname(dirname(__FILE__));
                include_once $dir . '\models\database.php';
                $vars = $dir . '\include\vars.php';
            
                $db = new Database;
                $pdo = $db->connect($vars);
            } catch (Exception $e) {
                echo $e->getTraceAsString();
            }

            $sql = 'SELECT * FROM grid';
            $q = $pdo->query($sql);
            $q->setFetchMode(PDO::FETCH_ASSOC);
            while ($r = $q->fetch()) {
                if ($r['empty'] == 0) {
                    echo '<a href="' . $r['link'] . '" class="cell" ><img src="../public/images/' . $r['img'] . '" title="' . $r['text'] . '"/>'. '</a>';
                }
                else if ($r['empty'] == 1){
                    echo '<a href="#" class="cell-empty" id="' . $r['id'] . '" onClick="reply_click(this.id)"> <img src="./images/Free-cell.png" class="free" alt="Free"></a>';
                }
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