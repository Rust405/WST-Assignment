
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Update Product Availability</title>
        <?php
        include ('adminheader.html');
        ?>

    </head>
    <body>
        <h1>Update Product Availability</h1>

        <form action="editProduct.php" method="post">
            <table>
                <tr>
                    <td>Product ID: </td>
                    <td><input type="hidden" name="productID" value=<?php //echo "$productID"; ?>><?php //echo "$productID"; ?></tr>
                <tr>
                <td>Product Name:</td>
                <td><input type="hidden" name="productName" value=<?php //echo "$productName"; ?>><?php //echo "$productName"; ?></td>
                </tr>
                <td>Product Details:</td>
                <td><input type="hidden" name="productDetail" value=<?php //echo "$productDetail"; ?> ><?php //echo "$productDetail"; ?></td>
                </tr>
                <tr>
                    <td>Stock Quantity:</td>
                    <td> <input type="number" name="stockQuantity" min="0" max="999999" ></td>
                </tr>
            </table>
            <input type='submit' name='submit' value='Add Product'>
            <button type="button"  onclick="window.location = 'admin.php'">Cancel</button> 



        </form>


    </body>
    <?php
    include ('adminfooter.html');
    ?>
</html>
