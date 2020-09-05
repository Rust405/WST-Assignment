<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Register</title>
        <?php
        include ('header.html');
        ?>
    </head>
    <body>
        <br>
        <div class="register-form">
            <form action="register.php" method="post">
                <table>
                    <tr>
                        <td>First Name:</td>
                        <td><input type="text" name="firstName" maxlength="15">  </td>
                    </tr>
                    <tr>
                        <td>Last Name:</td>
                        <td><input type="text" name="lastName" maxlength="15"></td>
                    </tr>
                    <tr>
                        <td>E-mail:</td>
                        <td><input type="email" name="email" maxlength="30">     </td>
                    </tr>
                    <tr>
                        <td>Password:  </td>
                        <td><input type="password" name="password" maxlength="20"></td>
                    </tr>
                    <tr>
                        <td>Confirm Password:   </td>
                        <td><input type="password" name="confirmPassword" maxlength="20"></td>
                    </tr>
                </table>
                <input type="submit" name="submit" value="Create Account">
                <button type="button" onclick="window.location = 'login.php'">Cancel</button> 

            </form>

        </div>
    </body>

    <?php
    include ('footer.html');
    ?>
</html>
