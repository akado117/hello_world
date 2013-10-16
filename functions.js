//runs the ajax functionality needed to run discardCard and rebinds the event upon completion
function clickDiscard() { 
	playerid = $(this).attr("data-xml");
    dCard = $(this).attr("dCard");
    $.ajax({ //calls to get rid 
        type: "POST", 
        url: "discardCard.php", 
        data: {player: playerid, dCard:dCard}, 
        success: function(msg){  
            //alert('ajax function starts');
            $('#playerHands').html(msg);
			$.ajax({ //calls to update the discard pile
				type: "POST", 
				url: "discard.php", 
				success: function(msg){  
					$('#discardPile').html(msg);
				}
			});
            $(".discardCard").on("click", clickDiscard);
            //alert('ajax function finishes')
        }
    });
		
	
	
}
