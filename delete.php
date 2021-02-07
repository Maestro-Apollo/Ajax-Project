<?php
$hostname = "localhost:3325";
$username = "root";
$password = "";
$dbname = "ajax";

$conn = mysqli_connect($hostname, $username, $password, $dbname);
if ($conn) {
    $u_id = $_POST['u_id'];

    $sql = "DELETE from person_tbl where id = $u_id ";
    $res = mysqli_query($conn, $sql);
    if ($res) {
        echo "Deleted";
    } else {
        echo "Error";
    }
}