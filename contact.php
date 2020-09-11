<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Contact Us</title>
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
                margin-top:30px;
                margin-bottom:30px;
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
            textarea{
                resize:none;
                width: 100%; 
                font-size:11pt;
            }

            /* Responsive layout - when the screen is less than 600px wide, make the two columns stack on top of each other instead of next to each other */
            @media screen and (max-width: 1000px) {
                .col-25, .col-75, input[type=submit] {
                    width: 100%;
                    margin-top: 0;
                }
            }
            body{
                background-image:url('images/background3.jpg');
                background-repeat: no-repeat;
                background-size: 100% 100%;
            }
        </style> 
    </head>

    <body>

        <br>
        <div class="containerForm">

            <?php
            $error = false;
            if (isset($_POST['submit'])) {

                $name = $_POST['name'];
                $email = $_POST['email'];
                $message = $_POST['message'];
                $warning = array();

                if ($email == NULL) {
                    $warning[] = "Please enter <strong>email</strong>!";
                    $error = true;
                }
                if ($email != NULL && preg_match("/^[\w.-]+@[\w.-]+\.[A-Za-z]{2,6}$/", $_POST['email']) == false) {
                    $warning[] = "<strong>Email Address</strong> is of invalid format!";
                    $error = true;
                }

                //check message
                if ($message == NULL) {
                    $warning[] = "Please enter <strong>message</strong>!";
                    $error = true;
                }

                //error
                if ($error == true) {
                    echo '<ul class="notoklol">';
                    foreach ($warning as $x) {
                        echo '<li>' . $x . '</li>';
                    }

                    echo "</ul>";
                } else if ($error == false) {

                    $toEmail = "To: russellenct@gmail.com";
                    $fromEmail = "From: $email";
                    mail($toEmail, $name, $message, $fromEmail);
                    echo '<p class="ok">Message successfully sent!<p>';
                }
            }
            ?>

            <form action="contact.php" method="post">
                <div class="row">
                    <div class="col-25">
                        <label for="name">Name...(Optional)</label>
                    </div>
                    <div class="col-75">
                        <input type="text" id="name" name="name" placeholder="Name...(Optional)" value="<?php
            if (isset($_POST['name']) && $error == true) {
                echo $_POST['name'];
            }
            ?>">
                    </div>
                </div>
                <div class="row">
                    <div class="col-25">
                        <label for="email">E-mail:</label>
                    </div>
                    <div class="col-75">
                        <input type="email" id="email" name="email" placeholder="E-mail..." value="<?php
                        if (isset($_POST['email']) && $error == true) {
                            echo $_POST['email'];
                        }
            ?>">
                    </div>
                </div>

                <div class="row">
                    <div class="col-25">
                        <label for="message">Subject</label>
                    </div>
                    <div class="col-75">
                        <textarea id="message" name="message" placeholder="Message..." style="height:200px"><?php
                        if (isset($_POST['message']) && $error == true) {
                            echo $_POST['message'];
                        }
            ?></textarea>
                    </div>
                </div>
                <div class="row">
                    <input type="submit" value="Submit">
                </div>
            </form>
        </div>

<?php
include ('footer.html');
?>
</html>
