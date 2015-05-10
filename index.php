<?php get_header(); ?>
<div id="main">
<div id="content">
<h1>Main Area</h1>

    <?php


    //Where all of the nodes and leaves are generated
	include (get_template_directory() . '/the_loop.php');


	?>



</div>
</div>
<div id="delimiter">
</div>
<?php get_footer(); ?>