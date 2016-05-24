<?php
/**
 * Created by PhpStorm.
 * User: Josip
 * Date: 10.05.2016.
 * Time: 10:37
 */
require 'config.php';

// Create connection
$con = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE, DB_PORT);

// Check connection
if (!$con) {
    $response["error"] = true;
    $response["error_msg"] = "Couldn't connect to the database";
    echo json_encode($response);
    die;
}