<DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<title>The index page</title>
 </head>



<body>

<?php
if($_POST['numDecks'])
	{
	echo "<p>Number of decks is: " . $_POST['numDecks'] . "</p>";
	echo "<p>Number of players is: " . $_POST['numPlayers'] . "</p>";
	echo "<p>Round number is: " . $_POST['roundNum'] . "</p>";
	}
else
	{?><form action="index.php" method="post">
	Number of Decks: <input type="text" name="numDecks"><br>
	Number of Players (max of 8): <input type="text" name="numPlayers"><br>
	Round number(placeholder): <input type="text" name="roundNum"><br>
	<input type="submit">
	</form><?php
	}
?>


<?php
//Edited 10/8/2010
//Used to make a deck of cards to play with. Is open ended as to how many decks will be used to play with.
//$deck becomes an array with all the cards (aka returns $deck filled with all cards)
function makeDeck($numDecks){
	$deck = array();
	$suit = array("Clubs","Spades","Diamonds","Hearts");
	$card = array("Ace","2","3","4","5","6","7","8","9","10","Jack","Queen","King");
	$counter= 0;
	//Check if arrays were working and full
	//var_dump($card);
	
	
	//Logic for building the deck
	//increments suit
	for ($i = 0; $i < 4 * $numDecks; $i++){
		//determines card
		for ($j = 0; $j < 13; $j++) {
			//determines card $deckNum keeps it from overwritting the first deck //$i%4 removed the numDecks multiplier
			$deck[$counter] = $card[$j] . " of " . $suit[$i % 4];
			$counter++;
			//echo "index is: " . $counter . " " . $card[$j] . " of " . $suit[$i % 4] . "<br>";
		}
	}
	return $deck;
}



$deck = makeDeck($_POST['numDecks']);
//var_dump($deck); Used to troubleshoot making the decks
?>

<?php
//edited 10/8/2013 AK
//Make player hands section
//returns player hands


global $player1 = array();
global $player2 = array();
global $player3 = array();
global $player4 = array();
global $player5 = array();
global $player6 = array();
global $player7 = array();
global $player8 = array();

//Stuff to keep track of what cards to pull
Function makeHands($numOfPlayers,$handSize, $numDecks, $deck){
	//To check what's being passed
	//var_dump($numOfPlayers);
	//var_dump($handSize);
	//var_dump($numDecks);
	//var_dump($deck);
	
	
	
	
	
	//Cards to use
	$usedCards = array();
	//playerhands
	
	//used for determining which player's hand to complete
	$player = 1;
	//counter for indexing through usedCards
	$counter = 0;
	
	
	
	
	
	
	//will make an array of integers relating to what cards to pull into hands
	for($i = 0; $i < $handSize * $numOfPlayers; $i++){
		$usedCards[$i] = rand(0,($numDecks * 52 -1));
	}
	//var_dump($numOfPlayers);
	//var_dump($handSize);
	//var_dump($numDecks);
	//var_dump($usedCards);
	
	
	
	//used to assign cards to global $player
	for($i = 0; $i < $numOfPlayers; $i++){
		
		for($j = 0; $j < $handSize; $j++){
			switch($player){
				case 1:
				$player1[$j] = $deck[$usedCards[$counter]];
				break;
				case 2:
				$player2[$j] = $deck[$usedCards[$counter]];
				break;
				case 3:
				$player3[$j] = $deck[$usedCards[$counter]];
				break;
				case 4:
				$player4[$j] = $deck[$usedCards[$counter]];
				break;
				case 5:
				$player5[$j] = $deck[$usedCards[$counter]];
				break;
				case 6:
				$player6[$j] = $deck[$usedCards[$counter]];
				break;
				case 7:
				$player7[$j] = $deck[$usedCards[$counter]];
				break;
				case 8:
				$player8[$j] = $deck[$usedCards[$counter]];
				break;				
			}	
			$counter++;
		}
	$player++;
	}
	
	//used cards array
	var_dump($usedCards);
	return array($usedCards);
	
}

echo makeAHand($_POST['numPlayers'],$_POST['roundNum']+2,$_POST['numDecks'],$deck);


//pull cards to players hands
var_dump($player1);
var_dump($player2);
var_dump($player3);
var_dump($player4);
var_dump($player5);
var_dump($player6);
var_dump($player7);
var_dump($player8);
	
	
	



		
?>

</body>






</html>

