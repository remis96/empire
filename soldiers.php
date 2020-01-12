<?php
include "managment/dbConnection.php";
?>
<?php
require "header.php";
ob_start();
?>
<div class="container">
    <!-- Modal -->
    <div class="modal fade" id="empModal" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">User Info</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>

<br/>
<div class="table-wrap">


<table class="table table-dark">

    <tr>
        <th>Username</th>
        <th>&nbsp;</th>
    </tr>
    <?php
    $query = "select * from users";
    $result = mysqli_query($conn, $query);
    while ($row = mysqli_fetch_array($result)) {
        $id = $row['id'];
        $username = $row['username'];

        echo "<tr>";
        echo "<td>" . $username . "</td>";

        echo "<td><button data-id='" . $id . "' class='userinfo-btn'>Info</button></td>";
        echo "</tr>";
    }
    ?>
</table>
</div>

<?php
ob_end_flush();
require "footer.php";
?>


