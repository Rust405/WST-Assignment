<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <?php
        include ('header.html');
        ?>
        <title><?php echo $_SESSION['userName']; ?></title>
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
            input[type=password]{
                width: 80%;
                padding: 14px;
                border: 1px solid #ccc;
                border-radius: 4px;
                resize: vertical;
            }
            input[type=tel]{
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
                margin-left:50%;
                margin-top:25px;
                margin-bottom:25px;
                box-shadow: 5px 5px 10px black;
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
                background-image:url('images/background2.jpg');
                background-repeat: no-repeat;
                background-size: 100% 100%;
            }
        </style>   
    </head>


    <body>
        <br>
        <div class = "containerForm">
            <h2>My Profile</h2> 

            <div class="row">
                <input type="submit" value="Logout" name="logout" onClick="window.location = 'login.php?logout=true'">
            </div>

            <br>
            <?php
            //insert into customer table
            require_once('mysqli_connect.php');
            $completed = false;
            $getCurrentDetails = "SELECT * FROM customer WHERE cust_id = " . $_SESSION['userID'];
            $result = @mysqli_query($dbc, $getCurrentDetails);
            while ($row = $result->fetch_object()) {
                $currentfname = $row->cust_fname;
                $currentlname = $row->cust_lname;
                $currentemail = $row->cust_email;
                $currentphone = $row->cust_phone;
            }

            //update changes
            if (isset($_POST['submit'])) {
                $fname = trim($_POST['fname']);
                $lname = trim($_POST['lname']);
                $email = trim($_POST['email']);
                $phone = trim($_POST['phone']);
                $password = trim($_POST['password']);
                $cpassword = trim($_POST['cpassword']);
                $error = false;
                $message = array();



                //validate name
                if ($fname == NULL) {
                    $error = true;
                    $message[] = "Please enter your <strong>first name</strong>.";
                }
                $namePattern = "/[A-Za-z]{1,30}$/";
                if ($fname != NULL && (preg_match($namePattern, $fname)) == false) {
                    $message[] = "<strong>First Name</strong> can contain only uppercase and lowercase alphabet.";
                    $error = true;
                }

                if ($lname == NULL) {
                    $error = true;
                    $message[] = "Please enter your <strong>last name</strong>.";
                }
                if ($lname != NULL && (preg_match($namePattern, $lname)) == false) {
                    $message[] = "<strong>Last Name</strong> can contain only uppercase and lowercase alphabet.";
                    $error = true;
                }

                //validate email
                if ($email == NULL) {
                    $message[] = "An <strong>e-mail</strong> is required to create an account.";
                    $error = true;
                }

                //email existence check
                $obtain = "SELECT * FROM customer";
                $result = mysqli_query($dbc, $obtain);
                while ($row = $result->fetch_object()) {
                    if ($email == $row->cust_email && $row->cust_id != $_SESSION['userID']) {
                        $error = true;
                        $message[] = "An account is already registered to this e-mail!";
                    }
                }

                //email existence check
                $obtain = "SELECT * FROM admin";
                $result = mysqli_query($dbc, $obtain);
                while ($row = $result->fetch_object()) {
                    if ($email == $row->admin_email) {
                        $error = true;
                        $message[] = "An account is already registered to this e-mail!";
                    }
                }

                //validate phone
                if ($phone == "+60" || $phone == NULL) {
                    $message[] = "A <strong>phone number</strong> is required to create an account.";
                    $error = true;
                }
                $phonePattern = "/^[+][6][0][0-9]{2}[0-9]{7,10}$/";
                if ($phone != NULL && (preg_match($phonePattern, $phone)) == false) {
                    $message[] = "Please ensure <strong>phone number</strong> follows the format: +60xxxxxxxxxxxx";
                    $error = true;
                }

                //validate password
                if ($password == NULL) {
                    $message[] = "A <strong>password</strong> is required to create an account.";
                }
                if (strlen($password) < 8) {
                    $message[] = "<strong>Password</strong> must contain at least <strong>8 characters</strong>!";
                    $error = true;
                }
                if (!preg_match("#[0-9]+#", $password)) {
                    $message[] = "<strong>Password</strong> must contain at least <strong>1 Number</strong>!";
                    $error = true;
                }
                if (!preg_match("#[A-Z]+#", $password)) {
                    $message[] = "<strong>Password</strong> must contain at least <strong>1 Capital Letter</strong>!";
                    $error = true;
                }
                if (!preg_match("#[a-z]+#", $password)) {
                    $message[] = "<strong>Password</strong> must contain at least <strong>1 Lowercase Letter</strong>!";
                    $error = true;
                }

                //validate confirm password
                if ($cpassword == NULL || $cpassword != $password) {
                    $message[] = "Please confirm your password/ Passwords do not match!";
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
                    //update
                    //encrupt password
                    $hash = password_hash($password, PASSWORD_DEFAULT, ['cost' => 12]);

                    $send = "UPDATE customer SET cust_fname='$fname',cust_lname='$lname',cust_password='$hash',cust_email='$email',cust_phone='$phone' WHERE cust_ID=" . $_SESSION['userID'];
                    mysqli_query($dbc, $send);


                    echo "<div class='ok'>Account details successfully updated.</div>";
                    $completed = true;
                }
            }




            @mysqli_close($dbc);
            ?>

            <form action="customerProfile.php" method="post">
                <div class="row">
                    <div class="col-25">
                        <label for="fname">First Name:</label>
                    </div>
                    <div class="col-75">
                        <input type="text" id="fname" name="fname" placeholder="John"
                               value="<?php
                               if (isset($_POST['fname'])) {
                                   echo $_POST['fname'];
                               } else
                                   echo "$currentfname";
                               ?>"
                               >
                    </div>
                </div>

                <div class="row">
                    <div class="col-25">
                        <label for="lname">Last Name:</label>
                    </div>
                    <div class="col-75">
                        <input   type="text" id="lname" name="lname" placeholder="Smith"
                                 value="<?php
                                 if (isset($_POST['lname'])) {
                                     echo $_POST['lname'];
                                 } else
                                     echo "$currentlname";
                                 ?>"
                                 >
                    </div>
                </div>

                <div class="row">
                    <div class="col-25">
                        <label for="email">E-mail:</label>
                    </div>
                    <div class="col-75">
                        <input   type="email" id="email" name="email" placeholder="E-mail..."
                                 value="<?php
                                 if (isset($_POST['email'])) {
                                     echo $_POST['email'];
                                 } else
                                     echo "$currentemail";
                                 ?>"
                                 >
                    </div>
                </div>

                <div class="row">
                    <div class="col-25">
                        <label for="phone">Phone Number:</label>
                    </div>
                    <div class="col-75">
                        <input   type="tel" id="phone" name="phone" 
                                 value="<?php
                                 if (isset($_POST['phone'])) {
                                     echo $_POST['phone'];
                                 } else
                                     echo "$currentphone";
                                 ?>">
                    </div>
                </div>


                <div class="row">
                    <h5>Enter current password to confirm changes or update password.</h5>
                    <div class="col-25">
                        <label for="password">Password:</label>
                    </div>
                    <div class="col-75">
                        <input   type="password" id="password" name="password" placeholder="Password..."
                                 value="<?php
                                 if (isset($_POST['password']) && $completed == false) {
                                     echo $_POST['password'];
                                 } else
                                     echo "";
                                 ?>"
                                 >
                    </div>
                </div>

                <div class="row">
                    <div class="col-25">
                        <label for="cpassword">Confirm Password:</label>
                    </div>
                    <div class="col-75">
                        <input  type="password" id="cpassword" name="cpassword" placeholder="Confirm Password..."

                                value="<?php
                                if (isset($_POST['cpassword']) && $completed == false) {
                                    echo $_POST['cpassword'];
                                } else
                                    echo "";
                                ?>"
                                >
                    </div>
                </div>
                <br>
                <div class="row">
                    <input type="submit" name="submit" value="Update Profile">
                </div>
            </form>
        </div>



    </body>





</body>
<?php
include ('footer.html');
?>
</html>
