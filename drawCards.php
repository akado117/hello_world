<?php session_start(); ?>
<?php include 'functions.php' ?>
 

 <?php
 $numPlayers = $_SESSION['numPlayers'];
 $makeHands = $_SESSION['makeHands'];
 $usedCards = $_SESSION['usedCards'];
 $numDecks = $_SESSION['numDecks'];
 $deck = $_SESSION['deck'];
 $player =$_POST['player'];

 
 //Returns the makeHands object updated with one more card depending upon what player it was attached to.
 //deck 
$_SESSION['makeHands'] = drawCard($_SESSION['makeHands'],$_SESSION['usedCards'],
$_POST['player'],$_SESSION['numDecks'],$_SESSION['deck']);

$_SESSION['usedCards'] = $_SESSION['makeHands'][0];
//var_dump($SESSION_['usedCards']);

displayAllHandsTable($_SESSION['numPlayers'],$_SESSION['makeHands']);
 
?>
 