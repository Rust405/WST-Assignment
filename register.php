<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Register</title>
        <?php
        include ('header.html');
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
                border: 3px solid #00045B;
                margin-top:25px;
                margin-bottom:25px;
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
        <div class="containerForm">

            <?php
            //insert into customer table
            ?>

            <form action="register.php" method="post">
                <div class="row">
                    <div class="col-25">
                        <label for="fname">First Name:</label>
                    </div>
                    <div class="col-75">
                        <input   type="text" id="fname" name="fname" placeholder="John">
                    </div>
                </div>

                <div class="row">
                    <div class="col-25">
                        <label for="lname">Last Name:</label>
                    </div>
                    <div class="col-75">
                        <input   type="text" id="llname" name="lname" placeholder="Smith">
                    </div>
                </div>

                <div class="row">
                    <div class="col-25">
                        <label for="email">E-mail:</label>
                    </div>
                    <div class="col-75">
                        <input   type="email" id="email" name="email" placeholder="E-mail...">
                    </div>
                </div>

                <div class="row">
                    <div class="col-25">
                        <label for="phone">Phone Number:</label>
                    </div>
                    <div class="col-75">
                        <input   type="tel" id="phone" name="phone" value="+60">
                    </div>
                </div>

                <div class="row">
                    <div class="col-25">
                        <label for="password">Password:</label>
                    </div>
                    <div class="col-75">
                        <input   type="password" id="password" name="password" placeholder="Password...">
                    </div>
                </div>

                <div class="row">
                    <div class="col-25">
                        <label for="cpassword">Confirm Password:</label>
                    </div>
                    <div class="col-75">
                        <input  type="password" id="cpassword" name="cpassword" placeholder="Confirm Password...">
                    </div>
                </div>
                <br>
                <div class="row">
                    <input type="submit" value="Register">
                </div>




            </form>
        </div>
    </body>

    <?php
    include ('footer.html');
    ?>
</html>
