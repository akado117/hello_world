<?php session_start(); ?>
<?php include 'functions.php' ?>
 

 <?php
//displays the check boxes where a player can select which cards to test for runs and books 
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
 
 
displayAllHandsCheckBox($numPlayers,$makeHands);





?>