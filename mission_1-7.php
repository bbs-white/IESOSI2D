<?php

$filename = "kadai6.txt";
$myArray = file($filename);

for($i = 0; $i < count($myArray); $i++){
    echo $myArray[$i]."<br/>\n";
}

?>