<!DOCTYPE html>
<html lang="bg">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pixel.com</title>

    <!-- <link rel="stylesheet" type="text/css" href="../../../public/css/style.css"> -->
    <style>
        /* <?php include 'style.css'; ?> */
        <?php 
           $path = $_SERVER['DOCUMENT_ROOT'];
           $path .= "/web_technologies_2018_2019\public\css/style.css";
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
                $dir = dirname(dirname(dirname(__FILE__)));
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
            while ($r = $q->fetch()) :
            ?>
                <div class="cell"> <?php echo $r['id'] ?> </div>
            
            <?php endwhile; ?>
    </table>
    </article>
</body>

</html>