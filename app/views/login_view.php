<!DOCTYPE html>
<html lang="bg">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>LogIn</title>

    <style>
        <?php 
           $path = $_SERVER['DOCUMENT_ROOT'];
           $path .= "/web_technologies_2018_2019/public/css/reg_style.css";
           include($path);
        ?>
    </style>
</head>

<body class="reg">
    <article>
        <div class="login-page">
            <div class="form">
                <form method="POST" action="./login">
                    <legend>Member Login</legend>
                    <input type="text" id="username" name="username" placeholder="Username">
                    <input type="password" id="password" name="password" placeholder="Password">
                    <input type="submit" name="submit" class="button" value="Login">
                </form>
                <p class="message">Not registered? <a href="./register">Create an account</a></p>
                <p class="message"><a href="./home">Return</a></p>
            </div>
        </div>
    </article>
</body>

</html>