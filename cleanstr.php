<?php
function cleanChar($thisChar) {
	$ordVal = ord($thisChar);
	if (($ordVal >= 32) && ($ordVal <=  122)) {
		if ($ordVal == 34) {
			return "&#34;";
		} else {
			return $thisChar;
		}
	} else {
		return "";
	}
}

include_once 'stdlib.php';
ini_set('display_errors', 1);

$conn = dbconn::getConnectionBuild()->getConnection();

$stmt = "SELECT `id`, `descr` FROM `skill`;";
$result = $conn->prepare($stmt);
$result->execute();
$resultSet = array();

foreach ($result->fetchAll(PDO::FETCH_ASSOC) as $row) {
	# echo $row["id"] . " | " . $row["descr"] . "<br>";
	$string = $row["descr"];
	$charArray = str_split($string);
	$cleanString = "";
	foreach ($charArray as $thisChar) {
		$cleanString .= cleanChar($thisChar);
		
	}
	$cleanString = str_replace("&$34;", "&#34;", $cleanString);
	# $cleanString = str_replace("SPECIALIZATION", "<BR>SPECIALIZATION", $cleanString);
	$cleanString = str_replace("DAMAGE_INFLICTED", "DAMAGE INFLICTED", $cleanString);
	# echo $row["id"] . " | " . $cleanString . "<br>";
	$resultSet[$row["id"]] = $cleanString;
}


foreach ($resultSet as $id => $thisStr) {
	# $sqlStmt = "UPDATE `skill` SET `descr` = ? WHERE `skill_id` = ?;";
	$sqlStmt = "UPDATE `skill` SET `descr` = '" . $thisStr . "' WHERE `skill_id` = " . $id . ";";
	# $result = $conn->prepare($sqlStmt);
	echo $sqlStmt . PHP_EOL;
	# $result->execute(array($thisStr, $id));
}
?>