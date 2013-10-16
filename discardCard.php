<?php session_start(); ?>
<?php include 'functions.php' ?>
 

 <?php
 //used to keep track of the variables in the stack
 $numPlayers = $_SESSION['numPlayers'];
 $makeHands = $_SESSION['makeHands'];
 $usedCards = $_SESSION['usedCards'];
 $numDecks = $_SESSION['numDecks'];
 $deck = $_SESSION['deck'];
 $player =$_POST['player'];
 $dCard =$_POST['dCard'];

 
 //Returns the makeHands object updated with one more card depending upon what player it was attached to.
 //deck 
 
//var_dump($_POST['player']);
$_SESSION['makeHands'] = discardCard($_SESSION['makeHands'],$_POST['dCard'],$_POST['player']);


//reprints all the hands (ran through ajax to places old card html
displayAllHandsTable($_SESSION['numPlayers'],$_SESSION['makeHands']);

 
?>