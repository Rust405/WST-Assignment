
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Edit Product Details</title>
        <?php
        include ('adminheader.html');
        ?>
        <style>
            input[type=text]{
                width: 200px;
                padding: 6px;
                border: 1px solid black;
                border-radius: 4px;
                resize: vertical;
            }
            input[type=number]{
                width: 200px;
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
        </style>

    </head>
    <body>
        <h1 style="margin-left:5%;">Edit Product Details</h1>

        <?php
        require_once('mysqli_connect.php');
        $id = NULL;

        if (isset($_GET['id'])) {
            $id = $_GET['id'];
        }
        if (isset($_POST['id'])) {
            $id = $_POST['id'];
        }

        $q = "SELECT * FROM product WHERE prod_id = '$id'";
        $r = @mysqli_query($dbc, $q);

        while ($row = $r->fetch_object()) {
            $id = $row->prod_id;
            $name = $row->prod_name;
            $description = $row->prod_description;
            $price = $row->prod_price;
        }

        if (isset($_POST['submit'])) {
            $name = trim($_POST['productName']);
            $description = trim($_POST['productDescription']);
            $price = trim($_POST['productPrice']);
            $id = trim($_POST['productID']);
            $message1 = NULL;
            $message2 = NULL;
            $message3 = NULL;
            $ok = true;

            if ($name != NULL && (preg_match("/[A-Za-z _@,'.-\/]{1,50}$/", $name)) == false) {
                $message1 = "<b>Product Name</b> contains invalid letters or symbols.";
                $ok = false;
            }
            if ($_POST['productName'] == NULL) {
                $message1 = "Please enter <b>Product Name</b>.";
                $ok = false;
            }

            if ($_POST['productDescription'] == NULL) {
                $message2 = "Please enter <b>Product Description</b>.";
                $ok = false;
            }

            if ($_POST['productPrice'] == NULL) {
                $message3 = "Please enter <b>Product Price</b>.";
                $ok = false;
            }

            if ($ok == false) {
                echo '<ul style="margin-left:5%;background-color:#ffd1d1; color:darkred; border: solid 1px; margin-right: 70%; padding-top:10px; padding-bottom:10px;">';
                if ($message1 != NULL)
                    echo "<li>$message1</li>";
                if ($message2 != NULL)
                    echo "<li>$message2</li>";
                if ($message3 != NULL)
                    echo "<li>$message3</li>";
                echo '</ul>';
            }

            if ($ok == true) {
          
                $edit = "UPDATE product SET prod_name = '$name', prod_description = '$description', prod_price = '$price' WHERE prod_id ='$id'";
                @mysqli_query($dbc, $edit);
                
                echo '<div style="margin-left:5%;background-color:LightBlue; color:DarkBlue; border: solid 1px; margin-right: 68%; padding-left:10px; padding-top:10px; padding-bottom:10px;">';
                echo '<b>' . $name . '</b> has been edited. <br>[<a href=addProduct.php> Return to Product List </a>]';
                echo '</div>';
            }
        }
        @mysqli_free_result($r);
        @mysqli_close($dbc);
        ?>


        <form style="margin-left:5%;" action="editProduct.php" method="post">
            <table >
                <tr>
                    <td>Product ID:</td>
                    <td><input type="hidden" name="productID" 
                               value="<?php echo "$id"; ?>"> <?php echo "$id"; ?> </td>
                </tr>
                <tr>
                    <td>Product Name:</td>
                    <td><input type="text" name="productName" maxlength="50" value="<?php echo $name; ?>"/></td>
                </tr>
                <tr>
                    <td>Product Description:</td>
                    <td>
                        <textarea rows="5" col="50" name="productDescription"><?php echo $description; ?></textarea>
                </tr>
                <tr>
                    <td>Product Price:</td>
                    <td>RM <input type="number" name="productPrice" min="0.01" step="0.01" value="<?php echo $price; ?>"/></td>
                </tr>
            </table>
            <br>
            <input type='submit' name='submit' value='Update Product Details'>

            <button type="button"  onclick="window.location = 'admin.php'">Cancel</button> 

        </form>


    </body>
<?php
include ('footer.html');
?>
</html>
