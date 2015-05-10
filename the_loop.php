<?php

//Get all categories from wp
$categories = get_categories();

//Check if they are 'rootcategories' (fag) and adding the result to parentcats
$parentcats = array();
foreach($categories as $category){


	if($category->category_parent == 0){ //Categories which parent are 0 is root

		array_push($parentcats, $category);

	}
}

//Print parentcats and call getposts and printsubcategories on them
foreach($parentcats as $category) {

	$cat_id = $category->term_id; //get ID from wp

	//This is supposed to be the root / temp until testing is over
	echo '<h2><span class="emne">' . $category->name . '</span> </h2>';

	printPosts($cat_id);

	printSubCategories($cat_id);

}

/**
 *
 * Prints all sub categories (and their) posts of a given category
 *
 * @param $category_id: the ID of the category
 */
function printSubCategories($category_id){

		$children = get_categories( array( 'child_of' => $category_id ) );

		if(!empty($children)) {

			foreach($children as $category) {

				$cat_id = $category->term_id;

				echo '<h3><span class="emne">' . $category->name . '</span> </h3>';

				printPosts($cat_id);

				//MUHAHAHAHAHHAHAHAHAHHAHA BEEEWWWAAAAARRRREEEEE RECCUUUURRRRSSSSIIIIOOOOONNNNN!!!!!!!!!
				printSubCategories($cat_id);

			}

		}

}

/**
 * Responsible printing nice HTML for all posts in a given category
 * This function contains the WP loop.
 *
 * @param $cat_id The ID of the category which posts you want printed
 *
 */
function printPosts($cat_id){


	$query = new WP_Query(array('category__in' => $cat_id));

	if($query->have_posts()) {
		while ($query->have_posts()) {
			$query->the_post(); ?> <!--//Start THE LOOP-->



		<?php echo the_title(); ?>


	<?php

		} //end while //End the loop

	} //End if


}


?>