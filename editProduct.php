
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Edit Product Details</title>
        <?php
        include ('adminheader.html');
        ?>

    </head>
    <body>
        <h1>Edit Product Details</h1>

        <form action="editProduct.php" method="post">
            <table>
                <tr>
                    <td>Product ID: </td>
                    <td><input type="hidden" name="productID" value=<?php //echo "$productID"; ?>><?php //echo "$productID"; ?></tr>
                <tr>
                <td>Product Name:</td>
                <td><input type="text" name="productName" maxlength="25"></td>
                </tr>
                <td>Product Details:</td>
                <td><input type="text" name="productDetail" maxlength="40"></td>
                </tr>
            </table>
            <input type='submit' name='submit' value='Add Product'>
            <button type="button"  onclick="window.location = 'admin.php'">Cancel</button> 



        </form>


    </body>
    <?php
    include ('footer.html');
    ?>
</html>
