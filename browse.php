<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Browse</title>
        <?php
        include ('header.html');
        ?>
        <style>

            input[type=text] {
                width: 20%;
                padding: 5px;
                border: 1px solid #ccc;
                border-radius: 4px;
                resize: vertical;
            }
            select {
                width: 18%;
                padding: 5px;
                border: 1px solid #ccc;
                border-radius: 4px;
                resize: vertical;
            }

            button[type=submit] {
                width: 6%;
                padding: 5px;
                border: 1px solid #ccc;
                border-radius: 4px;
                resize: vertical;
                box-sizing: border-box;
            }

            label {
                padding: 12px 12px 12px 0;
                display: inline-block;
            }

            input[type=submit] {
                background-color: #4CAF50;
                color: white;
                padding: 12px 20px;
                border: none;
                border-radius: 4px;
                cursor: pointer;
                float: right;
            }


            .container {
                border-radius: 5px;
                background-color: #f2f2f2;
                padding: 10px;
                box-sizing: border-box;
            }



            /* Clear floats after the columns */
            .row:after {
                content: "";
                display: table;
                clear: both;
            }

            /* Responsive layout - when the screen is less than 600px wide, make the two columns stack on top of each other instead of next to each other */
            @media screen and (max-width: 600px) {
                button[type=submit] {
                    width: 90%;
                    margin-top: 4px;
                }
                input[type=text]{
                    width:88%;
                    margin-top: 4px;
                       
                }
            }
        </style>
    </head>
    <body>

        <div class="container">
            <form action="browse.php" method="GET">
                <div class="row">
                    <label for="sortby">Sort By:</label>
                    <select name="sortby">
                        <option value="none">None</option>
                        <option value="AZ">Alphabetically, A-Z</option>
                        <option value="ZA">Alphabetically, Z-A</option>
                        <option value="LH">Price, low to high</option>
                        <option value="HL">Price, high to low</option>
                    </select>


                    <a class="search-container">
                        <input type="text" placeholder="Search..." name="s">
                        <button type="submit" ><i class="fa fa-search"></i></button>
                    </a>
                </div>
            </form>
        </div>
        
       <?php
       
       
       
       ?>
        



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
