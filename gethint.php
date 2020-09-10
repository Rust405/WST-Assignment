<?php

require_once('mysqli_connect.php');
$q = "SELECT * from product";
$result = @mysqli_query($dbc, $q);

//get details
if ($result) {
    $i = 0;
    while ($row = $result->fetch_object()) {
        $a[$i] = $row->prod_name;
        ++$i;
    }
}
@mysqli_close($dbc);


//get the q parameter from URL
$q = $_GET["q"];

//lookup all hints from array if length of q>0
if (strlen($q) > 0) {
    $hint = "";
    for ($i = 0; $i < count($a); $i++) {
        if (strtolower($q) == strtolower(substr($a[$i], 0, strlen($q)))) {
            if ($hint == "") {
                $hint = $a[$i];
            } else {
                $hint = $hint . " , " . $a[$i];
            }
        }
    }
}

// Set output to "no suggestion" if no hint were found
// or to the correct values
if ($hint == "") {
    $response = "No suggestion";
} else {
    $response = $hint;
}

//output the response
echo $response;
?>