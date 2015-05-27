<?php get_header(); ?>
	<div id="main">
	<div id="content">
	<h1>Main Area</h1>

	<div id="container">

		<div class="fag-container">
			<div id="rod1" class="rod">
				<div id="" class="fagplaceholder"></div>
				<p> Rod 1</p>
			</div>
		</div>

		<div class="fag-container">
			<div id="rod2" class="rod">
				<div id="" class="fagplaceholder"></div>
				<p> Rod 2</p>
			</div>
		</div>


		<div id="last-child" class="fag-container">
			<div id="rod3" class="rod">
				<div id="" class="fagplaceholder"></div>
				<p> Rod 3</p>
			</div>
		</div>
		<span class="stretch"></span>
	</div>
	<div style="clear:both;"></div>


	<div style="position: fixed; top: 0px;">
		<button onclick="placeAndConnect('fag1', 'rod1')">Place fag 1 at rod 1</button>
		<button onclick="placeAndConnect('fag1', 'rod2')">Place fag 1 at rod 2</button>
		<button onclick="placeAndConnect('fag1', 'rod3')">Place fag 1 at rod 3</button>
		<button onclick="placeAndConnect('fag2', 'rod1')">Place fag 2 at rod 1</button>
		<button onclick="placeAndConnect('fag2', 'rod2')">Place fag 2 at rod 2</button>
		<button onclick="placeAndConnect('fag2', 'rod3')">Place fag 2 at rod 3</button>
		<button onclick="toogleVisible('fag1')">toogleVisible fag 1</button>
		<button onclick="toogleVisible('fag2')">toogleVisible fag 2</button>
		<button onclick="$('#fag1-container').visibilityToggle()">Hide fag 1</button>
		<button onclick="$('#fag2-container').visibilityToggle()">Hide fag 2</button>
		<button onclick="disconnectFag('fag2'); $('#fag2-container').visibilityToggle()">Hide fag 2 REAL</button>
		<button onclick="placeFag('fag2', 'rod1')">PLACE fag 2 at 1 REAL</button>
		<button onclick="connectFag('fag2'); $('#fag2-container').visibilityToggle()">Show fag 2 REAL</button>
		<button onclick="reroot('node1')">DOOM!</button>
	</div>



	<?php
	//Where all of the nodes and leaves are generated
	include( get_template_directory() . '/the_loop.php' );
	include( get_template_directory() . '/jquery_functions.php' );?>


<style>

	.greyed {

		color: #90C !important;

	}

	#fagmenu a {

		margin: 10px;

	}

</style>

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
				}, style: { classes: 'fagmenuboks ' + $(this).attr('id') }
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
						classes: 'tip-billede'}
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