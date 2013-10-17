hello_world
===========

5 crowns, a brief jump into the world of php app development. Using this as a "real world" learning experience and 
because creating things with code really is one of the greatest joys in life. 

hosted at fivecrowns.comze.com



I've been using Wamp to build and demo this page. Simply clone the code and place it all in one folder.

index.php - used as the initial landing page, gathers information concerning how many decks, players, and cards to draw
the cards to draw is actually a place holder variable for testing and is called round number
eventually the game will auto increment rounds as the game is played.

hands.php - the main page as of right now. Used to display and test the various functionality of the php scripts. Also a neat
little demo of how the final web apps html will more than likely look like.

functions.php - where most of the functionality of the app will be stored. Each function contains a brief header on what 
they do/what they output/and when they were last editted.

drawCards.php - is called when a card is drawn. Is dependent upon what player draws a card

discardCard.php - is called when a card is discarded. Is dependent upon both a player and card index

reset.php - Resets the deck. Intended to be a restart game function when all player data is already entered. 
