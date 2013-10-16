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
 $player =$_POST['player'];
 
 
 $_SESSION['makeHands'] = pileDraw($discardPile,$player,$makeHands);
 displayPile($_SESSION['discardPile']);
?>