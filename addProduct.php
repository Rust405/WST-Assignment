<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Products</title>
        <?php
        include ('adminheader.html');
        ?>
        <script type="text/javascript" src="scripts/jquery-1.9.1.js"></script>

        <script type="text/javascript">
            $(document).ready(function () {

                $("#showList").click(function () {
                    $("#list").removeClass("hide");
                });
                $("#showDelete").click(function () {
                    $("#delete").removeClass("hide");
                });
                $("#showDelete").click(function () {
                    $("#showDelete").addClass("hide");
                });

            });

        </script>
        <style>
            input[type=text]{
                width: 100%;
                padding: 6px;
                border: 1px solid black;
                border-radius: 4px;
                resize: vertical;
            }
            input[type=number]{
                width: 100%;
                padding: 6px;
                border: 1px solid black;
                border-radius: 4px;
                resize: vertical;
            }
            textarea{
                resize:none;
                width: 100%; 
                font-size:11pt;
            }

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
        <h1 style="margin-left:5%;">Current Products</h1>
        <h5 id="showList" style="margin-top:-8px;margin-left:5%;margin-right:89%;background-color:#00045B;color:#FFEE64;border-radius:4px;padding:10px;">Show List</h5>

        <?php
        require_once('mysqli_connect.php');
        $ok = true;
        $ok2 = true;
        // -------------- VIEW PRODUCT --------------- //
        $order = 1;
        $column = "";
        $arrangement = "";
        $sorting = "";

        if (isset($_GET['column'])) {
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

        $q = "SELECT * FROM product" . $column . $arrangement;
        $result = @mysqli_query($dbc, $q);

        if (isset($_POST['check'])) { //if checkboxes clicked
            $checked = $_POST['check']; //assign checked boxes to array
            if (isset($_POST['submit']) && $_POST['submit'] == "Confirm Delete") { //if delete clicked
                //assign id array
                $i = 0; //counter

                foreach ($checked as $c) {
                    $i += 1; //increment counter
                    $del = "DELETE FROM product WHERE prod_id = '$c';";
                    @mysqli_query($dbc, $del); //delete checked record
                }
                //count message
                echo '<p class="ok" style="margin-left:5%;margin-right:60%;">';
                echo "<strong>$i</strong> records have been deleted.";
                echo "[<a href=addProduct.php>Refresh</a>]";
                echo "</p>";
            }
        }
        //no checks
        if (isset($_POST['check']) == false) {
            if (isset($_POST['submit']) && $_POST['submit'] == "Confirm Delete") {//if clicked
                echo "<p class='notok' style='margin-left:5%;'>  <strong>Nothing selected!</strong> [<a href=addProduct.php>Refresh</a>]</p>";
            }
        }

        echo '<form class="hide" id = "list" onSubmit="return sendForm();" action="addProduct.php" method="post">';

        echo '<table style="text-align:left;margin-left:5%;margin-right:5%;" border="1" cellspacing="0" cellpadding="5">';
        echo "<tr>";
        echo "<th>";
        echo "</th>";

        echo "<th><a href=addProduct.php?column=prod_id&order=";
        $x = $order + 1;
        if ($x > 3) {
            $x = 1;
        }
        echo $x . '>Product ID';
        if ($order == 2 && $_GET['column'] == "prod_id")
            echo ' &#x25B2;';
        if ($order == 3 && $_GET['column'] == "prod_id")
            echo ' &#x25BC;';
        echo '</a></th>';

        echo "<th><a href=addProduct.php?column=prod_name&order=";
        $x = $order + 1;
        if ($x > 3) {
            $x = 1;
        }
        echo $x . '>Product Name';
        if ($order == 2 && $_GET['column'] == "prod_name")
            echo ' &#x25B2;';
        if ($order == 3 && $_GET['column'] == "prod_name")
            echo ' &#x25BC;';
        echo '</a></th>';

        echo "<th><a href=addProduct.php?column=prod_description&order=";
        $x = $order + 1;
        if ($x > 3)
            $x = 1;
        echo $x . '>Product Description';
        if ($order == 2 && $_GET['column'] == "prod_description")
            echo ' &#x25B2;';
        if ($order == 3 && $_GET['column'] == "prod_description")
            echo ' &#x25BC;';
        echo '</a></th>';

        echo "<th><a href=addProduct.php?column=prod_stock&order=";
        $x = $order + 1;
        if ($x > 3)
            $x = 1;
        echo $x . '>Stock';
        if ($order == 2 && $_GET['column'] == "prod_stock")
            echo ' &#x25B2;';
        if ($order == 3 && $_GET['column'] == "prod_stock")
            echo ' &#x25BC;';
        echo '</a></th>';

        echo "<th><a href=addProduct.php?column=prod_price&order=";
        $x = $order + 1;
        if ($x > 3)
            $x = 1;
        echo $x . '>Product Price';
        if ($order == 2 && $_GET['column'] == "prod_price")
            echo ' &#x25B2;';
        if ($order == 3 && $_GET['column'] == "prod_price")
            echo ' &#x25BC;';
        echo '</a></th>';
        echo "<th>Action</th>";
        if ($result) {
            while ($row = $result->fetch_object()) {
                echo "<tr>";
                echo "<td><input type='checkbox' name=check[] value=$row->prod_id></td>"; //send id as checked value
                echo '<td style="width:9%;">' . $row->prod_id . '</td>';
                echo '<td style="width:15%;">' . $row->prod_name . '</td>';
                echo '<td style="width:30%;">' . $row->prod_description . '</td>';
                echo '<td style="width:6%;">' . $row->prod_stock . '</td>';
                echo "<td>$row->prod_price</td>";
                echo "<td><a href=editProduct.php?id=$row->prod_id>Edit Product Details</a> | <a href=updateStock.php?id=$row->prod_id>Update Product availability</a></td>";
                echo "</tr>";
            }
        }

        printf('
            <tr>
                <td colspan="7">
                    %d record(s) returned.
                </td>
            </tr>',
                @mysqli_num_rows($result));
        echo '</table>';
        echo '<br><a style="margin-left:5%;background-color:#00045B;color:#FFEE64;border-radius:4px;padding:10px;" id="showDelete">Delete Selected</a>';
        echo "<div id='delete' class='hide'><br><input style='margin-left:5%;' type='submit' name='submit' value='Confirm Delete'>";
        echo '&nbsp<button type="button" onclick="window.location=';
        echo "'addProduct.php'";
        echo'">Cancel</button>';
        echo "</div>";
        echo "</form>";
        ?>

        <h1 style="margin-left:5%;">Add New Product</h1>

        <?php
        require_once('mysqli_connect.php');
// -------------- ADD PRODUCT --------------- //
        $message = array(); //for messages

        if (isset($_POST['submit']) && $_POST['submit'] == "Add Product") {
            $prod_name = trim($_POST['productName']);
            $prod_description = trim($_POST['productDescription']);
            $prod_stock = trim($_POST['productStock']);
            $prod_price = trim($_POST['productPrice']);


            if ($prod_name != NULL && (preg_match("/[A-Za-z _@,'.-\/]{1,50}$/", $prod_name)) == false) {
                $message[] = '<p class="notok" style="padding-left:10px;"><b>Product Name</b> contains invalid letters or symbols.</p>';
                $ok = false;
            }
            if ($_POST['productName'] == NULL) {
                $message[] = '<p class="notok" style="padding-left:10px;">Please enter <b>Product Name</b>.</p>';
                $ok = false;
            }

            if ($_POST['productDescription'] == NULL) {
                $message[] = '<p class="notok" style="padding-left:10px;">Please enter <b>Product Description</b>.</p>';
                $ok = false;
            }

            if ($_POST['productStock'] == NULL) {
                $message[] = '<p class="notok" style="padding-left:10px;">Please enter <b>Product Stock</b>.</p>';
                $ok = false;
            }

            if ($prod_price != NULL && $prod_price < 0) {
                $message[] = '<p class="notok" style="padding-left:10px;">Invalid <b>Product Price</b> value.</p>';
                $ok = false;
            }
            if ($_POST['productPrice'] == NULL) {
                $message[] = '<p class="notok" style="padding-left:10px;">Please enter <b>Product Price</b>.</p>';
                $ok = false;
            }

            // -------------- INSERT PRODUCT IMAGE --------------- //

            if (isset($_FILES['productImage'])) {
                $currentName = $_FILES['productImage']['tmp_name']; //temporary file name
                $ext = pathinfo($_FILES['productImage']['name'], PATHINFO_EXTENSION); //get extension of original file
                $newName = $prod_name . ".jpg"; //assign new file as id + extension

                if (($ext == "jpg") && $_FILES['productImage']['size'] <= 1000000) {
                    $ok2 = true;
                    move_uploaded_file($currentName, "images/" . $newName); //move tmp file to images
                }
                //upload failed
                else {
                    $message[] = '<p class = "notok" style = "padding-left:10px;">Upload failed/No image uploaded</p>';
                    //wrong file extension
                    if ($ext != "jpg" && $ext != "") {
                        $message[] = '<p class = "notok" style = "padding-left:10px;">Invalid extension.' . $ext . '! Only JPG accepted.</p>';
                        $ok2 = false;
                    }
                    //exceed max size
                    if ($_FILES['productImage']['size'] > 1000000) {
                        $message[] = '<p class = "notok" style = "padding-left:10px;">File cannot exceed 1MB!</p>';
                        $ok2 = false;
                    }
                }
                //already exists
                if (file_exists($_FILES['productImage']['tmp_name']) && is_file($_FILES['productImage']['tmp_name'])) {
                    unlink($_FILES['productImage']['tmp_name']);
                }
            }

            if ($ok == true && $ok2 == true) {
                $message[] = '<p style ="background-color:#cce6ff;color:#0066cc;border:solid 1px #0066cc;margin-right:55%;line-height: 2em;"><b>' . $prod_name . '</b> has been added.<br> [<a href = addProduct.php> Click Here to Refresh </a>]</p>';

                $insert = "INSERT INTO product (prod_name, prod_description, prod_stock, prod_price)VALUES('$prod_name','$prod_description','$prod_stock','$prod_price')";
                mysqli_query($dbc, $insert);

                $message[] = '<p style ="background-color:#cce6ff;color:#0066cc;border:solid 1px #0066cc;margin-right:55%;line-height: 2em;">Image uploaded successfully.<br> It is saved as [<a target = "_blank" href = "uploads/' . $newName . '">' . $newName . '</a>].</p>';
            }

            // -------------- DISPLAY MESSAGE --------------- //

            foreach ($message as $m) {
                echo '<div class="notok" style="margin-left:5%;">' . $m . '</div>';
            }
        }
        @mysqli_close($dbc);
        ?>

        <form enctype="multipart/form-data" action="addProduct.php" method="post">
            <table style="margin-left:5%;">
                <tr>
                    <td>Product Name:</td>
                    <td><input type="text" name="productName" maxlength="50" value="<?php
                        if (isset($_POST['productName']) && $ok == false || $ok2 == false) {
                            echo "$prod_name";
                        }
                        ?>"></td>
                </tr>
                <tr>
                    <td>Product Description:</td>
                    <td>
                        <textarea rows="5" col="50" name="productDescription"><?php
                            if (isset($_POST['productDescription']) && $ok == false || $ok2 == false) {
                                echo "$prod_description";
                            }
                            ?></textarea>


                    </td>
                </tr>
                <tr>
                    <td>Product Stock:</td>
                    <td> <input type="number" name="productStock" min="0" max="999999" value="<?php
                        if (isset($_POST['productStock']) && $ok == false || $ok2 == false) {
                            echo "$prod_stock";
                        }
                        ?>"></td>
                </tr>
                <tr>
                    <td>Product Price:</td>
                    <td> <input type="number" name="productPrice" min="0.01" step="0.01" value="<?php
                        if (isset($_POST['productPrice']) && $ok == false || $ok2 == false) {
                            echo "$prod_price";
                        }
                        ?>"></td>
                </tr>
                <tr>
                    <td>Product Image:</td>
                    <td> <input type="file" name="productImage"></td>
                </tr>
            </table>
            <input style="margin-left:5%;" type='submit' name='submit' value='Add Product'>
            <button type="button"  onclick="window.location = 'addProduct.php'">Cancel</button> 

        </form>

    </body>
    <?php
    include ('adminfooter.html');
    ?>
</html>
