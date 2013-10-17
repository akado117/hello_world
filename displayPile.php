<?php session_start(); ?>
<?php include 'functions.php' ?>
 

 <?php
 //displays the discard pile
 
 //used to keep track of the variables in the stack
 $numPlayers = $_SESSION['numPlayers'];
 $makeHands = $_SESSION['makeHands'];
 $usedCards = $_SESSION['usedCards'];
 $numDecks = $_SESSION['numDecks'];
 $deck = $_SESSION['deck'];
 $discardPile =$_SESSION['discardPile'];
 
 displayPile($_SESSION['discardPile']);
?>