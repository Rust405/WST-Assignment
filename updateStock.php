
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Update Product Availability</title>
        <?php
        include ('adminheader.html');
        ?>
        <style>
            input[type=submit],button{
                background-color:#00045B;
                color:#FFEE64;
                padding:8px;
                border-radius:5px;
            }
        </style>
    </head>
    <body>
        <h1 style="margin-left:5%;">Update Product Availability</h1>

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

        if ($r) {
            while ($row = $r->fetch_object()) {
                $id = $row->prod_id;
                $name = $row->prod_name;
                $description = $row->prod_description;
                $price = $row->prod_price;
                $stock = $row->prod_stock;
            }
        }

        if (isset($_POST['submit'])) {
            $stock = $_POST['productStock'];
            $message1 = NULL;
            $ok = true;


            if ($_POST["productStock"] == NULL) {
                $message1 = "Please enter <b>Product Stock</b>.";
                $ok = false;
            }

            if ($ok == false) {
                echo '<ul style="margin-left:5%;background-color:#ffd1d1; color:darkred; border: solid 1px; margin-right: 70%; padding-top:10px; padding-bottom:10px;">';
                if ($message1 != NULL)
                    echo "<li>$message1</li>";
                echo '</ul>';
            }

            if ($ok == true) {
                echo '<div style="margin-left:5%;background-color:LightBlue; color:DarkBlue; border: solid 1px; margin-right: 68%; padding-left:4px; padding-top:10px; padding-bottom:10px;">';
                echo '<b>' . $name . '</b> stock has been updated. <br>[<a href=addProduct.php> Return to Product List </a>]';
                echo '</div>';

                $update = "UPDATE product SET prod_stock = '$stock' WHERE prod_id = '$id'";
                mysqli_query($dbc, $update);
            }
        }

        @mysqli_close($dbc);
        ?>

        <form style="margin-left:5%;width:40%" action="updateStock.php" method="post">
            <table  cellpadding="5">
                <tr>
                    <td>Product ID:</td>
                    <td><input type="hidden" name="id" value="<?php echo $id; ?>"><?php echo "$id"; ?></td>
                </tr>
                <tr>
                    <td>Product Name:</td>
                    <td><?php echo $name; ?> </td>
                </tr>
                <tr>
                    <td>Product Description:</td>
                    <td > <?php echo $description; ?> </td>
                </tr>
                <tr>
                    <td>Product Price:</td>
                    <td> <?php printf("RM %.2f", $price); ?> </td>
                </tr>
                <tr>
                    <td>Stock Quantity:</td>
                    <td> <input type="number" name="productStock" min="0" max="999999" value="<?php echo $stock; ?>"/></td>
                </tr>
            </table>
            <input type='submit' name='submit' value='Update Stock'>
            <button type="button"  onclick="window.location = 'addProduct.php'">Cancel</button> 

        </form>

    </body>
    <?php
    include ('adminfooter.html');
    ?>
</html>
