<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Browse</title>
        <?php
        include ('header.html');
        ?>

    </head>
    <body>
        <br>
        <form action="browse.php" method="post">
            <a class="search-container">
                <input type="text" placeholder="Search..." name="search">
                <button type="submit"><i class="fa fa-search"></i></button>
            </a>
            <label for="filter">Filter:</label>
            <select name="filter">
                <option value="none">None</option>
                <option value="A">A</option>
                <option value="B">B</option>
                <option value="C">C</option>
            </select>

            <label for="sortby">Sort By:</label>
            <select name="sortby">
                <option value="none">None</option>
                <option value="AZ">Alphabetically, A-Z</option>
                <option value="ZA">Alphabetically, Z-A</option>
                <option value="LH">Price, low to high</option>
                <option value="HL">Price, high to low</option>
            </select>
            <input type='submit' name='submit' value='Filter/Sort'>


        </form>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent id blandit ex. Fusce a varius erat, non interdum lectus. Sed quis hendrerit mauris, a vehicula nunc.
            Maecenas dictum tincidunt pellentesque. Pellentesque placerat dolor sit amet neque feugiat faucibus. Donec non velit at leo sodales fermentum et sed mi.
            Phasellus ultrices nisl a ornare suscipit. Aliquam elementum ultricies erat ac vulputate. Pellentesque dignissim augue ut est pellentesque, sit amet fermentum erat egestas.
            Nunc ullamcorper, nunc in tincidunt dapibus, purus turpis vestibulum turpis,
            eu tincidunt odio lectus nec dui. Ut a arcu erat. </p>

        <p>Mauris pharetra dui dui, sodales bibendum est varius egestas. Vivamus laoreet, ligula et porta convallis, nisi risus bibendum sem, et posuere massa purus vel tortor.
            In a mauris et orci viverra venenatis nec vitae lectus. Fusce mi mauris, pellentesque ut aliquam id, aliquet sed lacus. 
            Sed iaculis at lorem in gravida. Ut sollicitudin fermentum vehicula.
            Donec interdum fermentum laoreet. </p>

        <a href="product.php">Example Product</a>

    </body>
    <?php
    include ('footer.html');
    ?>
</html>
