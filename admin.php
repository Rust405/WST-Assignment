<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>View Customer</title>
        <?php
        include ('adminheader.html');
        ?>
        <script type="text/javascript" src="scripts/jquery-1.9.1.js"></script>

        <script type="text/javascript">
            $(document).ready(function () {

                $("#showDelete").click(function () {
                    $("#delete").removeClass("hide");
                });
                $("#showDelete").click(function () {
                    $("#showDelete").addClass("hide");
                });

            });

        </script>
           <style>
            .hide{
                display:none;
            }
            #showList:hover{
                cursor:pointer;
            }
            #showDelete:hover{
                cursor:pointer;
            }
            input[type=submit],button{
                background-color:#00045B;
                color:#FFEE64;
                padding:8px;
                border-radius:5px;
            }

        </style>
    </head>
    <body>
        <h1 style="margin-left:5%;">Customer Records</h1>

        <?php
        require_once('mysqli_connect.php');

        // -------------- VIEW PRODUCT --------------- //
        $order = 1;
        $column = "";
        $arrangement = "";
        $sorting = "";

        if (empty($_GET['column']) == false) {
            $column = " ORDER BY " . $_GET['column'];
            $sorting = $_GET['column'];
        }

        if (isset($_GET['order']) == true) {
            $order = $_GET['order'];
        }
        if ($order > 3)
            $order = 1;
        if ($order == 1)
            $arrangement = "";
        else if ($order == 2)
            $arrangement = " ASC";
        else if ($order == 3)
            $arrangement = " DESC";

        $q = "SELECT * FROM customer" . $column . $arrangement;
        $result = @mysqli_query($dbc, $q);

        if (isset($_POST['check'])) { //if checkboxes clicked
            $checked = $_POST['check']; //assign checked boxes to array
            if (isset($_POST['submit'])) { //if delete clicked
                //assign id array
                $i = 0; //counter

                foreach ($checked as $c) {
                    $i += 1; //increment counter
                    $del = "DELETE FROM customer WHERE cust_id = '$c';";
                    mysqli_query($dbc, $del); //delete checked record
                }
                //count message
                echo "<p class='ok'>";
                echo "<strong>$i</strong> records have been deleted.";
                echo "[<a href=admin.php>Refresh</a>]";
                echo "</p>";
            }
        }
        //no checks
        if (isset($_POST['check']) == false) {
            if (isset($_POST['submit'])) {//if clicked
                echo "<p class='notok' style='margin-left:5%'>  <strong>  Nothing selected!</strong> [<a href=admin.php>Refresh</a>]</p>";
            }
        }

        echo '<form  style="margin-left:5%;" onSubmit="return sendForm();" action="admin.php" method="post">';

        echo "<table style='text-align:left' border='1' cellspacing='0' cellpadding='5'>";
        echo "<tr>";
        echo "<th>";
        echo "</th>";

        echo "<th><a href=admin.php?column=cust_id&order=";
        $x = $order + 1;
        if ($x > 3) {
            $x = 1;
        }
        echo $x . '>Customer ID';
        if ($order == 2 && $_GET['column'] == "cust_id")
            echo ' &#x25B2;';
        if ($order == 3 && $_GET['column'] == "cust_id")
            echo ' &#x25BC;';
        echo '</a></th>';

        echo "<th><a href=admin.php?column=cust_fname&order=";
        $x = $order + 1;
        if ($x > 3) {
            $x = 1;
        }
        echo $x . '>Customer First Name';
        if ($order == 2 && $_GET['column'] == "cust_fname")
            echo ' &#x25B2;';
        if ($order == 3 && $_GET['column'] == "cust_fname")
            echo ' &#x25BC;';
        echo '</a></th>';

        echo "<th><a href=admin.php?column=cust_lname&order=";
        $x = $order + 1;
        if ($x > 3) {
            $x = 1;
        }
        echo $x . '>Customer Last Name';
        if ($order == 2 && $_GET['column'] == "cust_lname")
            echo ' &#x25B2;';
        if ($order == 3 && $_GET['column'] == "cust_lname")
            echo ' &#x25BC;';
        echo '</a></th>';

        echo "<th><a href=admin.php?column=cust_email&order=";
        $x = $order + 1;
        if ($x > 3) {
            $x = 1;
        }
        echo $x . '>Customer Email';
        if ($order == 2 && $_GET['column'] == "cust_email")
            echo ' &#x25B2;';
        if ($order == 3 && $_GET['column'] == "cust_email")
            echo ' &#x25BC;';
        echo '</a></th>';

        echo "<th><a href=admin.php?column=cust_phone&order=";
        $x = $order + 1;
        if ($x > 3) {
            $x = 1;
        }
        echo $x . '>Customer Phone';
        if ($order == 2 && $_GET['column'] == "cust_phone")
            echo ' &#x25B2;';
        if ($order == 3 && $_GET['column'] == "cust_phone")
            echo ' &#x25BC;';
        echo '</a></th>';

        if ($result) {
            while ($row = $result->fetch_object()) {
                echo "<tr>";
                echo "<td><input type='checkbox' name=check[] value=$row->cust_id></td>"; //send id as checked value
                echo "<td>$row->cust_id</td>";
                echo "<td>$row->cust_fname</td>";
                echo "<td>$row->cust_lname</td>";
                echo "<td>$row->cust_email</td>";
                echo "<td>$row->cust_phone</td>";
                echo "</tr>";
            }
        }

        printf('
            <tr>
                <td colspan="6">
                    %d record(s) returned.
                </td>
            </tr>',
                @mysqli_num_rows($result));
        echo '</table>';

        echo '<br><a style="background-color:#00045B;color:#FFEE64;border-radius:4px;padding:10px;" id="showDelete">Delete Selected</a>';
        echo "<div id='delete' class='hide'><br><input type='submit' name='submit' value='Confirm Delete'>";
        echo '&nbsp<button type="button" onclick="window.location=';
        echo "'admin.php'";
        echo'">Cancel</button>';
        echo "</div>";
        echo "</form>";

        @mysqli_free_result($r);
        @mysqli_free_result($result);
        @mysqli_close($dbc);
        ?>

    </body>
    <?php
    include ('adminfooter.html');
    ?>
</html>
