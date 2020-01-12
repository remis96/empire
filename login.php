<?php
require "header.php";
if (isset($_SESSION["userID"])) {
    header("Location: index.php");
    exit();
}
?>


<div class="container">
    <div id="login-card" class="card card-container">
        <img id="profile-img" class="profile-img-card"
             src="https://upload.wikimedia.org/wikipedia/commons/thumb/7/75/Emblem_of_the_First_Galactic_Empire.svg/600px-Emblem_of_the_First_Galactic_Empire.svg.png"
             alt="img"/>
        <p id="profile-name" class="profile-name-card"></p>

        <div class="panel">
            <h2 class="center-align" id="register-info-header">Login</h2>
            <p class="center-align" id="register-info">Provide your credentials</p>
        </div>

        <div id="login-result"></div>
        <form class="form-signin" action="managment/login.inc.php" method="post">
            <input type="text" id="login-username" class="form-control" name="username" placeholder="Username">
            <input type="password" id="login-password" class="form-control" name="password" placeholder="Password">
            <button id="login-submit" type="button" class="btn btn-primary btn-block">Join the Empire</button>
        </form>
    </div>

</div>
<script>
    $(function () {
        $("#login-submit").on("click", function () {
            var username = $("#login-username").val();
            var password = $("#login-password").val();
            $.post("managment/login.inc.php", "username=" + username + "&password=" + password, function (e) {
                if (e === "success") {
                    location.href = "index.php";
                } else if (e === "nosuccess") {
                    location.href = "index.php";
                } else {
                    $("#login-result").html(e);
                }
            })
        });
        $(document).keypress(function (e) {
            if (e.which == 13) {
                var username = $("#login-username").val();
                var password = $("#login-password").val();
                $.post("managment/login.inc.php", "username=" + username + "&password=" + password, function (e) {
                    if (e === "success") {
                        location.href = "index.php";
                    } else if (e === "nosuccess") {
                        location.href = "index.php";
                    } else {
                        $("#login-result").html(e);
                    }
                })
            }
        });
    });


</script>

<?php
ob_end_flush();
require "footer.php";
?>

