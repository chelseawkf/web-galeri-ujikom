<?php

session_start();
include 'config.php';


if (isset($_POST['daftar'])) {
    daftarAkun($_POST);
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
                    <div class="row card border p-5" style="margin: 150px 400px 50px 400px; box-shadow: 4px 4px 4px gray">
                        <div class="d-flex justify-content-center">
                            <h1 class="px-5 mt-3">DAFTAR AKUN</h1>
                        </div>
                        <br>
                        <form action="" method="POST">
                            <input name="username" type="text" placeholder="Username" class="form-control mb-4" required>
                            <input name="password" type="password" placeholder="Password" class="form-control mb-4" required>
                            <center>
                                <button name="daftar" type="submit" class="btn btn-success w-50">Daftar</button>
                        </form>
                        &nbsp;&nbsp;&nbsp;<a href="login.php">Login</a>
                        </center>
                    </div>
                </div>
            </main>
        </div>
    </div>

</body>

</html>