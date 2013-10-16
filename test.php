<?php session_start(); ?>
<?php include 'functions.php' ?>
 

 <?php
 //used to keep track of the variables in the stack
 $numPlayers = $_SESSION['numPlayers'];
 $makeHands = $_SESSION['makeHands'];
 $usedCards = $_SESSION['usedCards'];
 $numDecks = $_SESSION['numDecks'];
 $deck = $_SESSION['deck'];
 $discardPile =$_SESSION['discardPile'];
 $handSize = $_SESSION['roundNum'] +2;
 
//insert function to test here
//var_dump($numPlayers);
//var_dump($handSize);
//var_dump($numDecks);
//var_dump($deck);
var_dump($_SESSION['makeHands']);
 
 
 
?>