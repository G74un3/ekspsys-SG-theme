<html>
<head>
    <title> <?php echo get_bloginfo('name'); ?> </title>
    <link rel="stylesheet" href="<?php echo get_template_directory_uri();?>/style.css">
	<script src="http://code.jquery.com/jquery-latest.min.js"></script>
	<script src="http://code.jquery.com/ui/1.10.1/jquery-ui.js"></script>
	<script type="text/javascript" src="http://creativecouple.github.com/jquery-timing/jquery-timing.min.js"></script>
	<script type="text/javascript" src="https://raw.github.com/furf/jquery-ui-touch-punch/master/jquery.ui.touch-punch.min.js"></script>
	<script type="text/javascript" src="<?php echo get_template_directory_uri();?>/js/jquery.connections.js"></script>

	<script type="text/JavaScript">
		$(document).ready(function() {

			$( ".draggable" ).draggable();
			$.repeat().add('connection').each($).connections('update').wait(0);

		});
	</script>


</head>
<body>
    <div id="wrapper">
    <div id="header">
    <h1>HEADER</h1>
	    <?php get_search_form(); ?>
    </div>