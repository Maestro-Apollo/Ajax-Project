<?php
$hostname = "localhost:3325";
$username = "root";
$password = "";
$dbname = "ajax";

$conn = mysqli_connect($hostname, $username, $password, $dbname);
if ($conn) {
    $arr = array();
    $sql = "SELECT * from person_tbl";
    $res = mysqli_query($conn, $sql);
    if (mysqli_num_rows($res) > 0) {
        while ($row = mysqli_fetch_assoc($res)) {
            $arr[] = $row;
        }
        echo json_encode($arr);
    }
}