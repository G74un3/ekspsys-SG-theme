<html>
<head>
    <title> <?php echo get_bloginfo('name'); ?> </title>
    <link rel="stylesheet" href="<?php echo get_template_directory_uri();?>/style.css">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri();?>/css/jquery.qtip.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
	<script src="http://code.jquery.com/ui/1.10.1/jquery-ui.js"></script>
	<script type="text/javascript" src="http://creativecouple.github.com/jquery-timing/jquery-timing.min.js"></script>
	<script type="text/javascript" src="https://raw.github.com/furf/jquery-ui-touch-punch/master/jquery.ui.touch-punch.min.js"></script>
	<!-- WHAT IS THE ABOVE ????!??!?!?!??!?-->
	<script type="text/javascript" src="<?php echo get_template_directory_uri();?>/js/jquery.connections.js"></script>
	<script type="text/javascript" src="<?php echo get_template_directory_uri();?>/js/jquery.qtip.min.js"></script>
	<script type="text/javascript" src="<?php echo get_template_directory_uri();?>/js/drawtrees.js"></script>
	<script type="text/javascript" src="<?php echo get_template_directory_uri();?>/js/cutter.js"></script>


	<script type="text/JavaScript">
		$(document).ready(function() {
			$( ".draggable" ).draggable();
			$.repeat().add('connection').each($).connections('update').wait(0);

			$('#container').position({ //Positioning roots vreaking the pattern :(
				my: "center bottom",
				at: "center bottom",
				of: "#content"
			});
		});
	</script>
</head>
<body>
    <div id="wrapper">
    <div id="header">
	    <!-- <?php //get_search_form(); ?>-->
    </div>