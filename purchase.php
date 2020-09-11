<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Order Placed!</title>
        <?php
        include ('header.html');
        ?>
        <style>
            .successful{
                margin-left:20%;
                margin-right:20%;
                margin-top:6%;
                margin-bottom:6%;
                border-radius: 5px;
                padding:78px;
                color:#00045B;
                background-color: #f2f2f2;
                box-shadow: 10px 10px 5px #ccc;
            }
            button {
                background-color: #00045B;
                color: white;
                padding: 12px 20px;
                border: none;
                border-radius: 4px;
                cursor: pointer;
                font-size:12pt;
            }
            button:active {
                background-color: #FFEE64;
                color: black;
            } 
            button:hover{
                background-color: #ccc;
                color: black;
            }

        </style>
    </head>
    <body>

        <?php
        require_once('mysqli_connect.php');
        if (isset($_COOKIE['quantity'])) {
            $custID = trim($_SESSION['userID']);
            $productList = trim($_COOKIE['productID']);
            $orderQuantity = trim($_COOKIE['quantity']);
            $deliveryAddress = trim($_COOKIE['address']);
            $bankName = trim($_COOKIE['bank']);
            $cardNumber = trim($_COOKIE['card']);

            $date = date("d/m/Y");


            // echo "$custID<br>";
            // echo "$productList<br>";
            // echo "$orderQuantity<br>";
            // echo "$deliveryAddress<br>";
            // echo "$bankName<br>";
            //echo "$cardNumber<br>";


            $order = "INSERT INTO orders (cust_id,product_list,order_quantity,order_date,delivery_address,order_status) VALUES ('$custID','$productList','$orderQuantity','$date','$deliveryAddress','Order Pending')";

            //create order
            @mysqli_query($dbc, $order);


            //create payment
            //get order ID
            $orderID = "";
            $getOrderID = "SELECT * FROM orders WHERE cust_id='$custID' AND product_list='$productList' AND order_quantity='$orderQuantity'";
            $result = @mysqli_query($dbc, $getOrderID);

            if ($result) {
                while ($row = $result->fetch_object()) {
                    $orderID = $row->order_id;
                }
            }

            $pay = "INSERT INTO payment (order_id,bank_name,card_number) VALUES ('$orderID','$bankName','$cardNumber')";
            @mysqli_query($dbc, $pay);


            //delete cookies
            setcookie('productID', '', time() - 3600);
            setcookie('quantity', '', time() - 3600);
            setcookie('address', '', time() - 3600);
            setcookie('bank', '', time() - 3600);
            setcookie('card', '', time() - 3600);
        } else {
            echo "<p style='font-size:16pt'> You shouldn't have come here >:(  </p>";
        }






        @mysqli_close($dbc);
        ?>

        <div class="successful">
            <h1>Payment Successful</h1>
            <h2>Order Placed!</h2>


            <button onclick="window.location.href = 'home.php'">Home</button>
            <button onclick="window.location.href = 'browse.php'">Continue Shopping</button>


        </div>

    </body>
    <?php
    include ('footer.html');
    ?>
</html>



