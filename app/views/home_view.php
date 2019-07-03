<!DOCTYPE html>
<html lang="bg">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pixel.com</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <!-- <link rel="stylesheet" type="text/css" href="../../../public/css/style.css"> -->
    <style>
        /* <?php include 'style.css'; ?> */
        <?php 
           $path = $_SERVER['DOCUMENT_ROOT'];
           $path .= "/web_technologies_2018_2019/public/css/style.css";
           include($path);
        ?>
    </style>
</head>

<body>
    <article>
        <header><h1>Pixel.com</h1></header>
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

            $sql = 'SELECT * FROM Grid';
            $q = $pdo->query($sql);
            $q->setFetchMode(PDO::FETCH_ASSOC);
            while ($r = $q->fetch()) {
                if ($r['empty'] == 0) {
                    echo '<a href="' . $r['link'] . '" class="cell"><img src="' . $r['img'] . '" title="' . $r['text'] . '"/>'. '</a>';
                }
                else if ($r['empty'] == 1){
                    echo '<a href="#" class="cell-empty" id="' . $r['id'] . '" onClick="reply_click(this.id)">' . $r['id'] . '</a>';
                }
            }
            ?>
    </table>
    </article>
</body>

<script language="javascript" type="text/javascript">
    function reply_click(clicked_id) {
        window.location.href = "./getGridElement?id=" + clicked_id; 
    };
</script>

</html>