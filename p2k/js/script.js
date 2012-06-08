$(document).ready(function() {
	
	
	$('.bet').click(function(){
		bet( $(this).parent().children('.match-id').text(), $(this).data('data'));
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