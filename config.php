<?php

$conn = mysqli_connect("localhost", "root", "", "galery");

function query($query)
{
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    };
    return $rows;
}

function upload()
{
    $namaFile = $_FILES['gambar']['name'];
    $ukuranFile = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmpName = $_FILES['gambar']['tmp_name'];


    $ekstensifile = explode('.', $namaFile);
    $ekstensifile = strtolower(end($ekstensifile));

    // generate nama file baru
    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensifile;
    move_uploaded_file($tmpName, '../img/' . $namaFileBaru);

    return $namaFileBaru;
}


function daftarAkun($data)
{
    global $conn;
    $username = mysqli_real_escape_string($conn, $data["username"]);
    $password_sebelum = mysqli_real_escape_string($conn, $data["password"]);
    // cek username sudah ada atau belum
    $prosescek = mysqli_query($conn, "SELECT * FROM user WHERE username='$username'");
    if (mysqli_num_rows($prosescek) > 0) {
        echo "<script>alert('Username Sudah Digunakan!');history.go(-1) </script>";
        exit;
    }
    // enkripsi password
    $password = password_hash($password_sebelum, PASSWORD_DEFAULT);
    mysqli_query($conn, "INSERT INTO user VALUES(NULL, '2', '$username','$password')");
    if (mysqli_affected_rows($conn) > 0) {
        echo "
            <script>
                alert('Berhasil Daftar Akun!');
                window.location.href='login.php'
            </script>
        ";
    } else {
        echo mysqli_error($conn);
    }
}


function getAllDataJoinUser()
{
    global $conn;
    $query = "SELECT *
          FROM data JOIN user ON data.id_user = user.id_user";

    return mysqli_query($conn, $query);
}
function getAllKomenJoinUserByIdDataAndUser($id_data, $id_user)
{
    global $conn;
    $query = "SELECT *
          FROM komen JOIN user ON komen.id_user = user.id_user
          WHERE komen.id_data = '$id_data' AND komen.id_user = '$id_user' ";

    return mysqli_query($conn, $query);
}

function getAllDataJoinUserByIdData($id_data)
{
    global $conn;
    $query = "SELECT *
          FROM data JOIN user ON data.id_user = user.id_user
          WHERE data.id_data = '$id_data'";

    return query($query)[0];
}


function getTotalLikeByIdData($id_data)
{
    global $conn;
    $query = "SELECT * FROM likes WHERE likes.id_data = '$id_data'";

    return mysqli_num_rows(mysqli_query($conn, $query));
}

function isLiked($id_data, $id_user)
{
    global $conn;
    $query = "SELECT * FROM likes WHERE likes.id_data = '$id_data' AND id_user = '$id_user'";

    return mysqli_num_rows(mysqli_query($conn, $query));
}


function tambahData($id_user, $gambar)
{
    global $conn;
    $id_user = $id_user;
    mysqli_query($conn, "INSERT INTO data VALUES(NULL, '$id_user', '$gambar')");

    echo "
        <script>
            alert('Berhasil Tambah Data!');
            window.location.href='index.php';
        </script>
    ";
    exit;
}

function editData($id_data, $gambar)
{
    global $conn;
    $id_data = $id_data;
    mysqli_query($conn, "UPDATE data SET 
        gambar = '$gambar'
        WHERE id_data = '$id_data'
    ");

    echo "
        <script>
            alert('Berhasil Edit Data!');
            window.location.href='index.php';
        </script>
    ";
    exit;
}