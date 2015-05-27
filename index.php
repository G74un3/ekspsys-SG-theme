<?php get_header(); ?>
	<div id="main">
	<div id="content">
	<h1>SG-Wiki navigation</h1>

	<div id="container">

		<div onclick="uncut('fag1', 'rod1')" class="fag-container">
			<div id="rod1" class="rod">
				<div id="" class="fagplaceholder"></div>
				<p> Rod 1</p>
			</div>
		</div>

		<div onclick="uncut('fag1', 'rod2')" class="fag-container">
			<div id="rod2" class="rod">
				<div id="" class="fagplaceholder"></div>
				<p> Rod 2</p>
			</div>
		</div>


		<div onclick="uncut('fag1', 'rod3')" id="last-child" class="fag-container">
			<div id="rod3" class="rod">
				<div id="" class="fagplaceholder"></div>
				<p> Rod 3</p>
			</div>
		</div>
		<span class="stretch"></span>
	</div>
	<div style="clear:both;"></div>



		<div style="position: fixed" >



		</div>


	<?php
	//Where all of the nodes and leaves are generated
	include( get_template_directory() . '/the_loop.php' );
	include( get_template_directory() . '/jquery_functions.php' );?>




<?php printFagMenu($fag); ?>


	<script type="text/JavaScript">



		$(".rod").each(function () {

			$(this).qtip({
				prerender: true,
				hide:{ //makes the qtip stay so it is clickable,
					delay: 500, //give a small delay to allow the user to mouse over it.
					fixed: true
				},
				content: {
					title: 'Vælg et fag!',
					text: $('#fagmenu').clone().get()
				},
				position: {
					my: "top center",
					at: "bottom center"
				}, style: { classes: 'qtip-bootstrap ' + $(this).attr('id') }
			});

		});


		$('.side').each(function () { //Attatches thumbnail tips to nodes with thumbnail

			var image = $(this).attr('qtip-attr'); //Get the thumbnail url

			if (image.length > 0) {

				$(this).qtip({
					content: {
						title: $(this).children('p').eq(0).text(),
						text: '<img src="' + image + '" width="100">'
					},
					position: {
						my: "top center",
						at: "bottom center"
					},
					style: {
						classes: 'qtip-light'}
				});

			}


		});


		<?php// generateConnectionFunctions($array_of_placements_by_parent)?>

	</script>
	<?php // print_r($array_of_placements_by_parent)?>


	</div>
	</div>
	<div id="delimiter">
	</div>
<?php get_footer(); ?>