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
 $player =$_POST['player'];
 

 pileDraw($_SESSION['discardPile'],$_POST['player'],$_SESSION['makeHands']);//moves one card from the discard pile to the players hand


 //displays the updated hands
displayAllHandsTable($_SESSION['numPlayers'],$_SESSION['makeHands']);
?>