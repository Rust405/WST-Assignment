<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Login</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?php
        //start session for login
        include ('header.html');
        require_once('mysqli_connect.php');
        ?>
        <style>
            input[type=email]{
                width: 70%;
                padding: 14px;
                border: 1px solid #ccc;
                border-radius: 4px;
                resize: vertical;
            }
            input[type=password]{
                width: 70%;
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
                padding: 45px;
                margin-right:10%;
                margin-left:50%;
                border: 4px solid #00045B;
                margin-top:78px;
                margin-bottom:78px;
                box-shadow: 4px 4px 6px black;
            }

            .col-25 {
                float: left;
                width: 25%;
                margin-top: 6px;
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
        <div class="containerForm">

            <?php
            if (isset($_GET['logout'])) {
                $_SESSION = array();
                session_destroy();
                echo '<script type="text/javascript">window.location="home.php";</script>';
            }

            //compare with customer table
            $completed = false;
            require_once('mysqli_connect.php');

            if (isset($_POST['submit'])) {
                $email = trim($_POST['email']);
                $password = trim($_POST['password']);
                $error = false;
                $message = array();

                $logonName;
                $userType;   //whether or not to go to admin home page
                //validate email
                if ($email == NULL) {
                    $message[] = "Please enter your <strong>e-mail</strong>.";
                    $error = true;
                }

                //validate password
                if ($password == NULL) {
                    $message[] = "Please enter your <strong>password</strong>.";
                    $error = true;
                }

                if ($error == true) {
                    echo "<ul class='notok'>";
                    foreach ($message as $m) {
                        echo "<li>$m</li>";
                    }
                    echo "</ul>";
                }

                //no submit error
                if ($error == false) {
                    //compare with customer and admin database
                    $checkCustomer = "SELECT * FROM customer";
                    $checkAdmin = "SELECT * FROM admin";

                    $checkC = mysqli_query($dbc, $checkCustomer);
                    $checkA = mysqli_query($dbc, $checkAdmin);

                    //check customer table
                    while ($row = $checkC->fetch_object()) {
                        if ($email == $row->cust_email) {
                            $logonName = $row->cust_fname;
                            $getPassword = $row->cust_password;
                            $logonUserID = $row->cust_id;
                            $userType = "customer";
                            break;
                        } else {
                            $logonName = NULL; //not customer
                        }
                    }
                    //if not customer, then check admin table
                    if ($logonName == NULL) {
                        while ($row = $checkA->fetch_object()) {
                            if ($email == $row->admin_email) {
                                $logonName = $row->admin_name;
                                $getPassword = $row->admin_password;
                                $logonUserID = $row->admin_id;
                                $userType = "admin";
                                break;
                            } else {
                                $logonName = NULL;
                            }
                        }
                    }

                    //if user does not exist
                    if ($logonName == NULL) {
                        echo "<div class='notok'>User does not exist!</div>";
                    }

                    //if user exists
                    if ($logonName != NULL) {
                        //password check
                        if (password_verify($password, $getPassword)) {
                            $completed = true;

                            $_SESSION['userName'] = "$logonName";
                            $_SESSION['userType'] = "$userType";
                            $_SESSION['userID'] = "$logonUserID";

                            if ($userType == "customer") {
                                echo '<script type="text/javascript">window.location="home.php";</script>';
                            }
                            if ($userType == "admin") {
                                echo '<script type="text/javascript">window.location="admin.php";</script>';
                            }
                        } else {
                            echo '<ul><li class="notok">Password is incorrect.</li></ul>';
                        }
                    }
                }
            }//end submit

            @mysqli_close($dbc);
            ?>

            <form action="login.php" method="post">
                <div class="row">
                    <div class="col-25">
                        <label for="email">E-mail:</label>
                    </div>
                    <div class="col-75">
                        <input type="email" id="email" name="email" placeholder="E-mail..."
                               value="<?php
                               if (isset($_POST['email']) && $completed == false) {
                                   echo $_POST['email'];
                               } else
                                   echo "";
                               ?>">
                    </div>
                </div>

                <div class="row">
                    <div class="col-25">
                        <label for="password">Password:</label>
                    </div>
                    <div class="col-75">
                        <input  type="password" id="password" name="password" placeholder="Password..."
                                value="<?php
                                if (isset($_POST['password']) && $completed == false) {
                                    echo $_POST['password'];
                                } else
                                    echo "";
                                ?>">
                    </div>
                </div>

                <br>
                <div class="row">
                    <input type="submit" name="submit" value="Login">
                </div>



                <div class="row">    
                    <p>Need an account? <a href="register.php">Register here</a></p>
                </div>
            </form>
        </div>


    </body>


    <?php
    include ('footer.html');
    ?>   


</html>
