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

        var intervalID = setInterval(function () {
            if (x < level) {
                numbers[x] = Math.floor((Math.random() * 9) + 1);
                ID = tempID.concat(numbers[x].toString());

                document.getElementById(ID).style.backgroundColor = "green";

                var WaiteABit = setInterval(function () {
                    if (wait === 1) {
                        wait = 0;

                        document.getElementById(ID).style.backgroundColor = "white";
                        setOnHoover(ID);

                        window.clearInterval(WaiteABit);
                    }
                    wait = 1;
                }, 300);

            }

            if (++x == (level + 1)) {
                isReady = 1;
                x = 0;
                document.getElementById('btn_table').innerHTML = "Select numbers";
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
            numberCounter = 0;
            numbers = [];
            isReady = 0;
            updateLevel();
        }
        else if (number == numbers[numberCounter]) {
            numberCounter++;
        }
        else {
            //Wrong number
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

            }else{
                window.location.replace("index.php");
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
                level = parseInt(html["msg"]);
                document.getElementById("lvl_td").innerHTML = "Level: " + level;
            }//Else
        }
    });//End of async fetch
    refreshHighscore();

};
