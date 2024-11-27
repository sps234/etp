<?php


//  include 

/*
include("../U_1/d27_f1.php");
echo $case1, "<br>";

include("d27_f2.php");
echo $var1, "<br>";

echo "This will be printed even if the file is not found.";
echo "<br><br>";
*/


// require
/*
require("../U_1/d27_f2.php");
echo $case1, "<br>";
echo "This will not be printed if the file is not found.";
*/



// Pass by Value 

/*
function add($num)
{
    $num += 5;
    echo $num, "<br>";
}
$org1 = 10;
echo $org1, "<br>";
add($org1);
echo $org1, "<br>";

echo "<br><br>";
// Pass by references
function add2(&$num)
{
    $num += 5;
}
add2($org1);
echo $org1, "<br>";

*/



?>