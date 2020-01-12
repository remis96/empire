<?php
require "header.php";
if (isset($_SESSION["userID"])) {
    header("Location: index.php");
    exit();
}
?>


    <div class="container">
        <div id="register-form">
            <div class="card card-container">
                <img id="profile-img" class="profile-img-card"
                     src="https://upload.wikimedia.org/wikipedia/commons/thumb/7/75/Emblem_of_the_First_Galactic_Empire.svg/600px-Emblem_of_the_First_Galactic_Empire.svg.png"
                     alt="img"/>
                <div class="panel">
                    <h2 class="center-align" id="register-info-header">Register</h2>
                    <p class="center-align" id="register-info">Provide your credentials</p>
                </div>

                <div id="signup-result"></div>
                <form class="form-signin" action="managment/signup.inc.php" method="post">
                    <span id="reauth-email" class="reauth-email"></span>
                    <input type="text" id="input-name" class="form-control" name="name" placeholder="Name">
                    <input type="text" id="input-surname" class="form-control" name="surname" placeholder="Surname">
                    <input type="text" id="input-username" class="form-control" name="username" placeholder="Username">
                    <input type="password" id="input-password" class="form-control" name="password"
                           placeholder="Password">
                    <input type="password" id="input-password-repeat" class="form-control" name="password-repeat"
                           placeholder="Repeat password">
                    <button id="signup-subm" type="button" class="btn btn-primary btn-block" name="signup-submit">Become
                        a soldier
                    </button>
                </form>
            </div>
        </div>
    </div>


    <script>

        $(function () {


            $("#signup-subm").on("click", function () {
                var name = $("#input-name").val();
                var surname = $("#input-surname").val();
                var username = $("#input-username").val();
                var password = $("#input-password").val();
                var passwordRepeat = $("#input-password-repeat").val();
                $.post("managment/signup.inc.php", "name=" + name + "&surname=" + surname + "&username=" + username + "&password=" + password + "&password-repeat=" + passwordRepeat, function (e) {
                    $("#signup-result").html(e);

                });
            });
        });


    </script>

<?php
ob_end_flush();
require "footer.php";
?>