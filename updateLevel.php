<?php
/**
 * Created by PhpStorm.
 * User: Josip
 * Date: 12.05.2016.
 * Time: 12:04
 */

require 'connect.php';

function checkIfFits($level, $oldLevel)
{
    if ($level < $oldLevel)
        return false;
    if ($level == $oldLevel)
        return false;
    if ($level > ($oldLevel + 3))
        return false;
    return true;
}

session_start();
if (!isset($_SESSION["email"]) || !isset($_SESSION["level"])) {
    $response["error"] = true;
    $response["error_msg"] = "session error";
    echo json_encode($response);
    session_destroy();
    die;
}
if (!isset($_POST["level"])) {
    $response["error"] = true;
    $response["error_msg"] = "level not set";
    echo json_encode($response);
    mysqli_close($con);
    die;
}

$level = $_POST["level"];
$email = $_SESSION["email"];
$oldLevel = $_SESSION["level"];

if (!checkIfFits($level, $oldLevel)) {
    $response["error"] = true;
    $response["error_msg"] = "something wrong with level";
}

$query = "UPDATE users SET level = '" . $level . "' WHERE email = '" . $email . "';";

if (!mysqli_query($con, $query)) {
    $response["error"] = true;
    $response["error_msg"] = "Couldn't update level";
    echo json_encode($response);
    die;
}

$response["error"] = false;
$response["msg"] = "Level updated";
echo json_encode($response);
mysqli_close($con);
die;