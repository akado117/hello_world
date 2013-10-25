<?php session_start(); ?>
<?php include 'functions.php' ?>
<DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<title>Welcome to FiveCrowns</title>
 </head>
<script src="http://code.jquery.com/jquery-1.10.2.min.js"> </script>

<style>
hr {color:sienna;}
p {margin-left:10px;}
body {background-image:url("images/firstPage.jpg");font-weight:bold;text-shadow: 5px 5px 5px #FFFF00;width:400px}
</style>



<body>

<P> This is a variant of the game <a href="http://www.toycrossing.com/five-crowns/"><b>Five Crowns.</b></a>  Consider all aces as wilds and whatever round you are on +2 is the secondary wild card. Attempt to make books of 3 of a kind or more and runs consisting of straight flushes of 4 or more cards. Start by selecting the number of hands to display(number of players), Round number, and select your player name. Then click on submit and finally click view hands.</p>


<?php

//to determine what's on the form
if($_POST['player'])
	{
	printf("<p>Player Name is: %s</p>
<p>Number of players is: %s</p>
<p>Round number is: %s</p>", $_POST['player'],$_POST['numPlayers'],$_POST['roundNum']);
	}
else
	{?><form action="index.php" method="post">
	<?php
	//Number of Decks: <input type="text" name="numDecks"><br>
	?>
	Number of Players (max of 7): <input type="text" name="numPlayers"><br>
	Round number(placeholder): <input type="text" name="roundNum"><br>
	Player Name: <input type="text" name="player"><br>
	<input type="submit">
	</form><?php
	}
	
	
$numPlayers = $_POST['numPlayers'];
//$numDecks = $_POST['numDecks'];
$roundNum = $_POST['roundNum'];
$_SESSION['player'] = $_POST['player'];
//hard coded because the game naturally uses 104 cards
$numDecks = 2;
//store all session variables here for record keeping= also set some of them to form data or other things
$_SESSION['numPlayers'] = $numPlayers;
$_SESSION['numDecks'] = $numDecks;
$_SESSION['roundNum'] = $roundNum;
//This page makes a deck so the cards haven't been removed from the deck
$_SESSION['cardsPulledFromDeck'] = false;
//$_SESSION['usedCards'] = $usedCards;
//$_SESSION['makeHands'] = $makeHands;
$_SESSION['discardPile'] = array('b1fve');
$_SESSION['scores'] = array();
?>


<?php




//Make Deck from which cards will be drawn
$_SESSION['deck'] = makeDeck($_SESSION['numDecks']);
//var_dump($deck); Used to troubleshoot making the decks


//pull cards and make players hands
$_SESSION['makeHands'] = makeHands($_SESSION['numPlayers'],$_SESSION['roundNum']+2,$_SESSION['numDecks'],$_SESSION['deck']);
$_SESSION['usedCards'] = $_SESSION['makeHands'][0]; //draws usedCards from makeHands
//var_dump($makeHands);




		
?>

<p><a href="http://freeware.esoterica.free.fr/html/freecards.html"><b>Awesome card site</b></a></p>

<button type='button' class='test'>Click to view hands</button>

<script>
var test = window.location.host;
$('.test').click(function(){
	window.location = "hands.php"
	});
</script>

</body>





</html>

