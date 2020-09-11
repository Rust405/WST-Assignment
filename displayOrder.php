<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>View Orders</title>
        <?php
        include ('adminheader.html');
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
            select {
                width: 18%;
                padding: 5px;
                border: 1px solid #ccc;
                border-radius: 4px;
                resize: vertical;
            }

            button[type=submit] {
                width: 6%;
                padding: 5px;
                border: 1px solid #ccc;
                border-radius: 4px;
                resize: vertical;
                box-sizing: border-box;
            }
            button[type=submit]:active {
                background-color: #FFEE64;
                color: black;
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


            .container {
                border-radius: 5px;
                background-color: #f2f2f2;
                padding: 10px;
                box-sizing: border-box;
                box-shadow: 10px 10px 5px #ccc;
            }


            /* Clear floats after the columns */
            .row:after {
                content: "";
                display: table;
                clear: both;
            }

            /* Responsive layout - when the screen is less than 600px wide, make the two columns stack on top of each other instead of next to each other */
            @media screen and (max-width: 600px) {
                button[type=submit] {
                    width: 90%;
                    margin-top: 4px;
                }
                input[type=text]{
                    width:88%;
                    margin-top: 4px;

                }
            }



        </style>
    </head>
    <body>
        <div class="container">
            <form action="displayOrder.php" method="GET">
                <div class="row">
                    <label for="sortby">Sort By:</label>
                    <select name="sortby">
                        <?php
                        if (isset($_GET['sortby'])) {

                            if ($_GET['sortby'] == "IDASC") {
                                echo ' <option value="IDASC">Order ID, ascending</option>'
                                . '<option value="none">None</option>'
                                . '<option value="IDDEC">Order ID, descending</option>';
                            }
                            if ($_GET['sortby'] == "IDDEC") {
                                echo '<option value="IDDEC">Order ID, descending</option>'
                                . '<option value="none">None</option>'
                                . '<option value="IDASC">Order ID, ascending</option>';
                            }
                            if ($_GET['sortby'] == "none") {
                                echo '<option value="none">None</option>'
                                . '<option value="IDASC">Order ID, ascending</option>'
                                . '<option value="IDDEC">Order ID, descending</option>';
                            }
                        }
                        if (isset($_GET['sortby']) == false) {
                            echo '<option value="none">None</option>'
                            . '<option value="IDASC">Order ID, ascending</option>'
                            . '<option value="IDDEC">Order ID, descending</option>';
                        }
                        ?>

                    </select>


                    <a class="search-container">
                        <input type="text" placeholder="Search Order ID" name="search" value="<?php
                        if (isset($_GET['search'])) {
                            $search = $_GET['search'];
                            echo "$search";
                        }
                        ?>">
                        <button type="submit" ><i class="fa fa-search"></i></button>
                    </a>
                </div>
            </form>
        </div>
        <br>
        <?php
        require_once('mysqli_connect.php');
        $orderID = array();
        $custID = array();
        $productID = array();
        $quantity = array();
        $orderDate = array();
        $address = array();
        $status = array();

        $columnName = "";
        $order = "";
        $where = "";
        $sort = NULL;
        $search = NULL;

        if (isset($_GET['search'])) {
            $search = $_GET['search'];
            $where = "WHERE order_id LIKE '%" . "$search" . "%'";
        }

        if (isset($_GET['sortby'])) {
            $sort = $_GET['sortby'];
            if ($sort == "none") {
                $columnName = ""; //which column
                $order = "";
            }
            if ($sort == "IDASC") {
                $columnName = " ORDER BY order_id "; //which column
                $order = "ASC";
            }
            if ($sort == "IDDEC") {
                $columnName = " ORDER BY order_id "; //which column
                $order = "DESC";
            }
        }

        $q = "SELECT * from orders " . " $where " . " $columnName " . " $order ";

        $result = @mysqli_query($dbc, $q);
        $numOfResult = @mysqli_num_rows($result);

        if ($numOfResult == 0) {
            echo "<p>&nbsp; No such order(s) exists!</p>";
        }

        if ($numOfResult > 0) {
            echo "<table style='margin-left:20%;margin-right:20%;' cellspacing='0' border='1' >";

            $i = 0;
            //get details
            if ($result) {
                while ($row = $result->fetch_object()) {
                    $orderID[$i] = $row->order_id;
                    $custID[$i] = $row->cust_id;
                    $productID[$i] = $row->product_list;
                    $quantity[$i] = $row->order_quantity;
                    $orderDate[$i] = $row->order_date;
                    $address[$i] = $row->delivery_address;
                    $status[$i] = $row->order_status;
                    ++$i;
                }
            }

            echo '<tr>';
            echo '<th>Order ID</th>';
            echo '<th>Customer ID</th>';
            echo '<th>Product List</th>';
            echo '<th>Order Quantity</th>';
            echo '<th>Order Date</th>';
            echo '<th>Delivery Address</th>';
            echo '<th>Order Status</th>';
            echo '<th></th>';

            echo '</tr>';

            for ($i = 0; $i < $numOfResult; $i++) {
                echo "<tr>";
                echo '<td>' . $orderID[$i] . '</td>';
                echo '<td>' . $custID[$i] . '</td>';
                echo '<td>' . $productID[$i] . '</td>';
                echo '<td>' . $quantity[$i] . '</td>';
                echo '<td>' . $orderDate[$i] . '</td>';
                echo '<td>' . $address[$i] . '</td>';
                echo '<td>' . $status[$i] . '</td>';
                echo '<td><a href="updateOrder.php?id=' . $orderID[$i] . '">UPDATE</a></td>';

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
    include ('adminfooter.html');
    ?>
</html>
