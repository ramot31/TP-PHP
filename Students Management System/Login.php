<?php
include "header.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <form method="post" action="ProcessLogin.php" enctype="multipart/form-data">
        <label>Email :</label>
        <input type="email" name="mail">
        <br>
        <label>Password :</label>
        <input type="password" name="pass">
        <br>
        <button type="submit">Login</button>
    </form>
</body>
</html>