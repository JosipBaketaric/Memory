<?php
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: index.php"); /* Redirect browser */
    exit();
}
$email = $_SESSION["email"];
$level = $_SESSION["level"];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Memory</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="main-css.css"/>

    <script src="https://d3js.org/d3.v3.min.js" charset="utf-8"></script>
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

        <form class="navbar-form navbar-right" role="form" method="post">
            <div class="navbar-form navbar-left">
                <span class="glyphicon glyphicon-user"></span>
                <input type="email" class="form-control" placeholder="email" name="email"
                       value=" <?php print"$email"; ?> " disabled="disabled"/>
            </div>

            <div class="navbar-form navbar-left">
                <button type="submit" class="btn btn-success btn-default" onclick="logOut()">Logout</button>
            </div>
        </form>

        <h1>Memory</h1>

        <br>

        <div class="pull-right empty_space">
            &nbsp;&nbsp;&nbsp;&nbsp;
        </div>
        <div class="pull-right empty_space">
            <pre>                       </pre>
        </div>


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

        <br><br>
    </div>

    <br><br><br><br><br>


    <div class="row">

        <div class="col-lg-2"></div>

        <div class="col-lg-6">
            <table class="table table-bordered" id="table_guess">
                <tr id="lvl_tr">
                    <td colspan="3" id="lvl_td">Level:</td>
                </tr>

                <tr>
                    <td id="guess-1" onclick="checkUserClicks(1)">1</td>
                    <td id="guess-2" onclick="checkUserClicks(2)">2</td>
                    <td id="guess-3" onclick="checkUserClicks(3)">3</td>
                </tr>

                <tr>
                    <td id="guess-4" onclick="checkUserClicks(4)">4</td>
                    <td id="guess-5" onclick="checkUserClicks(5)">5</td>
                    <td id="guess-6" onclick="checkUserClicks(6)">6</td>
                </tr>

                <tr>
                    <td id="guess-7" onclick="checkUserClicks(7)">7</td>
                    <td id="guess-8" onclick="checkUserClicks(8)">8</td>
                    <td id="guess-9" onclick="checkUserClicks(9)">9</td>
                </tr>

                <tr>
                    <td colspan="3" id="btn_table" class="btn-success" onclick="Start()">Ready</td>
                </tr>
            </table>
        </div>


        <div class="col-lg-1 col-md-9 col-sm-9 col-xs-6"></div>


        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
            <table class="table" id="highscore">
                <tr>
                    <td colspan="2" id="highscore_title">High Score <a id="highscore_refresh"
                                                                       class="glyphicon glyphicon-refresh pull-right"
                                                                       onclick="refreshHighscore()"> </a></td>
                </tr>
                <tr>
                    <td>User</td>
                    <td>Level</td>
                </tr>

                <tr>
                    <td id="highscore_name_1">-</td>
                    <td id="highscore_level_1">-</td>
                </tr>

                <tr>
                    <td id="highscore_name_2">-</td>
                    <td id="highscore_level_2">-</td>
                </tr>

                <tr>
                    <td id="highscore_name_3">-</td>
                    <td id="highscore_level_3">-</td>
                </tr>

                <tr>
                    <td id="highscore_name_4">-</td>
                    <td id="highscore_level_4">-</td>
                </tr>

                <tr>
                    <td id="highscore_name_5">-</td>
                    <td id="highscore_level_5">-</td>
                </tr>

            </table>
        </div>

    </div>


</div>


<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script type="text/javascript" src="main-script.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="js/bootstrap.min.js"></script>
</body>
</html>