<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">

        <?php
        include ('header.html');
        ?>
        <style>
            input[type=submit] {
                background-color: #00045B;
                color: white;
                padding: 12px 20px;
                border: none;
                border-radius: 4px;
                cursor: pointer;
                width:100%;
                font-size:12pt;
            }
            input[type=submit]:active {
                background-color: #FFEE64;
                color: black;
            }


        </style>
    </head>
    <body>
        <br>
        <a style="text-decoration:none;" href="browse.php">&nbsp<strong>←return to browse products..</strong></a>
        <form action="product.php" method="post">
            <?php
            require_once('mysqli_connect.php');
            $productID = NULL;
            $productName = NULL;
            $productDescription = NULL;
            $productStock = NULL;
            $productPrice = NULL;

            if (isset($_GET['id'])) {
                $productID = $_GET['id'];
            }

            if (isset($_POST['productID'])) {
                $productID = $_POST['productID'];
            }


            $q = "SELECT * FROM product WHERE prod_id =" . $productID;
            $result = @mysqli_query($dbc, $q);

            if ($result) {
                while ($row = $result->fetch_object()) {
                    $productName = $row->prod_name;
                    $productDescription = $row->prod_description;
                    $productStock = $row->prod_stock;
                    $productPrice = $row->prod_price;
                }
            }
            echo "<title>$productName</title>";
            echo '<input type="hidden" name="productID" value="' . $productID . '">';

            echo '<table style="width:60%;margin-bottom:1.5%;margin-top:1%;margin-left:20%;">';
            echo "<tr>";
            echo '<td rowspan="5">';
            echo '<img style="margin-right:40px;box-shadow: 10px 10px 5px #ccc;border:2px solid black;" src="images/' . $productName . '.jpg" height="400px" width="400px">';
            echo "</td>";
            echo '<td colspan="2" style="text-decoration:underline;font-family:serif;color:#00045B;font-size:26pt;"><strong>' . $productName . '</strong></td>';
            echo "</tr>";

            echo "<tr>";
            echo '<td colspan="2" >' . $productDescription . '</td>';
            echo "</tr>";

            echo "<tr>";
            printf("<td><strong>Price: </strong>RM%.2f</td>", $productPrice);
            echo '<td>Quantity:  <input type="number" name="quantity" min="1" max="20" value="1"></td>';
            echo "</tr>";

            echo "<tr>";
            echo '<td><strong>Stock:</strong> ' . $productStock . '</td>';
            echo '<td><input onClick="added()" type="submit" name="submit" value="Add to Cart"></td>';
            echo "</tr>";
            echo "</table>";

            @mysqli_close($dbc);
            ?>


        </form>
        <?php
        if (isset($_POST['submit'])) {
            $productID = $_POST['productID'];
            $quantity = $_POST['quantity'];

            //first cookie/cookie doesnt exist
            if (isset($_COOKIE['productID']) == false && isset($_COOKIE['quantity']) == false) {
                setcookie('productID', $productID);
                setcookie('quantity', $quantity);
            }

            //if cookie already exists
            if (isset($_COOKIE['productID']) && isset($_COOKIE['quantity'])) {
                $addproductID = $_COOKIE['productID'] . "|" . $productID;
                $addquantity = $_COOKIE['quantity'] . "|" . $quantity;
                setcookie('productID', $addproductID, time() + (60 * 60));
                setcookie('quantity', $addquantity, time() + (60 * 60));
            }
        }
        ?>
        <script>
            function added() {
                alert("Product added to cart!");
            }
        </script>

    </body>
    <?php
    include ('footer.html');
    ?>
</html>
