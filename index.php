<?php session_start(); ?>
<?php include 'functions.php' ?>
<DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<title>The index page</title>
 </head>

<body>

<?php

//to determine what's on the form
if($_POST['numDecks'])
	{
	printf("<p>Number of decks is: %s</p>
<p>Number of players is: %s</p>
<p>Round number is: %s</p>", $_POST['numDecks'],$_POST['numPlayers'],$_POST['roundNum']);
	}
else
	{?><form action="index.php" method="post">
	Number of Decks: <input type="text" name="numDecks"><br>
	Number of Players (max of 8): <input type="text" name="numPlayers"><br>
	Round number(placeholder): <input type="text" name="roundNum"><br>
	<input type="submit">
	</form><?php
	}
	$numPlayers = $_POST['numPlayers'];
	$numDecks = $_POST['numDecks'];
	$roundNum = $_POST['roundNum'];
	
	//store all session variables here for record keeping= also set some of them to form data or other things
	$_SESSION['numPlayers'] = $numPlayers;
	$_SESSION['numDecks'] = $numDecks;
	$_SESSION['roundNum'] = $roundNum;
	//This page makes a deck so the cards haven't been removed from the deck
	$_SESSION['cardsPulledFromDeck'] = false;
	//$_SESSION['usedCards'] = $usedCards;
	//$_SESSION['makeHands'] = $makeHands;
?>


<?php




//Make Deck from which cards will be drawn
$_SESSION['deck'] = makeDeck($_SESSION['numDecks']);
//var_dump($deck); Used to troubleshoot making the decks


//pull cards and make players hands
$_SESSION['makeHands'] = makeHands($_SESSION['numPlayers'],$_SESSION['roundNum']+2,$_SESSION['numDecks'],$_SESSION['deck']);
$_SESSION['usedCards'] = $_SESSION['makeHands'][0]; //draws usedCards from makeHands
//var_dump($makeHands);

//display users hands (all hands, player number
//to make it a bulletted list use displayHandb and change the tags before and after into <ul>
printf ("<TABLE BORDER=1 CELLSPACING=0 CELLPADDING=0>\n");
for($i=1;$i <= $_SESSION['numPlayers'] ; $i++){
	displayHand($_SESSION['makeHands'],$i);
	}
printf("</table>\n");


		
?>

</body>



<img border="0" src="reg_cards/h8.png">
<p><a href="http://freeware.esoterica.free.fr/html/freecards.html"><b>Awesome card site</b></a></p>

</html>

