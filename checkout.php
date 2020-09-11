<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Checkout</title>
        <?php
        include ('header.html');
        if (isset($_GET['address'])) {
            setcookie('address', trim($_GET['address']));
            setcookie('bank', trim($_GET['bank']));
            setcookie('card', trim($_GET['card']));
            echo '<script type="text/javascript">window.location="purchase.php";</script>';
        }
        ?>
        <style>
            input[type=text]{
                width: 80%;
                padding: 14px;
                border: 1px solid #ccc;
                border-radius: 4px;
                resize: vertical;
            }
            input[type=email]{
                width: 80%;
                padding: 14px;
                border: 1px solid #ccc;
                border-radius: 4px;
                resize: vertical;
            }
            select,option{
                width: 80%;
                padding: 14px;
                border: 1px solid #ccc;
                border-radius: 4px;
                resize: vertical;
            }

            label {
                padding: 12px 12px 12px 0;
                display: inline-block;
            }

            input[type=submit] {
                background-color: #00045B;
                color: white;
                padding: 12px 20px;
                border: none;
                border-radius: 4px;
                cursor: pointer;
                float: right;
                width:45%;
                font-size:12pt;
            }

            input[type=submit]:hover {
                background-color: #ccc;
                color: black;
            }
            input[type=submit]:active {
                background-color: #FFEE64;
                color: black;
            }


            .containerForm {
                box-sizing: border-box;
                border-radius: 5px;
                background-color: #f2f2f2;
                padding: 20px;
                margin-right:10%;
                margin-left:10%;
                border: 3px solid #00045B;
                margin-top:25px;
                margin-bottom:25px;
                box-shadow: 4px 4px 6px black;
            }

            .col-25 {
                float: left;
                width: 25%;
                margin-top: 6px;
                font-size:11pt;
            }

            .col-75 {
                float: left;
                width: 75%;
                margin-top: 6px;
            }

            .row:after {
                content: "";
                display: table;
                clear: both;

            }


            /* Responsive layout - when the screen is less than 600px wide, make the two columns stack on top of each other instead of next to each other */
            @media screen and (max-width: 1000px) {
                .col-25, .col-75, input[type=submit] {
                    width: 100%;
                    margin-top: 0;
                }
            }
            body{
                background-image:url('images/background4.jpg');
                background-repeat: no-repeat;
                background-size: 100% 100%;
            }
        </style>


    </head>
    <body>
        <div class = "containerForm">
            <h1>Checkout</h1>
            <h2>Billing Information</h2>

            <?php
            require_once('mysqli_connect.php');
            $completed = false;
            $currentName = NULL;
            $currentemail = NULL;
            if (isset($_SESSION['userID'])) {
                $getCurrentDetails = "SELECT * FROM customer WHERE cust_id = " . $_SESSION['userID'];
                $result = @mysqli_query($dbc, $getCurrentDetails);
                while ($row = $result->fetch_object()) {
                    $currentfname = $row->cust_fname;
                    $currentlname = $row->cust_lname;
                    $currentemail = $row->cust_email;
                }
                $currentName = $currentfname . " " . $currentlname;

                //process input
                if (isset($_POST['submit'])) {
                    $address = trim($_POST['address']);
                    $bank = trim($_POST['bankName']);
                    $card = trim($_POST['bankNumber']);
                    $message = array();
                    $error = false;

                    if ($address == NULL) {
                        $message[] = "<strong>Delivery address</strong> required to make purchases.";
                        $error = true;
                    }

                    if ($card == NULL) {
                        $message[] = "<strong>Card number</strong> required to make purchases.";
                        $error = true;
                    }
                    $cardPattern = "/^[0-9]{4}[-][0-9]{4}[-][0-9]{4}[-][0-9]{4}$/";
                    if ($card != NULL && (preg_match($cardPattern, $card)) == false) {
                        $message[] = "Please ensure <strong>card number</strong> follows the format: xxxx-xxxx-xxxx-xxxx";
                        $error = true;
                    }

                    if ($error == true) {
                        echo "<ul class='notok'>";
                        foreach ($message as $m) {
                            echo "<li>$m</li>";
                        }
                        echo "</ul>";
                    }

                    if ($error == false) {
                        $completed = true;
                        echo '<script type="text/javascript">window.location="checkout.php?address=' . $address . '&bank=' . $bank . '&card=' . $card . '";</script>';
                    }
                }

                @mysqli_close($dbc);
            } else {
                echo "<p style='font-size:16pt'> You shouldn't have come here >:(  </p>";
            }
            ?>

            <form action="checkout.php" method="post">

                <div class="row">
                    <div class="col-25">
                        <label for="name">Name:</label>
                    </div>
                    <div class="col-75">
                        <p name="name"><?php echo $currentName; ?></p>
                    </div>
                </div>


                <div class="row">
                    <div class="col-25">
                        <label for="email">E-mail:</label>
                    </div>
                    <div class="col-75">
                        <p name="email"><?php echo $currentemail; ?></p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-25">
                        <label for="address">Delivery Address:</label>
                    </div>
                    <div class="col-75">
                        <input   type="text" id="email" name="address" placeholder="Address..."
                                 value="<?php
                                 if (isset($_POST['address']) && $completed == false) {
                                     echo $_POST['address'];
                                 } else
                                     echo "";
                                 ?>"
                                 >
                    </div>
                </div>
                <h2>Payment</h2>
                <div class="row">
                    <div class="col-25">
                        <label for="bankName">Bank:</label>
                    </div>
                    <div class="col-75">
                        <select name="bankName" id="bankName">
                            <option value="CIMB">CIMB</option>
                            <option value="MayBank">MayBank</option>
                            <option value="Public Bank">Public Bank</option>
                            <option value="Hong Leong Bank">Hong Leong Bank</option>
                            <option value="AmBank">AmBank</option>
                        </select>

                    </div>
                </div>
                <div class="row">
                    <div class="col-25">
                        <label for="bankNumber">Bank Number: </label>
                    </div>
                    <div class="col-75">
                        <input   type="text" id="bankNumber" name="bankNumber" maxlength="20" placeholder="xxxx-xxxx-xxxx-xxxx"
                                 value="<?php
                                 if (isset($_POST['bankNumber']) && $completed == false) {
                                     echo $_POST['bankNumber'];
                                 } else
                                     echo "";
                                 ?>"
                                 >
                    </div>
                </div>
                <br>
                <div class="row">
                    <input type="submit" name="submit" value="Place Order">

                </div>

                <div class="row">
                    <a href="cart.php">Cancel</a>
                </div>

            </form>

        </div>

    </body>
    <?php
    include ('footer.html');
    ?>
</html>
