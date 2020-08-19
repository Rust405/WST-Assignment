<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Add New Product</title>
        <?php
        include ('adminheader.html');
        ?>

    </head>
    <body>
        <h1>Current Products</h1>
        <h2>~display products table~</h2>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent id blandit ex. Fusce a varius erat, non interdum lectus. Sed quis hendrerit mauris, a vehicula nunc.
            Maecenas dictum tincidunt pellentesque. Pellentesque placerat dolor sit amet neque feugiat faucibus. Donec non velit at leo sodales fermentum et sed mi.
            Phasellus ultrices nisl a ornare suscipit. Aliquam elementum ultricies erat ac vulputate. Pellentesque dignissim augue ut est pellentesque, sit amet fermentum erat egestas.
            Nunc ullamcorper, nunc in tincidunt dapibus, purus turpis vestibulum turpis,
            eu tincidunt odio lectus nec dui. Ut a arcu erat. </p>
        ~product~<a href="editProduct.php">Edit Product Details</a> <a href="updateStock.php">Update Product availability</a>



        <h1>Add New Product</h1>

        <form action="addProduct.php" method="post">
            <table>
                <tr>
                    <td>Product ID: </td>
                    <td><input type="text" name="productID" maxlength="6"></td>
                </tr>
                <tr>
                    <td>Product Name:</td>
                    <td><input type="text" name="productName" maxlength="25"></td>
                </tr>
                <td>Product Details:</td>
                <td><input type="text" name="productDetail" maxlength="40"></td>
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
    include ('footer.html');
    ?>
</html>
