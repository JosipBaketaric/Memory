<?php
/**
 * Created by PhpStorm.
 * User: Josip
 * Date: 12.05.2016.
 * Time: 18:47
 */
include 'connect.php';

function checkIfEmailExists($con, $email){
    $query = "SELECT * FROM users WHERE email = '".$email."'";
    if(!$result = mysqli_query($con,$query)){
        $response["error"] = true;
        $response["error_msg"] = "Database problems";
        echo json_encode($response);
        mysqli_close($con);
        die;
    }
    if(mysqli_affected_rows($con) > 0){
        $response["error"] = true;
        $response["error_msg"] = "Email already exists";
        echo json_encode($response);
        mysqli_close($con);
        die;
    }
}

function checkIfUsernameExists($con, $username){
    $query = "SELECT * FROM users WHERE email = '".$username."'";
    if(!$result = mysqli_query($con,$query)){
        $response["error"] = true;
        $response["error_msg"] = "Database problems";
        echo json_encode($response);
        mysqli_close($con);
        die;
    }
    if(mysqli_affected_rows($con) > 0){
        $response["error"] = true;
        $response["error_msg"] = "Username already exists";
        echo json_encode($response);
        mysqli_close($con);
        die;
    }
}

function registerUser($con, $email, $username, $password, $firstname, $lastname){
    $password = md5($password);
    $query = "INSERT INTO users (email, username, password, firstname, lastname, level) VALUES ('".$email."', '".$username."', '".$password."', '".$firstname."', '".$lastname."', '1')";
    if(!mysqli_query($con, $query)){
        $response["error"] = true;
        $response["error_msg"] = "Couldn't register user";
        echo json_encode($response);
        mysqli_close($con);
        die;
    }
    $response["error"] = false;
    $response["msg"] = "User registered";
    echo json_encode($response);
    mysqli_close($con);
    die;
}

if(!isset($_POST["email"]) || !isset($_POST["password"]) || !isset($_POST["username"]) || !isset($_POST["firstname"]) || !isset($_POST["lastname"])){
    $response["error"] = true;
    $response["error_msg"] = "Provide all information";
    echo json_encode($response);
    mysqli_close($con);
    die;
}

$email = $_POST["email"];
$password = $_POST["password"];
$username = $_POST["username"];
$firstname = $_POST["firstname"];
$lastname = $_POST["lastname"];

checkIfEmailExists($con, $email);
checkIfUsernameExists($con, $username);
registerUser($con, $email, $username, $password, $firstname, $lastname);