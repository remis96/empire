<?php
require "header.php";
require "managment/dbConnection.php";
?>


    <div class="input-wrapper">

        <div id="result-gear"></div>


        <div id="crud">
            <div class="panel panel-default text-center">
                <div class="panel-heading">Create</div>
                <div class="panel-body gear-reg-panel-body">
                    <input id="msg" type="text" class="form-control" placeholder="Name">
                </div>
                <button id="add-gear" type="button" class="btn btn-success ">Create gear</button>
                <br>
                <br>


            </div>
        </div>

        <div id="crud">
            <div class="panel panel-default text-center">
                <div class="panel-heading">Delete</div>
                <div class="panel-body gear-reg-panel-body">
                    <div class="form-group">
                        <select name="task-option" class="form-control" id="sel1">
                        </select>
                    </div>
                </div>
                <button id="delete-gear" type="button" class="btn btn-success  ">Delete gear</button>
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
                        <input type="text" class="form-control" id="gear-to-rename">
                    </div>
                </div>
                <button id="rename-gear" type="button" class="btn btn-success">Update gear</button>
                <br>
                <br>
            </div>

        </div>

    </div>

    <script>

        $(function () {
            loadGear();
            fillRenameInput();

            $("#add-gear").on("click change", function () {
                if ($("#msg").val().length === 0) {
                    $("#result-gear").html("<div class='alert alert-danger'><span class='glyphicon glyphicon-warning-sign'></span> No name!</div>");
                } else {
                    $.post("managment/requestMng.inc.php", "action=ADD-GEAR&gear-name=" + $("#msg").val(), function (e) {

                        $("#result-gear").html("<div class='alert alert-success'><span class='glyphicon glyphicon-ok'></span> Gear <strong>" + $("#msg").val() + "</strong> Created</div>");
                        $("#msg").val("");
                        loadGear();
                    });
                }
            });

            $("#delete-gear").on("click", function () {
                if ($("#sel1 option").length === 0) {
                    $("#result-gear").html("<div class='alert alert-danger'><span class='glyphicon glyphicon-warning-sign'></span>Nothing to delete</div>")
                } else {
                    $.post("managment/requestMng.inc.php", "action=DEL-GEAR&gear-id=" + $("#sel1").val(), function (e) {
                        $("#result-gear").html("<div class='alert alert-success'><span class='glyphicon glyphicon-trash'></span> Gear <strong>" + $("#sel1 option:selected").text() + "</strong> Deleted</div>");
                        loadGear();
                    });
                }
            });

            $("#rename-gear").on("click", function () {
                if ($("#sel2 option").length === 0) {
                    $("#result-gear").html("<div class='alert alert-danger'><span class='glyphicon glyphicon-warning-sign'></span> Nothing to rename</div>")
                } else if ($("#gear-to-rename").val().length === 0) {
                    $("#result-gear").html("<div class='alert alert-danger'><span class='glyphicon glyphicon-warning-sign'></span> Type the name</div>")
                } else if ($("#sel2 option:selected").text() === $("#gear-to-rename").val()) {
                    $("#result-gear").html("<div class='alert alert-danger'><span class='glyphicon glyphicon-warning-sign'></span> Nothing changed</div>")
                } else {
                    $.post("managment/requestMng.inc.php", "action=RENAME-GEAR&gear-id=" + $("#sel2").val() + "&gear-name=" + $("#gear-to-rename").val(), function (e) {
                        $("#result-gear").html("<div class='alert alert-success'><span class='glyphicon glyphicon-ok'></span> Training <strong>" + $("#sel2 option:selected").text() + "</strong> renamed to <strong>" + $("#gear-to-rename").val() + "</strong> </div>");
                        $("#gear-to-rename").val("");
                        loadGear();
                    });
                }
            });

            function loadGear() {
                $.get("managment/requestMng.inc.php", "action=GET-GEAR-OPTION", function (e) {
                    $("#sel1").html(e);
                    $("#sel2").html(e);
                    fillRenameInput();
                });
            }

            $("#sel2").on("change", function () {
                fillRenameInput();
            });

            function fillRenameInput() {
                $("#gear-to-rename").val($("#sel2 option:selected").text());
            }

        });
    </script>

<?php
require "footer.php";
?>