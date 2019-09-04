<?php
class MyClass {
	private $id = 0;
	private $value = "";
	
	function __construct($id, $value) {
		$this->id = $id;
		$this->value = $value;
	}
	
	function display() {
		echo "Id = " . $this->id . PHP_EOL;
		echo "Value = " . $this->value . PHP_EOL;
	}
	
	function updateVal($value) {
		$this->value = $value;
	}
}

$objectArray["first"] = new MyClass(1, "this");
$objectArray["second"] = new MyClass(2, "that");
$objectArray["third"] = new MyClass(3, "theother");

foreach ($objectArray as $label => $tc) {
	$tc->display();
}

foreach ($objectArray as $label => $tc) {
	$tc->updateVal($label);
}

foreach ($objectArray as $label => $tc) {
	$tc->display();
}
?>