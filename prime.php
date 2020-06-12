<?php 

$n = $_GET['n'];

function pp($number){

    $x = sqrt($number);
    $x = floor($x);

    for($i = 2;$i <= $x;++$i){

        if($number % $i == 0 ){
            break;
        }
    }
 
    if($x == $i-1){

        return true;

    } else {

        return false;
    }
}

function getID($given){

	$init = 3;
	$MAX = 10000;
	$string = "2";

	while(strlen($string) < $MAX){

		if(pp($init)){

			$string .= $init;
		}

		$init++;
	}

	return substr($string, $given, 5);
}

$ID = getID($n);

echo $ID;

?>