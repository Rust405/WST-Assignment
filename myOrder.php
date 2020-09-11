<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>My Orders</title>
        <?php
        include ('header.html');
        //test
        ?>

        <style>
            input[type=text] {
                width: 20%;
                padding: 5px;
                border: 1px solid #ccc;
                border-radius: 4px;
                resize: vertical;
            }

            label {
                padding: 12px 12px 12px 0;
                display: inline-block;
            }

            input[type=submit] {
                background-color: #4CAF50;
                color: white;
                padding: 12px 20px;
                border: none;
                border-radius: 4px;
                cursor: pointer;
                float: right;
            }

            .orderTable td{
                font-size:15pt;
                color: #00045B;
                background-color: #f2f2f2;
                padding: 20px;
                box-sizing: border-box;
                box-shadow: 10px 10px 5px #ccc;

            }
            .orderTable th{
                font-size:15pt;
                color: #00045B;
                background-color: #f2f2f2;

                box-sizing: border-box;
                box-shadow: 10px 10px 5px #ccc;
                border-radius: 5px;
            }
            body{
                background-image:url('images/background2.jpg');
                background-repeat: no-repeat;
                background-size: 100% 100%;
            }


        </style>
    </head>
    <body>
        <br>
        <?php
        require_once('mysqli_connect.php');
        $custID = $_SESSION['userID'];
        $quantity = array();
        $orderDate = NULL;
        $status = NULL;
        $productOD = array();

        $columnName = "";
        $order = "";
        $where = "";
        $sort = NULL;
        $search = NULL;

        $q = "SELECT * from orders WHERE cust_id=" . "'$custID'";

        $result = @mysqli_query($dbc, $q);
        $numOfResult = @mysqli_num_rows($result);

        if ($numOfResult == 0) {
            echo "<p>&nbsp; No pending order(s)!</p>";
        }

        if ($numOfResult > 0) {
            echo "<table class='orderTable' style='margin-top:4%;margin-bottom:6%;margin-left:20%;margin-right:20%;' >";

            $i = 0;
            //get details
            if ($result) {
                while ($row = $result->fetch_object()) {
                    $productID[$i] = $row->product_list;
                    $quantity[$i] = $row->order_quantity;
                    $orderDate[$i] = $row->order_date;
                    $status[$i] = $row->order_status;
                    ++$i;
                }
            }

            echo '<tr>';

            echo '<th>Products</th>';
            echo '<th>Order Date</th>';
            echo '<th>Order Status</th>';

            echo '</tr>';

            for ($i = 0; $i < $numOfResult; $i++) { //for every order
                echo "<tr>";

                echo '<td>';
                $productIDArray = explode("|", $productID[$i]);
                $quantityArray = explode("|", $quantity[$i]);
                $productName = array();
                for ($j = 0; $j < count($productIDArray); $j++) {
                    $q = "SELECT * FROM product WHERE prod_id=" . "$productIDArray[$j]";
                    $r = @mysqli_query($dbc, $q);
                    while ($row = $r->fetch_object()) {
                        $productName[$j] = $row->prod_name;
                    }
                }
                for ($k = 0; $k < count($productName); $k++) {
                    echo "<b>(" . $quantityArray[$k] . ")</b> " . $productName[$k];
                    if ($k < count($productName) - 1) {
                        echo ", ";
                    }
                }
                echo '</td>';

                echo '<td style="width:10%;">' . $orderDate[$i] . '</td>';

                echo '<td style="width:20%;">' . $status[$i] . '</td>';

                echo "</tr>";
            }
            echo "<tr><td colspan='8'>$numOfResult records returned</td></tr>";

            echo "</table>";
        }

        @mysqli_free_result($result);
        @mysqli_close($dbc);
        ?>





    </body>

    <?php
    include ('footer.html');
    ?>
</html>
