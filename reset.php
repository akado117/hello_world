<?php session_start(); ?>
<?php include 'functions.php' ?>
 

 <?php
 $numPlayers = $_SESSION['numPlayers'];
 $makeHands = $_SESSION['makeHands'];
 $usedCards = $_SESSION['usedCards'];
 $numDecks = $_SESSION['numDecks'];
 $roundNum = $_SESSION['roundNum'];
 $deck = $_SESSION['deck'];

 
 
//Make Deck from which cards will be drawn
$_SESSION['deck'] = makeDeck($_SESSION['numDecks']);
//var_dump($deck); Used to troubleshoot making the decks


//pull cards and make players hands
$_SESSION['makeHands'] = makeHands($_SESSION['numPlayers'],$_SESSION['roundNum']+2,$_SESSION['numDecks'],$_SESSION['deck']);
$_SESSION['usedCards'] = $_SESSION['makeHands'][0]; //draws usedCards from makeHands


//reset the discard pile 
$_SESSION['discardPile'] = array('b1fve');

displayAllHandsTable($_SESSION['numPlayers'],$_SESSION['makeHands']);

?>
 