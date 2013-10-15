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
$_SESSION['makeHands'] = drawCard($_SESSION['makeHands'],$_SESSION['deck'],$_POST['player']);



printf ("<TABLE CELLSPACING=0 CELLPADDING=0>\n");
	for($i=1;$i <= $_SESSION['numPlayers']; $i++){
		displayHand($_SESSION['makeHands'],$i);
	}
	printf("</table>\n");
 
?>
 