<?php
require "header.php";
?>

<?php
if (!isset($_SESSION["userID"]) || $_SESSION["userID"] != "1") {
    header("Location: index.php");
    exit();
}
?>


<div id="delete-form">
    <div class="card card-container">

        <div id="delete-user-result"></div>
        <label for="sel3">Choose :</label>
        <select name="task-option" class="form-control" id="sel3">

        </select>
        <br>
        <button id="delete-user" type="button" class="btn btn-primary btn-block">Execute soldier</button>
    </div>
</div>


<script>

    $(function () {
        loadUsers();

        $("#delete-user").on("click", function () {
            if ($("#sel3 option").length === 0) {
                $("#delete-user-result").html("<div class='alert alert-danger'><span class='glyphicon glyphicon-warning-sign'></span> Soldier not present</div>")
            } else {

                $.post("managment/requestMng.inc.php", "action=DEL-USER&user-id=" + $("#sel3").val(), function (e) {
                    $("#delete-user-result").html("<div class='alert alert-success'><span class='glyphicon glyphicon-trash'></span> User <strong>" + $("#sel3 option:selected").text() + "</strong> executed</div>");
                    loadUsers();

                });
            }
        });

        function loadUsers() {
            $.get("managment/requestMng.inc.php", "action=GET-USER", function (e) {
                $("#sel3").html(e);
            });
        }
    });

</script>


<?php
require "footer.php";
?>
