<?
$i = 1;

while (TRUE) {
	echo "$i\n";
	if (++$i > 10) {
		break;
	}
	#$i > 10 ? continue : $i++;
}

for (;;) {
	echo "test\n";
	if (++$i > 20) {
		break;
	}
}

$testArray = array(1,2,3,4);

foreach ($testArray as &$thisVal) {
	echo "$thisVal\n";
	++$thisVal;
}
var_dump($testArray);
unset($thisVal);
foreach ($testArray as $thisVal) {
	echo "$thisVal\n";
}
?>