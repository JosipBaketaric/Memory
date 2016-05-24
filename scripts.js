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
        $('#register_index_link').html("Go back");
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