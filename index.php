<?php get_header(); ?>
	<div id="main">
		<div id="content">
			<h1>Main Area</h1>

			<div id="container">

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


			<div id="last-child"class="fag-container">
				<div id="rod3" class="fag">
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
			<button onclick="test()">DOOM!</button>
			</div>



			<?php
			//Where all of the nodes and leaves are generated
			include( get_template_directory() . '/the_loop.php' );
			include( get_template_directory() . '/jquery_functions.php' );?>



			<script type="text/JavaScript">


				$(".fag").qtip({
					content: {
						title: 'I like turtles!',
						text: 'I\'m at the top right of my target'
					},
					position: {
						my: "top center",
						at: "bottom center"
					}
				});


				function test() {

				}


				function toogleVisible(fag) {

					var fagid = '#' + fag;
					var fagcontainerid = fagid + "-container";

					if ($(fagcontainerid).is(":visible")) { //Visible

						//$(fagcontainerid).css('visibility', 'hidden');
						//$(fagcontainerid).hide();
						$(fagcontainerid).css("display", "none")

					} else { //Invisible

						//$(fagcontainerid).css('visibility', 'visible');
						//$(fagcontainerid).show();
						$(fagcontainerid).css("display", "block")
					}

				}

				jQuery.fn.visible = function() {
					return this.css('visibility', 'visible');
				};

				jQuery.fn.invisible = function() {
					return this.css('visibility', 'hidden');
				};

				jQuery.fn.visibilityToggle = function() {
					return this.css('visibility', function(i, visibility) {
						return (visibility == 'visible') ? 'hidden' : 'visible';
					});
				};

				function placeFag(fag, rod) {

					var fagid = idfy(fag);

					$(fagid).connections('remove'); //Removes any previous connections making shure that the treee will only be connected to the new root
					$(fagid).removeAttr('id'); //removes fag id from any root that cuurently uses is thereby making shure that the tree is moved correctly
					$('#' + rod + ' .fagplaceholder').attr("id", fag);


					var functioncall = function(element) {

						place(element.attr('id'), element.attr('parent'))

					};

					changeTree(functioncall, fag);

					//run = convertToFunction("place" + fag);
					//run();

				}


				function connectFag(fag) {


					//disconnectFag(fag);

					var functioncall = function(element) {

						connect(element.attr('id'), element.attr('parent'));

					};

					changeTree(functioncall, fag);

				}

				function placeAndConnect(fag, rod){

					placeFag(fag, rod);
					connectFag(fag);


				}




				function disconnectFag(fag) {



				}


				function convertToFunction(string){

					var functionnamestring = string; //Generates name of  function
					var functiontocall = window[functionnamestring]; //Gets reference to the function from window scope
					if (typeof functiontocall === "function") return functiontocall; //Checks to make shure we have really retrieved a function before running it

				}




				<?php// generateConnectionFunctions($array_of_placements_by_parent)?>

			</script>
			<?php// print_r($array_of_placements_by_parent)?>



		</div>
	</div>
	<div id="delimiter">
	</div>
<?php get_footer(); ?>