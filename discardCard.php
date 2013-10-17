<?php session_start(); ?>
<?php include 'functions.php' ?>
 

 <?php
 //needs to be ran with a display discard 
 //updates the hands
 //runs the discardCard function by appling play,card position in array to it
 //returns an updated makehands(player hands) and updates the discard pile with the card that was discarded
 
 //used to keep track of the variables in the stack
 $numPlayers = $_SESSION['numPlayers'];
 $makeHands = $_SESSION['makeHands'];
 $usedCards = $_SESSION['usedCards'];
 $numDecks = $_SESSION['numDecks'];
 $deck = $_SESSION['deck'];
 $player =$_POST['player'];
 $dCard =$_POST['dCard'];
 $discardPile =$_SESSION['discardPile'];
 
 //Returns the makeHands object updated with one more card depending upon what player it was attached to.
 //deck 
 

discardCard($_SESSION['makeHands'],$_POST['dCard'],$_POST['player'],$_SESSION['discardPile']);


//reprints all the hands (ran through ajax to places old card html
displayAllHandsTable($_SESSION['numPlayers'],$_SESSION['makeHands']);

 
?>