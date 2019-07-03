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
    <form method="POST" action="./register">
        <legend>Регистрация</legend>
        <fieldset>
        <input type="text" id="username" class="fadeIn second" name="username" placeholder="Потребителско име">
        <input type="email" id="email" class="fadeIn second" name="email" placeholder="Имейл адрес">
        <input type="password" id="password" class="fadeIn third" name="password" placeholder="Парола">
        <input type="password" id="password-again" class="fadeIn third" name="password-again" placeholder="Повтори Парола">
        <input type="submit" class="fadeIn fourth" name="submit" value="Регистрация">
        </fieldset>
    </form>
</body>

</html>