<?php
/**
 * Created by PhpStorm.
 * User: Josip
 * Date: 10.05.2016.
 * Time: 11:11
 */

require 'connect.php';

function isUserExisted($con, $email, $password){
    $password = md5($password);
    $query = "SELECT * FROM ".TABLE_NAME." WHERE email = '".$email."' AND password = '".$password."';";
    if(!mysqli_query($con, $query)){
        $response["error"] = true;
        $response["error_msg"] = "Couldn't check user credentials";
        echo json_encode($response);
        die;
    }
    mysqli_store_result($con);
    if(mysqli_affected_rows($con) > 0){
        return true;
    }
    return false;
}

function getLevel($con, $email){
    $query = "SELECT level FROM users WHERE email = '".$email."'";
    if(! ($result = mysqli_query($con, $query))){
        $response["error"] = true;
        $response["error_msg"] = "Couldn't get user level";
        echo json_encode($response);
        die;
    }
    $i = 0;
    while ($row = mysqli_fetch_assoc($result)) {
        $response[$i]["level"] = $row["level"];
        return $response[$i]["level"];
    }
    return null;
}

if(!isset($_POST["email"]) || !isset($_POST["password"]) ){
    $response["error"] = true;
    $response["error_msg"] = "Required email and password";
    echo json_encode($response);
    die;
}

$email = $_POST["email"];
$password = $_POST["password"];

if(!isUserExisted($con, $email, $password)){
    $response["error"] = true;
    $response["error_msg"] = "Invalid credentials";
    echo json_encode($response);
    die;
}

$response["error"] = false;
$response["msg"] = "Login success";
echo json_encode($response);

session_start();
$_SESSION['email'] = $email;
$_SESSION['level'] = getLevel($con, $email);

mysqli_close($con);
die;