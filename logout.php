<?php
session_start();
$_SESSION = [];
session_unset();
session_destroy();

setcookie('$pws5d', '', time() - 3600);
setcookie('$ssl', '', time() - 3600);

echo "
    <script>
        alert('Berhasil logout!');
        window.location.href='index.php';
    </script>
";

exit;