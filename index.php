<?php get_header(); ?>
	<div id="main">
		<div id="content">
			<h1>Main Area</h1>

			<div class="fag-container">
				<div id="rod1" class="fag">
					<div id="" class="fagplaceholder"></div>

					<p> Rod 1</p>
				</div>
			</div>

			<div class="fag-container">
				<div id="rod2" class="fag">
					<div id="" class="fagplaceholder"></div>
					<p> Rod 2</p>
				</div>
			</div>


			<div class="fag-container">
				<div id="rod3" class="fag">
					<div id="" class="fagplaceholder"></div>

					<p> Rod 3</p>
				</div>
			</div>


			<button onclick="placefag('fag1', 'rod1')">Place fag 1 at rod1</button>
			<button onclick="placefag('fag1', 'rod2')">Place fag 1 at rod2</button>
			<button onclick="placefag('fag2', 'rod1')">Place fag 2 at rod1</button>
			<button onclick="placefag('fag2', 'rod2')">Place fag 2 at rod2</button>
			<button onclick="test()">DOOM!</button>
			<?php
			//Where all of the nodes and leaves are generated
			include( get_template_directory() . '/the_loop.php' );
			include( get_template_directory() . '/jquery_functions.php' );?>



			<script type="text/JavaScript">


				function test() {



				}

				function placefag(fag, rod) {


					$('#' + fag).connections('remove'); //Removes any previous connections making shure that the treee will only be connected to the new root
					$('#' + fag).removeAttr('id'); //removes fag id from any root that cuurently uses is thereby making shure that the tree is moved correctly


					$('#' + rod + ' .fagplaceholder').attr("id", fag);
					$('.fag .fagplaceholder').animate({left: '250px'});


					var functionnamestring = "place" + fag; //Generates name of placement function
					var functiontocall = window[functionnamestring]; //Gets reference to the function from window scope
					if (typeof functiontocall === "function") functiontocall(); //Checks to make shure we have really retrieved a function before running it


				}

				<?php generatePositionJquery($array_of_placements_by_parent)?>

				$(document).ready(function () {


				});
			</script>


		</div>
	</div>
	<div id="delimiter">
	</div>
<?php get_footer(); ?>