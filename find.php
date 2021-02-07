<?php
$hostname = "localhost:3325";
$username = "root";
$password = "";
$dbname = "ajax";

$conn = mysqli_connect($hostname, $username, $password, $dbname);
if ($conn) {

    $user = trim($_POST['fname']);

    if (empty($user)) {
        echo "";
    } else {
        if (isset($user)) {
            $sql = "SELECT * from person_tbl where fname = '$user' ";
            $res = mysqli_query($conn, $sql);
            if (mysqli_num_rows($res) > 0) {
                echo '<span class="text-danger">Username is taken</span><br>';
            } else {
                echo '<span class="text-success">Username available</span><br>';
            }
        }
    }
}