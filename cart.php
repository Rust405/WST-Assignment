<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">

        <?php
        
        if(isset($_COOKIE['quantity'])){
            echo '<title>My Cart</title>';
        }
        else{
            echo '<title>Cart Empty</title>';
        }
        
        include ('header.html');
        ?>

        <style>
            .cartTable td,th {
                padding: 10px;
                border-radius: 5px;
                background-color: #f2f2f2;
                box-shadow: 10px 10px 5px #ccc;
                text-align:center;
                width: 100%;
            }
            .empty{
                padding: 10px;
                border-radius: 5px;
                background-color: #f2f2f2;
                box-shadow: 10px 10px 5px #ccc;
                text-align:center;
                width: 100%;  
            }
            .cart{
                margin-left:15%;
                margin-top:2%;
                margin-right:20%;
            }
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
            input[type=submit]:hover{
                background-color: #ccc;
                color: black;
            }
        </style>

    </head>
    <body>

        <div class="cart">
            <h1 style="padding:5px;">My Cart</h1>
            <?php
            require_once('mysqli_connect.php');
            // setcookie('productID', '', time() - 3600);
            // setcookie('quantity', '', time() - 3600);
            if (isset($_COOKIE['productID']) && isset($_COOKIE['quantity'])) {
                //declare once
                $productIDString = $_COOKIE['productID'];
                $quantityString = $_COOKIE['quantity'];

                $productIDArray = explode("|", $productIDString);
                $quantityArray = explode("|", $quantityString);

                $numberOfProduct = count($productIDArray);


                //remove
                if (isset($_GET['remove'])) {
                    $o = $_GET['remove'];
                    $l = 0;
                    unset($productIDArray[$o]);
                    unset($quantityArray[$o]);

                    while ($o < count($productIDArray) - 1) {
                        $productIDArray[$o] = $productIDArray[$o + 1];
                        $quantityArray[$o] = $quantityArray[$o + 1];
                        ++$indexToRemove;
                        ++$l;

                        unset($productIDArray[count($productIDArray) - $l]);
                        unset($quantityArray[count($quantityArray) - $l]);
                    }
                    $newCookieA = implode("|", $productIDArray);
                    $newCookieB = implode("|", $quantityArray);

                    setcookie('productID', '', time() - 3600);
                    setcookie('quantity', '', time() - 3600);
                    setcookie('productID', $newCookieA, time() + (60 * 60));
                    setcookie('quantity', $newCookieB, time() + (60 * 60));
                    echo '<script type="text/javascript">window.location="cart.php";</script>';
                }
                //declare again if deleted
                $productIDString = $_COOKIE['productID'];
                $quantityString = $_COOKIE['quantity'];

                $productIDArray = explode("|", $productIDString);
                $quantityArray = explode("|", $quantityString);

                $numberOfProduct = count($productIDArray);


                echo '<table class="cartTable">';
                echo '<tr>';
                echo '<th colspan="3">Product</th>';
                echo '<th>Quantity</th>';
                echo '<th>Price (RM)</th>';
                echo '<th>Subtotal (RM)</th>';
                echo '<tr>';

                $total = 0;

                for ($i = 0; $i < $numberOfProduct; $i++) {
                    echo '<tr>';
                    $q = "SELECT * FROM product WHERE prod_id =" . $productIDArray[$i];
                    $result = @mysqli_query($dbc, $q);

                    if ($result) {
                        while ($row = $result->fetch_object()) {
                            $productName = $row->prod_name;
                            $productPrice = $row->prod_price;
                        }
                    }
                    echo '<td style="width:5%;"><a href="cart.php?remove=' . $i . '">Remove</a></td>';
                    echo '<td style="width:20%;">' . '<img src="images/' . $productName . '.jpg" height="128px" width="128px">' . '</td>';
                    echo '<td style="width:80%;font-size:16pt;"><strong>' . $productName . '</strong></td>';
                    echo '<td style="width:20%;">' . $quantityArray[$i] . '</td>';
                    echo '<td style="width:20%;">';
                    printf("%.2f</td>", $productPrice);
                    printf("<td>%.2f</td>", $productPrice * $quantityArray[$i]);
                    $total += $productPrice * $quantityArray[$i];

                    echo '<tr>';
                }
                echo '<tr><td colspan="6" style="text-align:right;"><strong>Total = RM';
                printf("%.2f</strong></td></tr>", $total);

                echo '</table>';
                //show checkout button if logged in
                if (isset($_SESSION['userID'])) {
                    echo '<br><form action="checkout.php">
                <input type="submit" name="submit" value="Checkout">
            </form>';
                }
                if (isset($_SESSION['userID']) == false) {
                    echo '<br><p style="padding:3px;font-size:16pt;">Please <a href="login.php">login</a> or <a href="register.php">register</a> an account to checkout. Your items will remain in cart!</p><br><br><br><br><br>';
                }
            } else {
                setcookie('productID', '', time() - 3600);
                setcookie('quantity', '', time() - 3600);
                echo '<div class="empty" style="margin-bottom:17.5%;margin-top:17%;font-size:18pt;">Cart Empty. <a href="browse.php">Browse</a> for products.</div>';
            }
            ?>
            <br>

        </div>



    </body>
    <?php
    include ('footer.html');
    ?>
</html>
