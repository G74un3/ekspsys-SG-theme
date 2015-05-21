<?php

//Constantssed for calculating placements
$array_of_placements = array();
$angle               = 80;
$height              = 200;

//Get all categories from wp
$categories = get_categories();

//Check if they are 'rootcategories' (fag) and adding the result to parentcats
$parentcats = array();
foreach ($categories as $category) {


	if ($category->category_parent == 0) { //Categories which parent are 0 is root

		array_push($parentcats, $category);

	}
}

$fag_id      = 1;
$node_number = 1;

//Print parentcats and call getposts and printsubcategories on them
foreach ($parentcats as $category) {


	$cat_id = $category->term_id; //get ID from wp

	//This is supposed to be the root / temp until testing is over
	//echo '<h2><span class="emne">' . $category->name . '</span> </h2>';

	$class   = "wpid" . $cat_id;
	$html_id = 'fag' . $fag_id;
	$fag_id  = $fag_id + 1;


	echo '<div class="fag-container">';
	echo '<div id="' . $html_id . '" class="' . $class . ' fag node">';
	echo '<p>' . $category->name . '</p>';
	echo '</div>';
	echo '</div>';

	$node_number = printSubCategories($cat_id, 1, $html_id, $node_number);

}


/**
 *
 * Prints all sub categories (and their) posts of a given category
 *
 * @param $category_id : the ID of the category
 */
function printSubCategories($category_id, $row_number, $parent_id, $node_number) {

	$array_categories = array();

	$children = get_categories(array( 'parent' => $category_id )); //get all categories which are direct decendants

	$child_HTML_class = 'row' . $row_number;

	if ( !empty( $children )) {


		foreach ($children as $category) {

			$cat_id               = $category->term_id;
			$current_child_number = $node_number; //Stored for recursive call


			$array_categories = pushToPlacementArray($array_categories, $parent_id, $node_number, $row_number);

			//Prints current category
			$node_number = printNode($category->name, array(
				$child_HTML_class,
				'emne',
				'node'
			), $parent_id, $node_number);


			//MUHAHAHAHAHHAHAHAHAHHAHA BEEEWWWAAAAARRRREEEEE RECCUUUURRRRSSSSIIIIOOOOONNNNN!!!!!!!!!
			$node_number = printSubCategories($cat_id, $row_number + 1, nodifyNumber($current_child_number), $node_number);

		}

	}

	$temp_array = printPosts($category_id, $child_HTML_class, $parent_id, $node_number, $row_number);

	$node_number = $temp_array[0]; //This is the node_number
	$array_posts = $temp_array[1]; //This is the array of post id's and their parents


	checkAndCalculatePlacements($array_posts, $array_categories);

	return $node_number;

}

/**
 * @param $push_array : The array you ewant to push  to
 * @param $parent_id : The id of the parent of the pushed node
 * @param $node_number : The number of the current node
 * @param $node_row : The row of the node
 *
 * @return mixed
 */
function pushToPlacementArray($push_array, $parent_id, $node_number, $node_row) {


	array_push($push_array, array(
		'parentid' => $parent_id,
		'nodeid'   => nodifyNumber($node_number),
		'noderow'  => $node_row
	)); //Used to calculate placements later

	return $push_array;

}

function nodifyNumber($number) {


	return 'node' . $number;

}

/**
 *
 * Prints posts and calculate placaments for both posts and categories
 *
 * @param $posts
 * @param $categories
 */
function checkAndCalculatePlacements($array_posts, $array_categories) {

	global $array_of_placements;

	$temparray = calculatePlacements($array_posts, $array_categories);

	if ((count($array_categories) + count($array_posts)) != 0) {

		$array_of_placements = array_merge($array_of_placements, $temparray);

	}


}

