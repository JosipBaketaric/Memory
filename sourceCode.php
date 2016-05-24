<?php
session_start();
if (!isset($_SESSION["email"])) {
    session_destroy();
} else {
    $email = $_SESSION["email"];
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Memory</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <script src="https://d3js.org/d3.v3.min.js" charset="utf-8"></script>
    <link type="text/css" href="main-css.css" rel="stylesheet"/>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
<body>
<div class="container">

    <div class="page-header">

        <?php

        if (!isset($_SESSION["email"])) {

            print("
                <form class='navbar-form navbar-right' role='form' method='post' action='login.php' id='login_form'>
            <div class='navbar-form navbar-left'>
                <span class='glyphicon glyphicon-user'></span>
                <input type='email' class='form-control' placeholder='email' id='login_email' name='email'/>
            </div>
            <div class='navbar-form navbar-left'>
                <span class='glyphicon glyphicon-lock'></span>
                <input type='password' class='form-control' placeholder='password' id='login_password' name='password'/>
            </div>
            <div class='navbar-form navbar-left'>
                <button type='submit' class='btn btn-success btn-default' id='btn_login'>Login</button>
            </div>
        </form>
                ");

        }//IF

        else {

            print("<form class='navbar-form navbar-right' role='form' method='post'>
                <div class='navbar-form navbar-left'>
                    <span class='glyphicon glyphicon-user'></span>
                    <input type='email' class='form-control' placeholder='email' name='email' value='$email' disabled='disabled'/>
                </div>
                <div class='navbar-form navbar-left'>
                    <button type='submit' class='btn btn-success btn-default' onclick='logOut()'>Logout</button>
                </div>
            </form>
                ");

        }//Else
        ?>

        <h1>Memory</h1>

        <br>

        <div class="pull-right empty_space">
            &nbsp;&nbsp;&nbsp;&nbsp;
        </div>

        <?php
        if (!isset($_SESSION["email"])) {
            print("
            <div class='navbar-header pull-right'>
            <ul class='nav navbar-nav'>
                <li class='dropdown'>
                    <a href='#' class='' id='register_index_link' onclick='showRegister()'>Register</a>
                </li>
            </ul>
        </div>

        <div class='pull-right empty_space'>
            <pre> </pre>
        </div>
            ");
        } else {
            print("
            <div class=\"pull-right empty_space\">
            <pre>                       </pre>
        </div>
            ");
        }
        ?>


        <div class="navbar-header pull-right">
            <ul class="nav navbar-nav">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Additional info <span
                            class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="contacts.php">Contacts</a></li>
                        <li><a href="copyright.php">Copyright</a></li>
                    </ul>
                </li>
            </ul>
        </div>

        <div class="pull-right empty_space">
            <pre> </pre>
        </div>

        <div class="navbar-header pull-right">
            <ul class="nav navbar-nav">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">About <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="basicInfo.php">Basic info</a></li>
                        <li><a href="#">Source code</a></li>
                    </ul>
                </li>
            </ul>
        </div>

        <div class="pull-right empty_space">
            <pre> </pre>
        </div>

        <div class="navbar-header pull-right">
            <ul class="nav navbar-nav">
                <li class="dropdown">
                    <a href="index.php" class="">Index</a>
                </li>
            </ul>
        </div>

        <?php
        if (isset($_SESSION["email"])) {
            print("
        <div class='pull-right empty_space'>
            <pre> </pre>
        </div>

        <div class='navbar-header pull-right'>
            <ul class='nav navbar-nav'>
                <li class='dropdown'>
                    <a href='main.php' class=''>Game</a>
                </li>
            </ul>
        </div>
        ");
        }//IF
        ?>

        <br><br>
    </div>


    <br><br><br><br><br>

    <div class="jumbotron description">

        <br><br>


        <h1 class="h1 source_code">SOURCE CODE</h1>
        <br><br><br>
        <h2 class="pull-left">DATABASE COMMUNICATION</h2>
        <br><br><br>
        <h3 class="code_name" data-toggle="collapse" data-target="#php-config">confiq.php</h3>
        <pre class="collapse" id="php-config">
            define("DB_HOST", "br-cdbr-azure-south-b.cloudapp.net");
            define("DB_USER", "xxxxxxxxxxxxxx");
            define("DB_PASSWORD", "xxxxxxxx");
            define("DB_DATABASE", "internetprogramiranjeKV");
            define("DB_PORT", "3306");
            define("TABLE_NAME", "xxxxx");
        </pre>

        <br><br>
        <h3 class="code_name" data-toggle="collapse" data-target="#php-connect">connect.php</h3>
        <pre class="collapse" id="php-connect">
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
        </pre>

        <br><br>
        <h3 class="code_name" data-toggle="collapse" data-target="#php-register">register.php</h3>
        <pre class="collapse" id="php-register">
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
        </pre>

        <br><br>
        <h3 class="code_name" data-toggle="collapse" data-target="#php-login">login.php</h3>
        <pre class="collapse" id="php-login">
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
        </pre>

        <br><br>
        <h3 class="code_name" data-toggle="collapse" data-target="#php-logout">logout.php</h3>
        <pre class="collapse " id="php-logout">
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
        </pre>

        <br><br>
        <h3 class="code_name" data-toggle="collapse" data-target="#php-getHighScore">getHighScore.php</h3>
        <pre class="collapse" id="php-getHighScore">
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
        </pre>

        <br><br>
        <h3 class="code_name" data-toggle="collapse" data-target="#php-getStartLevel">getStartLevel.php</h3>
        <pre class="collapse" id="php-getStartLevel">
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
        </pre>

        <br><br>
        <h3 class="code_name" data-toggle="collapse" data-target="#php-updateLevel">updateLevel.php</h3>
        <pre class="collapse" id="php-updateLevel">
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
        </pre>

        <br><br><br><br>
        <h2 class="pull-left">JAVASCRIPT/JQUERY/AJAX</h2>
        <br><br>

        <br><br>
        <h3 class="code_name" data-toggle="collapse" data-target="#jscript-main-scripts">game logic</h3>
        <pre class="collapse" id="jscript-main-scripts">
            /**
            * Created by Josip on 11.05.2016..
            */
            var numberCounter = 0;
            var level = 1;
            var numbers = [];

            var tempID = "guess-";

            var isReady = 0;
            var isStartReady = 1;

            var x = 0;
            var wait = 0;

            function Start() {
            if (isStartReady == 1) {
            isStartReady = 0;
            document.getElementById('btn_table').style.pointerEvents = 'none';
            console.log("Start");

            var intervalID = setInterval(function () {
            if (x < level) {
            numbers[x] = Math.floor((Math.random() * 9) + 1);
            ID = tempID.concat(numbers[x].toString());
            console.log("ID: " + ID);

            document.getElementById(ID).style.backgroundColor = "green";

            var WaiteABit = setInterval(function () {
            if (wait === 1) {
            wait = 0;
            console.log("wait: " + wait);

            document.getElementById(ID).style.backgroundColor = "white";
            setOnHoover(ID);

            window.clearInterval(WaiteABit);
            }
            wait = 1;
            }, 300);

            }

            console.log("x = " + x + ", level = " + level + ", level+1= " + level + 1);
            if (++x == (level + 1)) {
            console.log("++x == (level+1)");
            isReady = 1;
            x = 0;
            document.getElementById('btn_table').innerHTML = "Select numbers";
            console.log("Numbers: " + numbers);
            setOnHoover(ID);
            document.getElementById('btn_table').style.pointerEvents = "auto";
            window.clearInterval(intervalID);
            }
            }, 1000);
            }

            }


            function setOnHoover(ID) {
            var div = document.getElementById(ID);
            div.onmouseover = function () {
            this.style.backgroundColor = 'lightgray';
            };
            div.onmouseout = function () {
            this.style.backgroundColor = 'transparent';
            };
            }


            function checkUserClicks(number) {
            if (isReady == 1) {
            if ((number == numbers[numberCounter]) && ( (numbers.length - 1) == numberCounter)) {
            console.log("all right. number: " + number);
            numberCounter = 0;
            numbers = [];
            isReady = 0;
            updateLevel();
            }
            else if (number == numbers[numberCounter]) {
            console.log("right number: " + number);
            numberCounter++;
            }
            else {
            //Wrong number
            console.log("wrong number: " + number);
            notifyWrong(number);
            numberCounter = 0;
            numbers = [];
            isReady = 0;
            isStartReady = 1;
            document.getElementById('btn_table').innerHTML = "Ready";
            }
            }//End of if isReady

            }


            function updateLevel() {
            var levelData = {"level": (level + 1).toString()};
            $.ajax({
            type: "POST",
            url: "updateLevel.php",
            data: levelData,
            dataType: 'json',
            success: function (html) {

            if (html["error"]) {
            isStartReady = 1;
            document.getElementById('btn_table').innerHTML = "Ready";
            alert(html["error_msg"]);
            console.log("error" + html["error_msg"]);
            }//IF
            else {
            console.log("not error: " + html["msg"]);
            level++;
            document.getElementById("lvl_td").innerHTML = "Level: " + level;
            isStartReady = 1;
            document.getElementById('btn_table').innerHTML = "Ready";
            }//Else
            }
            });//End of async fetch
            }

            function refreshHighscore() {

            $.ajax({
            type: "POST",
            url: "getHighScore.php",
            dataType: 'json',
            success: function (html) {
            var tempNameID = "highscore_name_";
            var tempLevelID = "highscore_level_";

            var count = Object.keys(html).length;
            count = count-1;

            for (var i = 0; i < count; i++) {
            var id1 = tempNameID.concat((i + 1).toString());
            var id2 = tempLevelID.concat((i + 1).toString());

            var username = html[i]["username"];
            var level = html[i]["level"];

            console.log("username: " + username);
            console.log("level: " + level);

            document.getElementById(id1).innerHTML = username;
            document.getElementById(id2).innerHTML = level;

            }//End of for
            }
            });//End of async fetch
            }

            function notifyWrong(number) {
            var tempID = "guess-";
            tempID = tempID.concat(number.toString());

            document.getElementById(tempID).style.backgroundColor = "#ff8080";

            var WaiteABit = setInterval(function () {
            if (wait === 1) {
            wait = 0;
            console.log("wait: " + wait);

            document.getElementById(ID).style.backgroundColor = "white";
            setOnHoover(tempID);

            window.clearInterval(WaiteABit);
            }
            wait = 1;
            }, 1000);

            }

            function logOut() {
            $.ajax({
            type: "POST",
            url: "logout.php",
            dataType: 'json',
            success: function (html) {
            if (!html["error"]) {

            }
            }
            });//End of async fetch
            }

            window.onload = function () {

            $.ajax({
            type: "POST",
            url: "getStartLevel.php",
            dataType: 'json',
            success: function (html) {

            if (html["error"]) {
            document.getElementById("lvl_td").innerHTML = "Level: 1";
            alert(html["error_msg"]);
            console.log("error" + html["error_msg"]);
            level = 1;
            }//IF
            else {
            console.log("not error: " + html["msg"]);
            level = parseInt(html["msg"]);
            document.getElementById("lvl_td").innerHTML = "Level: " + level;
            }//Else
            }
            });//End of async fetch
            refreshHighscore();

            };

        </pre>

        <br><br>
        <h3 class="code_name" data-toggle="collapse" data-target="#jscript-index-scripts">index page script</h3>
        <pre class="collapse" id="jscript-index-scripts">
            /**
            * Created by Josip on 10.05.2016..
            */
            $("#btn_submit").click(function () {

            if ($("#firstName").val() == "" || $("#lastName").val() == "" || $("#email").val() == "" || $("#password").val() == "" || $("#repeat_password").val() == "") {
            $("#ack").empty();
            $("#ack").html("Provide all information in order to proceed");
            }
            else if ($("#password").val().localeCompare($("#repeat_password").val())) {
            $("#ack").empty();
            $("#ack").html("Passwords don't match");
            }
            else {
            $.post($("#registrationForm").attr("action"),
            $("#registrationForm").serializeArray(),
            function (info) {

            if (!info["error"]) {
            $("#ack").empty();
            $("#ack").html(info["msg"]);
            showIndex();
            }
            else {
            $("#ack").empty();
            $("#ack").html(info["error_msg"]);
            }
            }, "json");//Send data to the script

            }//Else

            $("#registrationForm").submit(function () {
            return false;
            });//Make sure that btn doesn't redirect

            });

            $("#btn_login").click(function () {

            var l_email = $("#login_email").val();
            var l_password = $("#login_password").val();

            if (l_email == "" || l_password == "") {
            alert("Enter credentials!");
            }
            else {
            $.post($("#login_form").attr("action"),
            $("#login_form").serializeArray(),
            function (info) {
            console.log("info: " + info);
            if (!info["error"]) {
            redirectToMain();
            }
            else {
            alert(info["error_msg"]);
            }
            }, "json");
            }


            $("#login_form").submit(function () {
            return false;
            });//Make sure that btn doesn't redirect

            });

            var registerToggle = 0;
            function showRegister() {
            if(registerToggle == 0){
            $(function () {
            $(".description").addClass('hidden').removeClass('collapse');
            });

            $('.register').addClass('collapse').removeClass("hidden");
            $('.collapse').collapse();
            registerToggle = 1;
            $('#register_index_link').html("Index");
            }
            else {
            showIndex();
            }

            }

            function showIndex() {
            registerToggle = 0;
            $('#register_index_link').html("Register");
            $('.description').addClass("collapse");
            $('.register').addClass("hidden").removeClass('collapse');

            $(function () {
            $(".description").removeClass('hidden');
            });
            $('.collapse').collapse();
            }

            function comparePasswords() {
            var password1 = document.getElementById("password").value;
            var password2 = document.getElementById("repeat_password").value;

            if (password1.localeCompare(password2) != 0) {
            document.getElementById("repeat_password").style.backgroundColor = "#ff8080";
            }
            else {
            document.getElementById("repeat_password").style.backgroundColor = "white";
            }
            }

            function redirectToMain() {
            location.href = "main.php";
            }

            function logOut() {
            console.log("logout");
            $.ajax({
            type: "POST",
            url: "logout.php",
            dataType: 'json',
            success: function (html) {
            if (!html["error"]) {

            }
            }
            });//End of async fetch
            }
        </pre>



    </div>


    <div class="jumbotron register collapse">

        <div class="panel panel-default">
            <div class="panel-heading registration_title">Registration</div>
            <div class="panel-body">
                <form method="post" action="register.php" id="registrationForm">
                    <label for="firstName" class="control-label">Name:</label>

                    <div class="row">
                        <div class="col-md-6">
                            <input type="text" class="form-control" id="firstName" name="firstname"
                                   placeholder="First"/>
                        </div>
                        <div class="col-md-6">
                            <input type="text" class="form-control" id="lastName" name="lastname" placeholder="Last">
                        </div>
                    </div>

                    <label for="email" class="control-label padding-top-10">Email:</label>

                    <div class="row">
                        <div class="col-md-12">
                            <input type="email" class="form-control" id="email" name="email" placeholder="Email">
                        </div>
                    </div>

                    <label for="username" class="control-label padding-top-10">Username:</label>

                    <div class="row">
                        <div class="col-md-12">
                            <input type="text" class="form-control" id="username" name="username"
                                   placeholder="Username">
                        </div>
                    </div>

                    <label for="password" class="control-label padding-top-10">Password:</label>

                    <div class="row">
                        <div class="col-md-6">
                            <input type="password" class="form-control" id="password" name="password"
                                   placeholder="password">
                        </div>
                        <div class="col-md-6">
                            <input type="password" class="form-control" id="repeat_password"
                                   placeholder="Repeat password" onblur="comparePasswords()">
                        </div>
                    </div>

                    <br><br><br>

                    <input type="submit" class="btn btn-lg btn-success" id="btn_submit" value="Register">

                    <div class="row padding-top-10">
                        <div class="col-md-8 pull-right" id="ack">
                        </div>
                    </div>

                </form>
            </div>
        </div>

    </div>


</div>


<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script type="text/javascript" src="scripts.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>




























