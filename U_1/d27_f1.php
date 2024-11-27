<?php


// echo and print difference
/*
$fname = "Abc";
$lname = "Pqr";

echo $fname , " " , $lname , "<br>" ;

// print $fname , " " , $lname ;    // Error
$name = "$fname $lname <br>";

$val1 = print "";
echo $val1 , "<br>";

if ( $val1 ) {
    print "This is printed because print returns 1.";
}

echo "<br><br>";
*/


// variables, data types, constant
/*
$integerVar = 10;
$floatVar = 0.5;    // gettype shows double whereas var_dump shows float
$stringVar = 'hi';
$booleanVar = true;
$arrayVar = [1, 2, 3];
$arrayVar2 = array( 1,2, 3);
$nullVar = null; 


var_dump( $integerVar, $floatVar, $stringVar, $booleanVar, $arrayVar, $arrayVar2, $nullVar  );
echo '<br> Integer value is $integerVar <br>';  // single quote doesn't let pass variable value

echo "<br><br>";
echo gettype( $integerVar ) , "<br>";
echo gettype( $floatVar ) , "<br>";
echo gettype( $stringVar ) , "<br>";
echo gettype( $booleanVar ) , "<br>";
echo gettype( $arrayVar ) , "<br>";
echo gettype( $arrayVar2 ) , "<br>";
echo gettype( $nullVar ) , "<br>";

echo "<br><br>";
define( "PI", 3.14 ); // constant - if redefined, it will give warning and will take the first value
print PI;
*/


// typecasting
/*
$nullVar2 = null;
$stringVar1 = (string) $nullVar2;
var_dump($nullVar2 );
echo "<br>";
var_dump($stringVar1 );
*/


// input, loop, if - else 

/*
//  $val1 = trim( fgets( STDIN) );  // will not work, works in cli

if ( isset( $_GET["val"] ) ) {
    $val1 = $_GET["val"];
    $j = 0;
    while ( $j < $val1 ) {
        $j++;
        print $j;
        if ( $j >= 10 ) {
            break;
        } 
    }

    echo "Value is $val1 <br>";
}
else {
    echo "No value <br>";
}

*/



// implode - explode
/*
$arr1 = array( "hi", "how are you", "?" );
// print_r( $arr1 );
echo "<br>";
$str1 = implode(  " ", $arr1 );
print_r( $str1 );

echo "<br><br>";
$arr2 = explode( " ", $str1 , 3 );
print_r( $arr2 );
*/


// switch

$case1 = 3;

switch ($case1) {

    case 1:
        echo "Case 1 <br>";
        break;
    case 2:
        echo "Case 2 <br>";
        break;
    default:
        echo "default <br>";

}



?>