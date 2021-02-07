<?php
$hostname = "localhost:3325";
$username = "root";
$password = "";
$dbname = "ajax";

$conn = mysqli_connect($hostname, $username, $password, $dbname);
if ($conn) {

    $user = trim($_POST['fname']);

    if (isset($user)) {
        $output = '';
        $sql = "SELECT * from country where nicename like '$user%' ";
        $res = mysqli_query($conn, $sql);
        $output = '<ul class="list-group">';
        if (mysqli_num_rows($res) > 0) {
            while ($row = mysqli_fetch_assoc($res)) {
                $output .= '<li class="list-group-item list-group-item-action list-group-item-dark">' . $row['nicename'] . '</li>';
            }
        } else {
            $output .= '<li>No Country found</li>';
        }
        $output .= '</ul>';
        echo $output;
    }
}