function calculatePlacements($array_of_posts, $array_of_categories) {

	global $angle;
	global $height;
	$res  = array();
	$size = count($array_of_posts) + count($array_of_categories);


	$odd = odd($size);


	if ($odd and count($array_of_categories) > 0) {

		$coordinates = addCoordinates(array_pop($array_of_categories), 0, $height);
		array_push($res, $coordinates);
		$size = $size - 1;

	} elseif ($odd and empty( $array_of_categories ) and count($array_of_posts) > 0) {

		$coordinates = addCoordinates(array_pop($array_of_posts), 0, $height);
		array_push($res, $coordinates);
		$size = $size - 1;

	}

	if ($size == 0) { // Check to ensure that we do not divide by zero

		return $res;

	}


	$intervalNode = $size / 2; // The number of elements on each side of root. We know that it is an integer at this point!
	$offset_angle = $angle / $intervalNode;

	//Left side

	$lookingAtCategories = true;
	$loop_array      = $array_of_categories;

	for ($i = 0; $i < $intervalNode; $i ++) {


		if (round(count($array_of_categories) / 2) == count($loop_array) and $lookingAtCategories == true) {

			$array_of_categories = $loop_array; //Safes the progress onto array of categories
			$loop_array = $array_of_posts; //shift array when half is emptied
			$lookingAtCategories = false;

		}

		$rad_argument = deg2rad($offset_angle * ( $i + 1 ));
		$x = $height * ( cos($rad_argument));
		$y = $height * ( sin($rad_argument));
		array_push($res, addCoordinates(array_pop($loop_array), $x, $y));
	}


	//Right side
	$array_of_posts = $loop_array; //Safes the progress from loop array to array of posts before shifting
	$loop_array = $array_of_categories; //Shifting back to categotries for right side
	$lookingAtCategories = true;

	for ($i = $intervalNode; $i < $size; $i ++) {


		if (empty( $loop_array ) and $lookingAtCategories == true) {

			$loop_array = $array_of_posts; //Shift to posts when categories are empty
			$lookingAtCategories = false;

		}

		$rad_argument = deg2rad( $offset_angle * ( $i + 1 ));
		$x = $height * (cos($rad_argument));
		$y = $height * (sin($rad_argument));
		array_push($res, addCoordinates(array_pop($loop_array), $x, $y));
	}


	return $res;
}

function addCoordinates($arrayvalue, $x, $y) {


	if (!empty( $arrayvalue )) {

		return array_merge($arrayvalue, array( 'x' => $x, 'y' => $y ));

	}

}

/**
 *
 * Check if the number is odd
 *
 * @param $number : the number in question
 *
 * @return bool: true if odd false if even
 */
function odd($number) {

	if ($number % 2 == 0) {
		return false;
	}

	return true;


}


/**
 * Responsible printing nice HTML for all posts in a given category
 * This function contains the WP loop.
 *
 * @param $category_id : The ID of the category which posts you want printed
 *
 */
function printPosts($category_id, $parent_HTML_class, $parent_id, $node_number, $node_row) {

	$array_of_nodes = array();

	$query = queryOfPosts($category_id);

	if ($query->have_posts()) {
		while ($query->have_posts()) {
			$query->the_post(); ?> <!--//Start THE LOOP-->



			<?php
			$array_of_nodes = pushToPlacementArray($array_of_nodes, $parent_id, $node_number, $node_row);


			$node_number = printNode(get_the_title(), array('side', $parent_HTML_class), $parent_id, $node_number);


			?>

			<!--//END THE LOOP-->
		<?php

		} //end while //End the loop

	} //End if


	//print_r($array_of_nodes);
	return array( $node_number, $array_of_nodes );

}

function queryOfPosts($category_id) {

	return new WP_Query(array( 'category__in' => $category_id )); //Generate wp query with direct children


}


/**
 * Outputs HTML containing javascript/JQuery to connect two nodes
 *
 * @param $child_id
 * @param $parent_id
 */
function connectNodes($child_id, $parent_id) {


	echo '<script type="text/javascript">';
	echo '$(document).ready(function() {';
	echo "$('#" . $parent_id . "').connections({to: '#" . $child_id . "', 'class': 'line'});";
	echo '});';

	echo '</script>';

}

/**
 *
 * Responsible for prinitn HTML for a single node
 *
 * @param $titel : the titel of the node
 * @param $array_of_classes : an array cntaining the extra classes the node should have
 */
function printNode($titel, $array_of_classes, $parent_id, $node_number) {

	$classes = "";
	foreach ($array_of_classes as $class) {
		$classes = $classes . " " . $class;
	}

	$html_id = nodifyNumber($node_number);

	$node_number ++;

	echo '<div id="' . $html_id . '" class="draggable' . $classes . '">';
	echo '<p>' . $titel . '</p>';
	echo '</div>';


	connectNodes($html_id, $parent_id);

	return $node_number;


}


?>