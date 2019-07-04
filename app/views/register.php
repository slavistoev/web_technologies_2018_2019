<?php
if (!isset($_POST['submit'])) {

    include_once 'database.php';

    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pass = mysqli_real_escape_string($conn, $_POST['password']);
    $password_again = mysqli_real_escape_string($conn, $_POST['password-again']);

    if (empty($username) || empty($email) || empty($pass) || empty($password_again)) {
        echo "s";
        header("Location: ./register");
        exit();
    } else {
        if (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
            header("Location: ../register.php?signup=invalid");
            exit();
        } else {
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                header("Location: ../register.php?signup=invalidemail");
                exit();
            } else {
                if ($pass == $password_again) {
                    $sql = "SELECT * FROM users WHERE username='$username'";
                    $result = mysqli_query($conn, $sql);
                    $resultCheck = mysqli_num_rows($result);

                    if ($resultCheck > 0) {
                        header("Location: ../register.php?signup=usernametaken");
                        exit();
                    } else {
                        $hashedPwd = password_hash($pass, PASSWORD_DEFAULT);

                        $sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$hashedPwd');";
                        mysqli_query($conn, $sql);
                        $_SESSION['id'] = $row['id'];
                        $_SESSION['username'] = $row['username'];
                        $_SESSION['email'] = $row['email'];

                        header("Location: ../../LoggedUser/home.php?login=success");
                        exit();
                    }
                }
                else {
                    header("Location: ../register.php?signup=passwordnotmatch");
                    exit();
                }
            }
        }
    }
} else {
    header("Location: ../register.php");
    exit();
}
