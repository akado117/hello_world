<?php session_start(); ?>

<!DOCTYPE HTML>
<html lang="en">

<head>
<meta charset="utf-8" />
<title>Page two test</title>

<script src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
<script src="functions.js"></script>
<link rel='stylesheet' type='text/css' href='style.css'>
<?php include('functions.php');?>
</head>

<body>
<div id='score'>
<h3>The scores are: </h3>
</div>

<?php
	
	$numPlayers = $_SESSION['numPlayers'];
	$numDecks = $_SESSION['numDecks'];
	$roundNum = $_SESSION['roundNum'];
	$deck = $_SESSION['deck'];
	$makeHands = $_SESSION['makeHands'];
	$usedCards = $_SESSION['usedCards'];
	$discardPile = $_SESSION['discardPile'];
	
//initial display of  hands	

	printf ("<div id='playerHands'>\n");
	
	displayAllHandsTable($numPlayers,$makeHands);
	
	printf("</div>\n");
	
	
	
printf("<div id='tools'>\n");
//container for draw/discard
	printf("\n<TABLE>
<TR>
<TD><img src='reg_cards/b1fv.png' alt='deck'></td>
<td><div id='discardPile'><img src='reg_cards/%s.png' class= 'discardPile' alt='discard'><div></td>
</table>
\n",end($_SESSION['discardPile']));



//makes buttons to draw cards for the players that are playing
for($i= 1; $i <= $numPlayers; $i++){
		printf("<button type='button' data-xml='%s' class='drawCard'>Player %s draw</button>
",$i,$i);
	
}
printf("<br>\n");

for($i= 1; $i <= $numPlayers; $i++){
		printf("<button type='button' data-xml='%s' class='discardDraw'>Player %s draw from discard</button>
",$i,$i);
	
}
printf("<br>\n");
?>

<button type='button' class='reset'>Reset and draw new hands</button><br>

<button type='button' data-xml='1' class='win'>I THINK I WON! player1</button>
<button type='button' data-xml='2' class='win'>I THINK I WON! player2</button>
<button type='button' data-xml='3' class='win'>I THINK I WON! player3</button>

<div id='testsection'>
<button type='button' class='test'>Test</button>
<div id='test'><p>Test Text</p></div>
</div>




</div>

<script>

//Draws a card depending upon what button is pushed
$(document).ready(function() { //makes sure the page is ready
	$(".drawCard").click(function (){ //when an object with the drawCard class is clicked this happens
		playerid = $(this).attr("data-xml"); //black magic that gets an attribute from the object that is clicked and stores to a variable
		$.ajax({ //allows the use of this format otherwise $.post("url", {data:key}, function(html/xml retrieving from page)
			type: "POST", //declares its a post type function
			url: "drawCards.php", //calls upon drawCards.php
			data: {player: playerid}, //sends data in object form to the post stack in drawCards.php
			success: function(msg){ //what to do when the post request is successful
				$('#playerHands').html(msg); //replaces anything within the id playerHands with html from drawCards.php
				$(".discardCard").on("click", clickDiscard);
			}
		});
	});

//discard card ajax function that rebinds the AJAX functionality
$(".discardCard").on("click", clickDiscard);



//test functions button 	
	$(".test").click(function (){
		$.ajax({
		type: "POST",
		url: "test.php",
		success: function(msg){
			$('#test').html(msg);
			}
		});
		
	});


//resets the deck (newgame more or less)
	$(".reset").click(function (){
		$.ajax({
			type: "POST",
			url: "reset.php",
			success: function(msg){
				$('#playerHands').html(msg);
				$(".discardCard").on("click", clickDiscard);
				$.ajax({
					type: "POST",
					url: "displayPile.php",
					success: function(msg){
						$('#discardPile').html(msg);
					}
				});
				//$('#discardPile').html("'<img src='reg_cards/b1fve.png' class= 'discardPile' alt='discard'>'");
			}
		});
		
	});
	
	$(".discardDraw").click(function (){ //when an object with the drawCard class is clicked this happens
		playerid = $(this).attr("data-xml"); //black magic that gets an attribute from the object that is clicked and stores to a variable
		$.ajax({ 
			type: "POST", 
			url: "discardDraw.php", 
			data: {player: playerid},
			success: function(msg){ 
				$('#playerHands').html(msg); 
				$(".discardCard").on("click", clickDiscard);//reattaches the click to discard functionality to the dynamic buttons 
				$.ajax({ 
					type: "POST", 
					url: "displayPile.php", 
					success: function(msg){ 
						$('#discardPile').html(msg); 
					}
				});
			}
		});
	});
	
	//used to test if the game has been won
	$(".win").click(function (){ 
		playerid = $(this).attr("data-xml"); 
		$.ajax({ 
			type: "POST", 
			url: "win.php", 
			data: {player: playerid},
			success: function(msg){ 
				$('#score').html(msg); 
			}
		});
	});
	
	
	
});




</script>


</body>




</html>





