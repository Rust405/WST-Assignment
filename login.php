<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Login</title>
        <?php
        include ('header.html');
        ?>

    </head>
    <body>
        <br>
        <div class="login-form">
            <form action="login.php" method="post">
                <table>
                    <tr>
                        <td>E-mail:</td>
                        <td><input type="email" name="email" maxlength="30">     </td>
                    </tr>
                    <tr>
                        <td>Password:  </td>
                        <td><input type="password" name="password" maxlength="20"></td>
                    </tr>

                </table>
                <input type="submit" name="submit" value="Login">
                <button type="button" onclick="window.location = 'home.php'">Cancel</button> 


            </form>
            <p>Need an account? Register <a href="register.php">here</a></p>
        </div>
    </body>
    <?php
    include ('footer.html');
    ?>
</html>
