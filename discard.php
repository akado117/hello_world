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
 
$holder = updateDiscard($_SESSION['makeHands']);
//var_dump($holder);
array_push($_SESSION['discardPile'], $holder);
//var_dump($_SESSION['discardPile']);
 
?>