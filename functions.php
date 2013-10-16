<?php
//Edited 10/9/2010
//Used to make a deck of cards to play with. Is open ended as to how many decks will be used to play with.
//$deck becomes an array with all the cards (aka returns $deck filled with all cards)
function makeDeck($numDecks){
	$deck = array();
	$suit = array("c","s","d","h");
	$card = array("a","2","3","4","5","6","7","8","9","10","j","q","k");
	$counter= 0;
	
	//Logic for building the deck
	//increments suit
	for ($i = 0; $i < 4 * $numDecks; $i++){
		//determines card
		for ($j = 0; $j < 13; $j++) {
			//determines card $deckNum keeps it from overwritting the first deck //$i%4 removed the numDecks multiplier
			//10-9-1013 reformatted to use a format that would allow easy linking to cards in library
			$deck[$counter] = $suit[$i % 4] . $card[$j];
			$counter++;
			//echo "index is: " . $counter . " " . $card[$j] . " of " . $suit[$i % 4] . "<br>";
		}
	}
	return $deck;
}




//used in the make hands function to keep duplicate cards from being pulled
//takes in the used cards array, compares the randomly generated card and returns it if it's not currently in the //usedcard array 
//returns the random card index $rand
//10-16-2013
function duplicate($usedCards,$numDecks){
	
	//generates a random number which will relate to a card within the deck
	$rand = rand(0,($numDecks * 52 -1));
	$bool= array_search($rand,$usedCards);
	if( $bool === false ){ //if the value is found in the array run duplicate again
		//var_dump($bool);
		return($rand);//upon success return the chosen card
	}
	else{
	return false;
	}
	
}
//edited 10/8/2013 AK
//Make player hands section
//returns player hands

//Stuff to keep track of what cards to pull
Function makeHands($numPlayers,$handSize, $numDecks, $deck){
	//To check what's being passed
	//var_dump($numPlayers);
	//var_dump($handSize);
	//var_dump($numDecks);
	//var_dump($deck);
	
	
	$player1 = array();
	$player2 = array();
	$player3 = array();
	$player4 = array();
	$player5 = array();
	$player6 = array();
	$player7 = array();
	$player8 = array();
		
	//Cards to use
	$usedCards = array();
	//playerhands
	
	//used for determining which player's hand to complete
	$player = 1;
	//counter for indexing through usedCards
	$counter = 0;		

	//will make an array of integers relating to what cards to pull into hands (no duplicates)	
	$while=0;
	$timer=0;
	while($while < $handSize * $numPlayers){
		$rand = duplicate($usedCards,$numDecks);
		//var_dump($rand);
		if($rand || 0){
			array_push($usedCards,$rand);
			$while++;
		}
		$timer++;
		if($timer == $handSize * $numPlayers * 10){
		Echo "Timed out";
		$while = $handSize * $numPlayers;
		}
		
	}
	//var_dump($numOfPlayers);
	//var_dump($handSize);
	//var_dump($numDecks);
	//var_dump($usedCards);
	
	
	
	//used to assign cards to global $player
	//var_dump($deck);
	
	for($i = 0; $i < $numPlayers; $i++){
		
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
	
	/*
	var_dump($usedCards);
	var_dump($player1);
	var_dump($player2);
	var_dump($player3);
	var_dump($player4);
	var_dump($player5);
	var_dump($player6);
	var_dump($player7);
	var_dump($player8);
	*/
	//used cards and players,array
	return array ($usedCards,$player1,$player2,$player3,$player4,$player5,$player6,$player7,$player8);
	
}

//Used to display hands in an html format requires <table> before and </table> after due to modular design
//Player is player number 1-8, $makeHands is an array with used cards then the arrays of player hands
//returns nothing
//10-9-2013 AK
Function displayHand($makeHands,$player){
	
	printf("	<tr>
	<th>Player %s's Hand<th>
	</tr>
	<div class=player%sHand><tr>
	", $player, $player);
	//displays the images of the cards 
	for($i = 0; $i < count($makeHands[$player]); $i++){
		printf("<td ALIGN=CENTER><img border='0' src='reg_cards/%s.png'></td>
	",$makeHands[$player][$i]);
	}
	printf("</tr><tr>
	");
	
	//makes discard buttons based upon the number of cards in hand
	for($i = 0; $i < count($makeHands[$player]);$i++){
		$j = $i+ 1;
		printf("<td><button type='button' data-xml='%s' dCard='%s' class='discardCard' >Discard %s</button></td>
	",$player,$i,$j);
	}
	printf("</tr></div>
	");
	
}
//Used to display hands in an html format requires <ul> before and </ul> after due to modular design
//Player is player number 1-8, $makeHands is an array with used cards then the arrays of player hands
//10-9-2013 AK
Function displayHandb($makeHands,$player){
	
	printf("	<li>Player %s's Hand<li>
	", $player);
	
	for($i = 0; $i < count($makeHands[$player]); $i++){
		printf("<li><img border='0' src='reg_cards/%s.png'></li>
	",$makeHands[$player][$i]);
	}
}

//used to draw cards Somewhat inefficient in that it needs to iterate through the entire array every time a card is drawn
//returns the reduced deck reindexed
//10-11-2013 AK
Function removeCardFromDeck($deck,$usedCards){

	
	
	
	//iterates through the used cards and removes them from the deck. The deck is then re-indexed and returned.
	foreach($usedCards as $value){
	//echo $deck[$value] . "<br>";
	unset($deck[$value]);
		
	}
	//re-indexes the array
	$deck = array_values($deck);
	//var_dump($deck);
	return $deck;
	
}
//draws a card from the deck (remember to feed in the reduced deck) removes card from deck and redisplays player hand
//$makeHands is the array of hands, $deck is the deck, $player is the player number that is drawing the card (1-8)
//10-11-2013 AK
Function drawCard($makeHands,$deck,$player){
	
	//pulls a random card from the deck
	
	array_push($makeHands[$player], $deck[rand(0,count($deck))-1]);
	//var_dump($deck[rand(0,count($deck))]);
	
	//returns the updated $makeHands
	return $makeHands;
	//var_dump($makeHands[$player]);
}
//Discards a card and puts it in the discard array
//returns make hands with the discarded card added to used cards array makeHands[0]
//10-15-2013 AK

//updates the discard pile (needs to be run after discard card completes
//displays the discard pile (returns the last value of the usedCards array)
//10-16-2013 AK
Function updateDiscard($makeHands){

	printf("<img border='0' src='reg_cards/%s.png' alt='discard'>",end($makeHands[0]));
	return end($makeHands[0]);
	
}

Function discardCard($makeHands,$dCard,$player){

	//var_dump($makeHands[0]);
	array_push($makeHands[0], $makeHands[$player][$dCard]);
	//unsets the card
	unset($makeHands[$player][$dCard]);
	
	
	$makeHands[$player] = array_values($makeHands[$player]);//reindexes the hands array
	
	return $makeHands;
	//var_dump($makeHands[$player]);
}






?>

