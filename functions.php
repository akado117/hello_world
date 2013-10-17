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
	shuffle($deck); //shuffles the deck
	return $deck;
}




//used in the make hands function to keep duplicate cards from being pulled
//takes in the deck and current used cards, compares the random value generated and makes sure it's not already used, 
//then returns the random card, returns false if the card is already used (function will need to be looped until a 
//suitable random value is found
//returns the random card index $rand or false
//10-16-2013 AK
function duplicate($usedCards,$deck){
	
	//generates a random number which will relate to a card within the deck
	$rand = array_rand($deck, 1);
	$bool= array_search($rand,$usedCards);
	if( $bool === false ){ //if the value is not found in the array return the value
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
Function makeHands($numPlayers,$handSize, $numDecks, &$deck){
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
		$rand = duplicate($usedCards,$deck);
		//var_dump($rand);
		if($rand){
			array_push($usedCards,$rand);
			$while++;
		}
		
		$timer++;
		if( $timer > $handSize * $numPlayers * 5){ //if the while loop runs 5 times the max number of cards in hand stop
			$while= $handSize * $numPlayers;
			var_dump($usedCards);
			}
			
		
	}
	//used to change used cards to contain card values instead of index values
	for($i = 0; $i < count($usedCards); $i++){
		$usedCards[$i] = $deck[$usedCards[$i]];
		
	}
	
	
	//$usedCards = array_rand($deck, $numPlayers * $handSize); //pulls random indexes from the deck is sequential, isn't random enough.
		
	//var_dump($numOfPlayers);
	//var_dump($handSize);
	//var_dump($numDecks);
	//var_dump($usedCards);
	//var_dump($deck);
	
	//used to assign cards to global $player
	for($i = 0; $i < $numPlayers; $i++){
		
		for($j = 0; $j < $handSize; $j++){
			switch($player){
				case 1:
				$player1[$j] = $usedCards[$counter];
				break;
				case 2:
				$player2[$j] = $usedCards[$counter];
				break;
				case 3:
				$player3[$j] = $usedCards[$counter];
				break;
				case 4:
				$player4[$j] = $usedCards[$counter];
				break;
				case 5:
				$player5[$j] = $usedCards[$counter];
				break;
				case 6:
				$player6[$j] = $usedCards[$counter];
				break;
				case 7:
				$player7[$j] = $usedCards[$counter];
				break;
				case 8:
				$player8[$j] = $usedCards[$counter];
				break;				
			}	
			$counter++;
		}
	$player++;
	}
	
	//used cards and players,array
	initRemoveCardFromDeck($deck,$usedCards);
	return array ($usedCards,$player1,$player2,$player3,$player4,$player5,$player6,$player7,$player8);
	
}

//used to draw cards Somewhat inefficient in that it needs to iterate through the entire array every time a card is drawn
//returns the reduced deck reindexed
//10-11-2013 AK
Function initRemoveCardFromDeck(&$deck,$usedCards){

	//iterates through the used cards and removes them from the deck. The deck is then re-indexed and returned.
	foreach($usedCards as $value){
	//echo $deck[$value] . "<br>";
	unset($deck[$value]);
		
	}
	//re-indexes the array
	$deck = array_values($deck);
	//var_dump($deck);
		
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


//used with function above to print the cards out
//10-16-2013 AK
function displayAllHandsTable($numPlayers,$makeHands){
	printf ("<ul>\n");
		for($i=1;$i <= $numPlayers; $i++){
			displayHandb($makeHands,$i);
		}
		printf("</ul>\n");
 }


//Used to display hands in an html format requires <ul> before and </ul> after due to modular design
//Player is player number 1-8, $makeHands is an array with used cards then the arrays of player hands
//10-9-2013 AK
Function displayHandb($makeHands,$player){
	
	
	printf("<div id='playerHand%s' class='player%s'>\n",$player,$player);
	//printf("	<li>Player %s's Hand<li>
	//", $player);
	//makes the hand display
	for($i = 0; $i < count($makeHands[$player]); $i++){
		printf("<div class='combo'>\n");//contain the card button combo in a class called combo
	
		printf("<img border='0' class='card' src='reg_cards/%s.png'>\n",$makeHands[$player][$i]);//bring in image
	
		$j = $i+ 1;
		printf("<button type='button' data-xml='%s' dCard='%s' class='discardCard' class='dbutton'>Discard %s</button>\n", $player,$i,$j);
		printf("</div>\n");
	}
	
	printf("</div>
	");
	
	//makes discard buttons based upon the number of cards in hand
	
	
}


//draws a random card from the deck by generating a random number that isn't in the drawn cards array
//$makeHands is the array of hands, $deck is the deck, $player is the player number that is drawing the card (1-8)
//10-11-2013 AK
Function drawCard(&$makeHands,&$usedCards,$player,&$deck){
	
	
	
	$rand =  array_rand($deck, 1);
	array_push($makeHands[$player], $deck[$rand]);
	array_push($makeHands[0], $rand);
	array_push($usedCards, $deck[$rand]); 

	removeCardFromDeck($deck, $rand);
		
	//returns the updated $makeHands
	//var_dump($makeHands[$player]);
}


//unsets A value from the deck
//takes in deck and random index ($rand) of the deck (deck is passed via reference so it will be modified within
//10-17-2013 AK
function removeCardFromDeck(&$deck, $rand){
	unset($deck[$rand]);
	$deck = array_values($deck);
}


//shuffles the deck in the event the deck runs out of cards
//takes in $deck by reference cards in hands


//redisplays the discard pile
//10-16-2013 AK
Function displayPile($discardPile){
	printf("<img border='0' src='reg_cards/%s.png' alt='discard'>",end($discardPile));
}


//Discards a card and puts it in the usedcards array
//returns make hands with the discarded card added to used cards array makeHands[0]
//10-15-2013 AK
Function discardCard(&$makeHands,$dCard,$player,&$discardPile){

	//var_dump($makeHands[0]);
	array_push($makeHands[0], $makeHands[$player][$dCard]);
	array_push($discardPile, $makeHands[$player][$dCard]);//adds card to the discard pile array
	//unsets the card
	unset($makeHands[$player][$dCard]);
		
	$makeHands[$player] = array_values($makeHands[$player]);//reindexes the hands array
	
	return $makeHands;
	//var_dump($makeHands[$player]);
}


//allows the player to draw from the discard pile
//returns the updated discard pile
//10-16-2013 AK
function pileDraw(&$discardPile,$player,&$makeHands){
	array_push($makeHands[$player],array_pop($discardPile));
}


//used to check if a players hand has any books(sets of 3 or greater)
//takes in the players hand,round number
Function whatAreTheBooks($makeHands, $player){
	$books = array();//Stores a book in progress
	$allBooks= array();//stores the array of books
	$counter = 0;
	for($i = 0; $i < count($makeHands[$player])-1; $i++){  //will iterate through the hand
		if($makeHands[$player][$i][0] == $makeHands[$player][$i+1][0]){
			echo "<h1>" . $i. " and ".($i+1) . " are the same<h1>";
			$counter++;
			array_push($books, $makeHands[$player][$i]);
			echo "counter and books";
			var_dump($counter);
			var_dump($books);
			echo "the conditional's are";
			var_dump($makeHands[$player][$i][0]);
			var_dump($makeHands[$player][$i+1][0]);
		}
		else{
			echo "<h1>counter is reset</h1>";
			$counter = 0;
			$books = array();
		}
		if($counter === 3){
			array_push($allBooks, $books);
		}
		if($counter > 3){
			array_push($allBooks, end($books));
		}
	}
	return $allBooks;
	//var_dump($allBooks);
}



?>

