<?php session_start(); ?>
<?php include 'functions.php' ?>
<DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<title>Page two test</title>

<script src="http://code.jquery.com/jquery-1.10.2.min.js"> </script>
 </head>

<body>

<?php
if($_SESSION['numPlayers'])
	{
	printf("<p>Number of decks is: %s</p>
<p>Number of players is: %s</p>
<p>Round number is: %s</p>", $_SESSION['numDecks'],$_SESSION['numPlayers'],$_SESSION['roundNum']);
	}
	
	$numPlayers = $_SESSION['numPlayers'];
	$numDecks = $_SESSION['numDecks'];
	$roundNum = $_SESSION['roundNum'];
	$deck = $_SESSION['deck'];
	$makeHands = $_SESSION['makeHands'];
	$usedCards = $_SESSION['usedCards'];
		
	
	
	printf ("<div id='playerHands'><TABLE CELLSPACING=0 CELLPADDING=0>\n");
	for($i=1;$i <= $numPlayers ; $i++){
		displayHand($makeHands,$i);
	}
	printf("</table></div>\n");
	
//prints the deck
/*	printf("<ul>\n");
	for($i=0;$i < count($deck); $i++){
	
		printf("<li><img border='0' src='reg_cards/%s.png'></li>
	",$deck[$i]);
	}
	printf("</ul>
");
*/

//filters out cards that have already been used from the deck only runs once
if ($_SESSION['cardsPulledFromDeck'] == false){
	$deck = removeCardFromDeck($deck,$usedCards);
	$_SESSION['cardsPulledFromDeck'] = true;
}

$_SESSION['deck'] = $deck;

//makes buttons to draw cards for the players that are playing
for($i= 1; $i <= $numPlayers; $i++){
		printf("<button type='button' data-xml='%s' class='drawCard'>Player %s draw</button>
",$i,$i);
	
}
printf("<br>\n");
?>

<button type='button' class='reset'>Reset and draw new hands</button>


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
		}
		});
	});
});
//discards a card based upon what button is pressed 
$(document).ready(function() { //makes sure the page is ready
	$(".discardCard").click(function (){ 
		//alert('button linked') buttons are linked no longer need
		playerid = $(this).attr("data-xml");
		dCard = $(this).attr("dCard");
		$.ajax({ 
		type: "POST", 
		url: "discardCard.php", 
		data: {player: playerid, dCard:dCard}, 
		success: function(msg){ 
			$('#playerHands').html(msg);
		}
		});
	});
});
//resets the deck (newgame more or less)
$(document).ready(function() {
	$(".reset").click(function (){
		$.ajax({
		type: "POST",
		url: "reset.php",
		success: function(msg){
			$('#playerHands').html(msg);
			 
			}
		});
	});
});



</script>


</body>




</html>





