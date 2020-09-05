<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Contact Us</title>
        <?php
        include ('header.html');
        ?>

    </head>
    <body>
        <br>
        <div style="padding:10px;margin-left:30%;margin-right:30%;border:1px solid black;">
        <form action="contact.php" method="post">
            <table>
                <tr>
                    <td>Name(Optional):</td>
                    <td><input type="text" name="name" maxlength="30">  </td>
                </tr>
                <tr>
                    <td>E-mail:</td>
                    <td><input type="email" name="email" maxlength="30">     </td>
                </tr>
                <tr>
                    <td>Message:</td>
                    <td><textarea style="resize:none"; name="message" rows="10" cols="40"></textarea></td>
                </tr>
            </table>
            <input type="submit" name="submit" value="Send">
            <button type="button" onclick="window.location = 'home.php'">Cancel</button> 

        </form>
            </div>
    </body>
    <?php
    include ('footer.html');
    ?>
</html>
