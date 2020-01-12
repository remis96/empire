<?php
require "header.php";
require "managment/dbConnection.php";
?>


    <div class="input-wrapper">
        <div id="result-training"></div>


        <div id="crud">
            <div class="panel panel-default text-center">
                <div class="panel-heading">Create</div>
                <div class="panel-body training-reg-panel-body">
                    <input id="msg" type="text" class="form-control" placeholder="Name">
                </div>
                <button id="add-training" type="button" class="btn btn-success ">Create training</button>
                <br>
                <br>


            </div>
        </div>

        <div id="crud">
            <div class="panel panel-default text-center">
                <div class="panel-heading">Delete</div>
                <div class="panel-body training-reg-panel-body">
                    <div class="form-group">
                        <select name="task-option" class="form-control" id="sel1">
                        </select>
                    </div>
                </div>
                <button id="delete-training" type="button" class="btn btn-success  ">Delete training</button>
                <br>
                <br>
            </div>
        </div>


        <div id="crud">
            <div class="panel panel-default text-center">
                <div class="panel-heading">Update</div>
                <div class="panel-body">
                    <div class="form-group">
                        <select name="task-option" class="form-control" id="sel2">

                        </select>

                        <br>
                        <input type="text" class="form-control" id="training-to-rename">
                    </div>
                </div>
                <button id="rename-training" type="button" class="btn btn-success">Update training</button>
                <br>
                <br>
            </div>

        </div>

    </div>

    <script>

        $(function () {
            loadTraining();
            fillRenameInput();

            $("#add-training").on("click change", function () {
                if ($("#msg").val().length === 0) {
                    $("#result-training").html("<div class='alert alert-danger'><span class='glyphicon glyphicon-warning-sign'></span> No name!</div>");
                } else {
                    $.post("managment/requestMng.inc.php", "action=ADD-TRAINING&training-name=" + $("#msg").val(), function (e) {

                        $("#result-training").html("<div class='alert alert-success'><span class='glyphicon glyphicon-ok'></span> Training <strong>" + $("#msg").val() + "</strong> Created</div>");
                        $("#msg").val("");
                        loadTraining();
                    });
                }
            });

            $("#delete-training").on("click", function () {
                if ($("#sel1 option").length === 0) {
                    $("#result-training").html("<div class='alert alert-danger'><span class='glyphicon glyphicon-warning-sign'></span>Nothing to delete</div>")
                } else {
                    $.post("managment/requestMng.inc.php", "action=DEL-TRAINING&training-id=" + $("#sel1").val(), function (e) {
                        $("#result-training").html("<div class='alert alert-success'><span class='glyphicon glyphicon-trash'></span> Training <strong>" + $("#sel1 option:selected").text() + "</strong> Deleted</div>");
                        loadTraining();
                    });
                }
            });

            $("#rename-training").on("click", function () {
                if ($("#sel2 option").length === 0) {
                    $("#result-training").html("<div class='alert alert-danger'><span class='glyphicon glyphicon-warning-sign'></span> Nothing to rename</div>")
                } else if ($("#training-to-rename").val().length === 0) {
                    $("#result-training").html("<div class='alert alert-danger'><span class='glyphicon glyphicon-warning-sign'></span> Type the name</div>")
                } else if ($("#sel2 option:selected").text() === $("#training-to-rename").val()) {
                    $("#result-training").html("<div class='alert alert-danger'><span class='glyphicon glyphicon-warning-sign'></span> Nothing changed</div>")
                } else {
                    $.post("managment/requestMng.inc.php", "action=RENAME-TRAINING&training-id=" + $("#sel2").val() + "&training-name=" + $("#training-to-rename").val(), function (e) {
                        $("#result-training").html("<div class='alert alert-success'><span class='glyphicon glyphicon-ok'></span> Training <strong>" + $("#sel2 option:selected").text() + "</strong> renamed to <strong>" + $("#training-to-rename").val() + "</strong> </div>");
                        $("#training-to-rename").val("");
                        loadTraining();
                    });
                }
            });

            function loadTraining() {
                $.get("managment/requestMng.inc.php", "action=GET-TRAINING-OPTION", function (e) {
                    $("#sel1").html(e);
                    $("#sel2").html(e);
                    fillRenameInput();
                });
            }


            $("#sel2").on("change", function () {
                fillRenameInput();
            });

            function fillRenameInput() {
                $("#training-to-rename").val($("#sel2 option:selected").text());
            }

        });
    </script>

<?php
require "footer.php";
?>