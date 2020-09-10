<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Fulfill Order</title>
        <?php
        include ('adminheader.html');
        ?>

    </head>
    <body>
        <h1>Fulfill Order (arrive here by clicking fulfill order in View Orders page)</h1>
        <h2>Display selected order to delete and send Order Out for Delivery by email</h2>
        <form action="fulfillOrder.php" method="post">
            
            <input type='submit' name='submit' value='Fulfill Order'>
            <button type="button"  onclick="window.location = 'admin.php'">Cancel</button> 
        </form>
        
        </body>
    <?php
    include ('adminfooter.html');
    ?>
</html>
