$(document).ready(function() {
	
	
	$('.bet').click(function(){
		bet(1,1);
	})
});

function bet( match_id, bet ){
	$.post(
		'/site/bet',
		{
			'match_id': match_id,
			'bet': bet
		},
		function(data){
			
		}
	);
}