<!DOCTYPE html>
<html lang="bg">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Вземи си пиксел</title>

    <style>
        <?php 
           $path = $_SERVER['DOCUMENT_ROOT'];
           $path .= "/web_technologies_2018_2019/public/css/reg_style.css";
           include($path);
        ?>
    </style>
</head>

<body>
    <article>
        <form method="POST" action="./add?id=<?php echo $_GET['id']; ?>" enctype="multipart/form-data">
            <legend>Добави ново поле:</legend>
            <fieldset>
                <input type="text" id="link" name="link" placeholder="Адрес на страницата">
                <input type="text" id="text"  name="text" placeholder="Допълнителен текст">
                <input type="file" name="img" id="img">
                
                <input type="submit" name="submit" value="Добави">
            </fieldset>
        </form>
    </article>
</body>

</html>