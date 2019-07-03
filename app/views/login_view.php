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
           $path .= "/web_technologies_2018_2019/public/css/reg_style.css";
           include($path);
        ?>
    </style>
</head>

<body>
    <form method="POST" action="./login">
        <legend>Логин</legend>
        <fieldset>
        <input type="text" id="username" name="username" placeholder="Потребителско име">
        <input type="password" id="password" name="password" placeholder="Парола">
        <input type="submit" name="submit" value="Вход">
        </fieldset>
    </form>
</body>

</html>