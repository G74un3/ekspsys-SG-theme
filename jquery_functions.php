<?php

function generatePositionJquery( $elements ) {

	//Sorts elements according to the output of cmp function
	usort($elements, "cmp");



	foreach ( $elements as $element ) {

		$node_id   = $element['nodeid'];
		$parent_id = $element['parentid'];
		$x         = $element['x'];
		$y         = $element['y'];
		$row       = $element['noderow'];

        if(!empty($parent_id) or !empty($node_id)) {

	        echo "//" . $row . PHP_EOL;
            echo "var parent_pos = $('#" . $parent_id . "').offset(); \n";

            echo "$('#" . $node_id . "').offset({top: parent_pos.top" . ", left: parent_pos.left" . "});" . PHP_EOL;

        }

	}


}


/**
 *
 * Defines how the array are sorted
 * @param $a
 * @param $b
 *
 * @return mixed
 */
function cmp($a, $b){

	return $a['noderow'] - $b['noderow'];

}


?>