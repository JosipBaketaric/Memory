<?php
/**
 * Created by PhpStorm.
 * User: Josip
 * Date: 12.05.2016.
 * Time: 12:31
 */

require 'connect.php';
session_start();
if (!isset($_SESSION["email"])) {
    $response["error"] = true;
    $response["error_msg"] = "session error";
    echo json_encode($response);
    session_destroy();
    mysqli_close($con);
    die;
}

$email = $_SESSION["email"];

$query = "SELECT level FROM users WHERE email = '" . $email . "';";
if (!($result = mysqli_query($con, $query))) {
    $response["error"] = true;
    $response["error_msg"] = "Couldn't get level";
    echo json_encode($response);
    mysqli_close($con);
    die;
}
while ($row = mysqli_fetch_assoc($result)) {
    $response["error"] = false;
    $response["msg"] = $row["level"];
    echo json_encode($response);
    mysqli_close($con);
    die;
}

$response["error"] = true;
$response["error_msg"] = "Couldn't get level";
echo json_encode($response);
mysqli_close($con);
die;