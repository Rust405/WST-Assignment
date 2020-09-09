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
            button[type=submit]:active {
                background-color: #FFEE64;
                color: black;
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
            .productTD{
                text-align:left;
                border:2px solid #ccc;
                padding: 10px;
            }


        </style>
    </head>
    <body>

        <div class="container">
            <form action="browse.php" method="GET">
                <div class="row">
                    <label for="sortby">Sort By:</label>
                    <select name="sortby">
                        <?php
                        if (isset($_GET['sortby'])) {

                            if ($_GET['sortby'] == "AZ") {
                                echo '<option value="AZ">Alphabetically, A-Z</option>'
                                . '<option value="none">None</option>'
                                . '<option value="ZA">Alphabetically, Z-A</option>'
                                . '<option value="LH">Price, low to high</option>'
                                . ' <option value="HL">Price, high to low</option>';
                            }
                            if ($_GET['sortby'] == "ZA") {
                                echo '<option value="ZA">Alphabetically, Z-A</option>'
                                . '<option value="none">None</option>'
                                . '<option value="AZ">Alphabetically, A-Z</option>'
                                . '<option value="LH">Price, low to high</option>'
                                . ' <option value="HL">Price, high to low</option>';
                            }
                            if ($_GET['sortby'] == "LH") {
                                echo '<option value="LH">Price, low to high</option>'
                                . '<option value="none">None</option>'
                                . '<option value="AZ">Alphabetically, A-Z</option>'
                                . '<option value="ZA">Alphabetically, Z-A</option>'
                                . ' <option value="HL">Price, high to low</option>';
                            }
                            if ($_GET['sortby'] == "HL") {
                                echo ' <option value="HL">Price, high to low</option>'
                                . '<option value="none">None</option>'
                                . '<option value="AZ">Alphabetically, A-Z</option>'
                                . '<option value="ZA">Alphabetically, Z-A</option>'
                                . '<option value="LH">Price, low to high</option>';
                            } if ($_GET['sortby'] == "none") {
                                echo '<option value="none">None</option>'
                                . '<option value="AZ">Alphabetically, A-Z</option>'
                                . '<option value="ZA">Alphabetically, Z-A</option>'
                                . '<option value="LH">Price, low to high</option>'
                                . ' <option value="HL">Price, high to low</option>';
                            }
                        }
                        if (isset($_GET['sortby']) == false) {
                            echo '<option value="none">None</option>'
                            . '<option value="AZ">Alphabetically, A-Z</option>'
                            . '<option value="ZA">Alphabetically, Z-A</option>'
                            . '<option value="LH">Price, low to high</option>'
                            . ' <option value="HL">Price, high to low</option>';
                        }
                        ?>

                    </select>


                    <a class="search-container">
                        <input type="text" placeholder="Search..." name="search" value="<?php
                        if (isset($_GET['search'])) {
                            $search = $_GET['search'];
                            echo "$search";
                        }
                        ?>">
                        <button type="submit" ><i class="fa fa-search"></i></button>
                    </a>
                </div>
            </form>
        </div>
        <br>

        <?php
        require_once('mysqli_connect.php');

        $productID = array();
        $productName = array();
        $productPrice = array();

        $currentPageNumber = 1;

        $columnName = ""; //which column
        $order = ""; //ORDER
        $where = ""; //LIKE
        $sort = NULL;

        if (isset($_GET['search'])) {
            $search = $_GET['search'];

            $where = "WHERE prod_name LIKE '%". "$search" . "%'";
           
        }

        if (isset($_GET['sortby'])) {
            $sort = $_GET['sortby'];
            if ($sort == "none") {
                $columnName = ""; //which column
                $order = "";
            }
            if ($sort == "AZ") { //A-Z
                $columnName = " ORDER BY prod_name "; //which column
                $order = "ASC";
            }
            if ($sort == "ZA") { //Z-A
                $columnName = " ORDER BY prod_name "; //which column
                $order = "DESC";
            }
            if ($sort == "LH") { //Low-High
                $columnName = " ORDER BY prod_price "; //which column
                $order = "ASC";
            }
            if ($sort == "HL") { //High-Low
                $columnName = " ORDER BY prod_price "; //which column
                $order = "DESC";
            }
        }

        $q = "SELECT * from product " . " $where " . " $columnName " . " $order ";


        $result = @mysqli_query($dbc, $q);
        $numOfResult = @mysqli_num_rows($result);
        $numOfPage = $numOfResult / 10.00;

        if (isset($_GET['page'])) {
            $currentPageNumber = $_GET['page'];
        }

        //search no results
        if ($numOfResult == 0) {
            echo "<p>&nbsp; No such product exists!</p>";
        }
        //default
        if ($numOfResult > 0) {
            echo "<table style='margin-left:20%;margin-right:20%;' cellspacing='0' >";

            $i = 0;
            //get details
            if ($result) {
                while ($row = $result->fetch_object()) {
                    $productID[$i] = $row->prod_id;
                    $productName[$i] = $row->prod_name;
                    $productPrice[$i] = $row->prod_price;
                    ++$i;
                }
            }


            $limit = 10 + (10 * ($currentPageNumber - 1));
            if ($limit > $numOfResult) {
                $limit = $numOfResult;
            }

            for ($i = 0 + (10 * ($currentPageNumber - 1)); $i < $limit; $i++) {
                echo "<tr>";
                echo "<td  class='productTD'><a href=product.php?id=$productID[$i]><img src='images/$productID[$i]" . ".jpg' height='128px' width='128px'></a></td>";
                echo "<td  class='productTD' style=' width:70%;'><a style ='text-decoration:none;color:black;' href=product.php?id=$productID[$i]><b>$productName[$i]</b></a></td>";
                printf("<td class='productTD' ><a style ='text-decoration:none;color:black;' href=product.php?id=$productID[$i]><b>RM %0.2f</b></a></td>", $productPrice[$i]);
                echo "</tr>";
            }



            echo "</table>";


            echo "<br><p style='margin-left:20%;font-size:14pt;'>Page Number: ";
            if ($sort != NULL) {
                $l = "&sortby=$sort";
            }
            if ($sort == NULL) {
                $l = "";
            }

            for ($i = 0; $i < $numOfPage; $i++) {
                $a = $i + 1;
                printf(" <a href='browse.php?page=%d%s'>%d</a> ", $a, $l, $a);
            }
            echo "</p>";
        }


        @mysqli_close($dbc);
        ?>


    </body>
    <?php
    include ('footer.html');
    ?>
</html>
