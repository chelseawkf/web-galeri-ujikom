<?php

session_start();
include 'config.php';

$error = false;


if (isset($_POST['login'])) {

    $username = $_POST['username'];
    $password = $_POST['password'];

    if (mysqli_num_rows(mysqli_query($conn, "SELECT * FROM user WHERE username = '$username' AND id_level = '1'")) > 0) {
        $result = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username' AND id_level = '1'");
        $detail = query("SELECT * FROM user WHERE username = '$username'")[0];
        $id_user = $detail['id_user'];
        if (mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);
            if (password_verify($password, $row["password"])) {
                $_SESSION["id_user"] = $id_user;
                $_SESSION["login"] = true;
                $_SESSION["admin"] = true;
                $_SESSION["username"] = $username;
                header("Location: admin");
                exit;
            }
        }
    } elseif (mysqli_num_rows(mysqli_query($conn, "SELECT * FROM user WHERE username = '$username' AND id_level = '2'")) > 0) {
        $result = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username'");
        $detail = query("SELECT * FROM user WHERE username = '$username'")[0];
        $id_user = $detail['id_user'];
        if (mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);
            if (password_verify($password, $row["password"])) {
                $_SESSION["id_user"] = $id_user;
                $_SESSION["login"] = true;
                $_SESSION["user"] = true;
                $_SESSION["username"] = $username;
                header("Location: user");
                exit;
            }
        }
    }

    $error = true;
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Galery</title>
    <link href="css/app.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
</head>


<body>
    <div class="wrapper">

        <div class="main">


            <main class="content">
                <div class="container-fluid p-0">

                    <div class="row card border p-5"
                        style="margin: 150px 400px 50px 400px; box-shadow: 4px 4px 4px gray">
                        <?php if ($error) : ?>
                        <p class="text-center text-danger">Username / Password Salah!</p>
                        <?php endif; ?>
                        <div class="d-flex justify-content-center">
                            <h1 class="px-5 mt-3">LOGIN</h1>
                        </div>
                        <br>
                        <form action="" method="POST">
                            <input name="username" type="text" placeholder="Username" class="form-control mb-4">
                            <input name="password" type="password" placeholder="Password" class="form-control mb-4">
                            <center>
                                <button name="login" type="submit" class="btn btn-success w-50">Login</button>
                        </form>
                        &nbsp;&nbsp;&nbsp;<a href="daftar.php">Daftar Akun</a>
                        </center>
                    </div>


                </div>
            </main>
        </div>
    </div>

</body>

</html>