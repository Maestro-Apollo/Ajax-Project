<?php
$hostname = "localhost:3325";
$username = "root";
$password = "";
$dbname = "ajax";

$conn = mysqli_connect($hostname, $username, $password, $dbname);
if ($conn) {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $age = $_POST['age'];

    // if (isset($fname)) {
    //     $sql = "SELECT * from person_tbl where fname like '$fname%' ";
    //     $res = mysqli_query($conn, $sql);
    //     if (mysqli_num_rows($res) > 0) {
    //         echo '<span class="text-danger">Username is taken</span>';
    //     } else {
    //         echo '<span class="text-success">Username available</span>';
    //     }
    // }

    if (isset($fname)) {
        $sql = "INSERT INTO `person_tbl` (`id`, `fname`, `lname`, `age`) VALUES (NULL, '$fname', '$lname', '$age')";
        $res = mysqli_query($conn, $sql);
        if ($res) {
            echo "Added";
        } else {
            echo "Not Added";
        }
    }
}