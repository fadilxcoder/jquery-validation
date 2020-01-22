<?php
    $servername = '';
    $username = '';
    $password = '';
    $dbname = '';

    $connection = mysqli_connect($servername, $username, $password, $dbname);
    global $connection;

    mysqli_set_charset($connection, "utf8");
?>