<?php

$id_number = 0; //USed in printNode

//Get all categories from wp
$categories = get_categories();

//Check if they are 'rootcategories' (fag) and adding the result to parentcats
$parentcats = array();
foreach($categories as $category){


	if($category->category_parent == 0){ //Categories which parent are 0 is root

		array_push($parentcats, $category);

	}
}

$fag_id = 1;

//Print parentcats and call getposts and printsubcategories on them
foreach($parentcats as $category) {


	$cat_id = $category->term_id; //get ID from wp

	//This is supposed to be the root / temp until testing is over
	//echo '<h2><span class="emne">' . $category->name . '</span> </h2>';

	$class = "node" . $cat_id;
	$html_id = 'fag' . $fag_id;
	$fag_id = $fag_id + 1;


	echo '<div class="fag-container">';
	echo '<div id="' . $html_id . '" class="' . $class . ' fag node">';
	echo '<p>' . $category->name . '</p>';
	echo '</div>';
	echo '</div>';

	printPosts($cat_id, $class, $html_id);

	printSubCategories($cat_id, $class, $html_id);

}



/**
 *
 * Prints all sub categories (and their) posts of a given category
 *
 * @param $category_id: the ID of the category
 */
function printSubCategories($category_id, $parent_HTML_class, $parent_id){


		$children = get_categories( array( 'parent' => $category_id ) ); //get all categories which are direct decendants

		if(!empty($children)) {

			$child_HTML_class = $parent_HTML_class . "_child";

			foreach($children as $category) {

				$cat_id = $category->term_id;

				//echo '<h3><span class="emne">' . $category->name . '</span> </h3>';
				$node_id = printNode($category->name, array($child_HTML_class, 'emne', 'node'), $parent_id);

				printPosts($cat_id, $child_HTML_class, 'node' . $node_id);

				//MUHAHAHAHAHHAHAHAHAHHAHA BEEEWWWAAAAARRRREEEEE RECCUUUURRRRSSSSIIIIOOOOONNNNN!!!!!!!!!
				printSubCategories($cat_id, $child_HTML_class, 'node' . $node_id);

			}

		}

}

/**
 * Responsible printing nice HTML for all posts in a given category
 * This function contains the WP loop.
 *
 * @param $category_id: The ID of the category which posts you want printed
 *
 */
function printPosts($category_id, $parent_HTML_class, $parent_id){

	$child_HTML_class = $parent_HTML_class . "_child";

	$query = new WP_Query(array('category__in' => $category_id)); //Generate wp query with direct children

	if($query->have_posts()) {
		while ($query->have_posts()) {
			$query->the_post(); ?> <!--//Start THE LOOP-->



		<?php printNode(get_the_title(), array('side', $child_HTML_class), $parent_id);?>

	<?php

		} //end while //End the loop

	} //End if


}



/**
 * Outputs HTML containing javascript/JQuery to connect two nodes
 *
*@param $child_id
 * @param $parent_id
 */
function connectNodes( $child_id, $parent_id) {


	echo '<script type="text/javascript">';
	echo '$(document).ready(function() {';
	echo "$('#" . $parent_id . "').connections({to: '#" . $child_id . "', 'class': 'line'});";
	echo '});';

	echo '</script>';

}

/**
 *
 * Responsible for prinitn HTML for a single node
 * @param $titel: the titel of the node
 * @param $array_of_classes: an array cntaining the extra classes the node should have
 */
function printNode($titel, $array_of_classes, $parent_id){

	global $id_number;

	$id_number = $id_number + 1;

	$classes = "";
	foreach($array_of_classes as $class){
		$classes = $classes . " " .  $class;
	}

	echo '<div id="node' . $id_number . '" class="draggable' . $classes . '">';
	echo '<p>' . $titel . '</p>';
	echo '</div>';

	connectNodes('node' . $id_number, $parent_id);

	return $id_number;


}



?>