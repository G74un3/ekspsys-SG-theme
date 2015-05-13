<?php

function generatePositionJquery( $elements ) {

	foreach ( $elements as $element ) {

		$node_id   = $element[0]['nodeid'];
		$parent_id = $element[0]['parentid'];
		$x         = $element[1]['x'];
		$y         = $element[1]['y'];

        if(!empty($parent_id) or !empty($node_id)) {


            echo "var parent_pos = $('#" . $parent_id . "').offset(); \n";

            echo "$('#" . $node_id . "').offset({top: parent_pos.top" . ", left: parent_pos.left" . "}); \n";

        }

	}


}


?>