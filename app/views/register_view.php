<!DOCTYPE html>
<html lang="bg">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>

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
        <div class="register-page">
            <div class="form">
                <form method="POST" action="./register">
                    <legend>Welcome</legend>
                    <input type="text" id="username" name="username" placeholder="Username">
                    <input type="email" id="email" name="email" placeholder="Email">
                    <input type="password" id="password" name="password" placeholder="Password">
                    <input type="password" id="password-again"  name="password-again" placeholder="Repeat Password">
                    <input type="submit" name="submit" class="button" value="Signup" >
                </form>
                <p class="message">Already registered? <a href="./login">Sign In</a></p>
                <p class="message"><a href="./home">Return</a></p>
            </div>
        </div>
    </article>
</body>

</html>