<?php session_start(); ?>
<?php include 'functions.php' ?>
 

 <?php
 //this ran when the player wants to draw a card from the discard pile doesn't update the players hand so it needs to be ran with  
 
 //used to keep track of the variables in the stack
 $numPlayers = $_SESSION['numPlayers'];
 $makeHands = $_SESSION['makeHands'];
 $usedCards = $_SESSION['usedCards'];
 $numDecks = $_SESSION['numDecks'];
 $deck = $_SESSION['deck'];
 $discardPile =$_SESSION['discardPile'];
 $scores = $_SESSION['scores'];
 $roundNum = $_SESSION['roundNum'] ;
 $player =$_POST['player'];
 
 
 

 $books = win($makeHands, $player, $roundNum);
//var_dump($books);

echo "<h3>the score is some large amount</h3>";

?>