<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Update Order</title>
        <?php
        include ('adminheader.html');
        ?>
        <script type="text/javascript" src="scripts/jquery-1.9.1.js"></script>

        <script type="text/javascript">
            $(document).ready(function () {

                $("#showDelete").click(function () {
                    $("#delete").removeClass("hide");
                });
                $("#showDelete").click(function () {
                    $("#showDelete").addClass("hide");
                });

            });

        </script>
        <style>
            input[type=submit],button{
                background-color:#00045B;
                color:#FFEE64;
                padding:8px;
                border-radius:5px;
            }
            .hide{
                display:none;
            }

            #showDelete:hover{
                cursor:pointer;
            }

        </style>
    </head>
    <body>
        <h1 style="margin-left:5%;">Update Order</h1>

        <?php
        require_once('mysqli_connect.php');
        //get order details
        if (isset($_GET['id'])) {
            $orderID = $_GET['id'];
        }
        if (isset($_POST['id'])) {
            $orderID = $_POST['id'];
        }
        $q = "SELECT * FROM orders WHERE order_id=" . "$orderID";

        $result = @mysqli_query($dbc, $q);
        if ($result) {
            while ($row = $result->fetch_object()) {
                $custID = $row->cust_id;
                $productID = $row->product_list;
                $quantity = $row->order_quantity;
                $orderDate = $row->order_date;
                $address = $row->delivery_address;
                $status = $row->order_status;
            }
        }
        $productIDArray = explode("|", $productID);
        $quantityArray = explode("|", $quantity);


        //get list of product names
        $productName = array();
        for ($i = 0; $i < count($productIDArray); $i++) {
            $q = "SELECT * FROM product WHERE prod_id=" . "$productIDArray[$i]";
            $r = @mysqli_query($dbc, $q);
            while ($row = $r->fetch_object()) {
                $productName[$i] = $row->prod_name;
            }
        }

        //get customer name
        $customerName = NULL;
        $q = "SELECT * FROM customer WHERE cust_id=" . "$custID";
        $r = @mysqli_query($dbc, $q);
        while ($row = $r->fetch_object()) {
            $fname = $row->cust_fname;
            $lname = $row->cust_lname;
        }
        $customerName = $fname . " " . $lname;


        //form >delete >change order status
        //change order status
        if (isset($_POST['submit']) && $_POST['submit'] == "Update Order") {
            $orderStatus = $_POST['status'];
            $updateStatus = "UPDATE orders SET order_status = '$orderStatus' WHERE order_id = '$orderID'";
            @mysqli_query($dbc, $updateStatus);
            echo '<div style="margin-left:5%;background-color:LightBlue; color:DarkBlue; border: solid 1px; margin-right: 68%; padding-left:10px; padding-top:10px; padding-bottom:10px;">';
            echo '<b>Order ID ' . $orderID . '</b> has been updated. <br>[<a href=displayOrder.php> Return to Order List </a>]';
            echo '</div><br>';
        }

        //delete order
        if (isset($_POST['submit']) && $_POST['submit'] == "Confirm Delete") {

            $del2 = "DELETE FROM payment WHERE payment_id=" . "'$orderID'";
            @mysqli_query($dbc, $del2);
            $del = "DELETE FROM orders WHERE order_id=" . "'$orderID'";
            @mysqli_query($dbc, $del);


            echo '<div style="margin-left:5%;background-color:LightBlue; color:DarkBlue; border: solid 1px; margin-right: 68%; padding-left:10px; padding-top:10px; padding-bottom:10px;">';
            echo '<b>Order ID ' . $orderID . '</b> has been deleted. <br>[<a href=displayOrder.php> Return to Order List </a>]';
            echo '</div><br>';
        }




        @mysqli_close($dbc);
        ?>

        <form style="margin-left:5%;width:600px;" action="updateOrder.php" method="post">
            <table border='1'cellspacing='0' style="width:600px;">
                <tr>
                    <td>Order ID </td>
                    <td>
                        <input type="hidden" name="id" 
                               value="<?php echo "$orderID"; ?>"> <?php echo "$orderID"; ?> </td>
                    </td>
                </tr>
                <tr>
                    <td>Customer</td>
                    <td><?php echo $customerName; ?></td>

                </tr>

                <tr>
                    <td>Product(s) </td>
                    <td><?php
                        for ($i = 0; $i < count($productName); $i++) {
                            echo "<b>(" . $quantityArray[$i] . ")</b> " . $productName[$i];
                            if ($i < count($productName) - 1) {
                                echo ", ";
                            }
                        }
                        ?></td>
                </tr>
                <tr>
                    <td>Order Date</td>
                    <td><?php echo $orderDate; ?></td>   
                </tr>
                <tr>
                    <td>Deliver Address</td>
                    <td><?php echo $address; ?></td>
                </tr>
                <tr>
                    <td>Order Status</td>
                    <td>
                        <select name='status'>
                            <option><?php
                                if (isset($_POST['status'])) {
                                    echo $_POST['status'];
                                } else {
                                    echo $status;
                                }
                                ?>
                            </option>
                            <option>Order Pending</option>
                            <option>Order Being Processed</option>
                            <option>Out for Delivery</option>
                            <option>Order Delivered</option>
                            <option>Cancelled</option>
                        </select>

                    </td>

                </tr>

            </table>

            <br>
            <input type='submit' name='submit' value='Update Order'>

            <button type="button"  onclick="window.location = 'displayOrder.php'">Cancel</button> 
            <a style="margin-top:20px;background-color:#00045B;color:#FFEE64;border-radius:4px;padding:10px;" id="showDelete">Delete</a>
            <div id='delete' class='hide'>
                <br>
                <input style="margin-left:12%;width:180px;" type='submit' name='submit' value='Confirm Delete'>
            </div>
        </form>

    </body>
    <?php
    include ('adminfooter.html');
    ?>
</html>
