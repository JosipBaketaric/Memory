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
    <link type="text/css" href="index-css.css" rel="stylesheet"/>

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
        if(!isset($_SESSION["email"])){
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
        }

        else{
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
                        <li><a href="#">Copyright</a></li>
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
                        <li><a href="sourceCode.php">Source code</a></li>
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

    <div class="description">
      <img class="top-right img-responsive" src="copyright.png">
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




























