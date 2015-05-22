<?php

function generatePositionJquery($elements) {

	foreach ($elements as $fag => $element) {

		generateParentPositionFunction($fag, $element);

	}


}

function generateParentPositionFunction($name, $elements) {

	//Sorts elements according to the output of cmp function
	usort($elements, "cmp");

	echo "function place" . $name . "() {" . PHP_EOL;

	foreach ($elements as $element) {

		$node_id   = $element['nodeid'];
		$parent_id = $element['parentid'];
		$x         = $element['x'];
		$y         = $element['y'];
		$row       = $element['noderow'];

		if ( ! empty( $parent_id ) or ! empty( $node_id )) {

			echo "//" . $row . PHP_EOL;
			echo "var parent_pos = $('#" . $parent_id . "').offset(); \n";
			echo "var parent_width = $('#" . $parent_id . "').width(); \n";
			echo "var element_width = $('#" . $node_id . "').width(); \n";

			//echo "var element_width = 0;";
			//echo "var parent_width = 0;";
			echo "$('#" . $node_id . "').offset({top: parent_pos.top - " . $y . ", left: parent_pos.left + (parent_width/2) - (element_width/2) + " . $x . "});" . PHP_EOL;


			echo "$('#" . $parent_id . "').connections({to: '#" . $node_id . "', 'class': 'line'});";


		}

	}

	echo "}";

}


/**
 *
 * Defines how the array are sorted
 *
 * @param $a
 * @param $b
 *
 * @return mixed
 */
function cmp($a, $b) {

	return $a['noderow'] - $b['noderow'];

}


?>