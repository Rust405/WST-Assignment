<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>View Orders</title>
        <?php
        include ('adminheader.html');
        //test
        ?>

    </head>
    <body>

        <h1>View Orders</h1>
        <h2>Display all orders here by table</h2>
        <form action="displayOrder.php" method="post">
            <a class="search-container">
                <input type="text" placeholder="Search.." name="search">
                <button type="submit"><i class="fa fa-search"></i></button>
            </a>
            <label for="sortby">Sort By:</label>
            <select name="sortby">
                <option value="none">None</option>
                <option value="IDASC">Order ID, ascending</option>
                <option value="IDDEC">Order ID, descending</option>
                <option value="DL">Date, latest to oldest</option>
                <option value="DO">Date, oldest to latest</option>
            </select>
            <input type='submit' name='submit' value='Sort'>
        </form>
        <p>Ut ultrices dolor at rutrum ornare. Nulla malesuada, ante sed euismod finibus, lacus dolor vulputate ex, in facilisis lorem tortor blandit libero. Nulla vitae euismod tellus.
            Vestibulum consequat eros sed sagittis eleifend. Donec massa urna, dictum a dignissim id, consequat quis ipsum. Duis quis gravida tellus. Vivamus vel sagittis ipsum, eu viverra orci. </p>

        <p>Aenean mollis, leo at ornare ultrices, risus nibh convallis arcu, quis sodales ante erat ut justo. Proin consequat fermentum pellentesque. Nam varius accumsan ipsum eget efficitur.
            Nulla nec odio non erat dapibus aliquet. Aenean placerat interdum eros, eu pharetra metus sollicitudin vitae. Donec eget orci ante. Etiam eu mollis libero. Maecenas porttitor velit id vestibulum aliquam.
            Sed vel nisl et ex maximus maximus. Aliquam tincidunt enim in venenatis sagittis. In quam nisi, congue eu faucibus dictum, finibus vitae diam. Cras rhoncus lorem vitae felis aliquet lacinia. Duis cursus lacus sit amet leo bibendum euismod.
            Proin ac velit turpis. Donec lectus mauris, ullamcorper id tortor ut, condimentum vehicula ligula. Nunc commodo risus velit. </p>
        "Product" <a href="fulfillOrder.php">Fulfill</a>
    </body>
    <?php
    include ('adminfooter.html');
    ?>
</html>
