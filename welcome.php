<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: loginpage.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login berhasil</title>
</head>
<body>
    
<div>
    <h1>Selamat anda berhasil login!</h1>
</div>

</body>
</html>