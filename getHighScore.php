<?php
/**
 * Created by PhpStorm.
 * User: Josip
 * Date: 12.05.2016.
 * Time: 07:22
 */

require 'connect.php';



$statement = "SELECT level, username FROM users ORDER BY level DESC LIMIT 5;";
if( ($result = mysqli_query($con, $statement)) ){

    $i=0;
    $response["error"] = false;
    while ($row = mysqli_fetch_assoc($result)) {
       $response[$i]["level"] = $row["level"];
        $response[$i]["username"] = $row["username"];
        $i++;
    }

    echo json_encode($response);
    mysqli_close($con);
}
