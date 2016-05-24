<?php
/**
 * Created by PhpStorm.
 * User: Josip
 * Date: 10.05.2016.
 * Time: 20:45
 */
session_start();
if (!session_destroy()) {
    $response["error"] = true;
    $response["error_msg"] = "couldn't stop session";
    echo json_encode($response);
    die;
}
$response["error"] = false;
echo json_encode($response);
die;