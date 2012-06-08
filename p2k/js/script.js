$(document).ready(function() {
	
	
	$('.bet').click(function(){
		bet( $(this).parent().children('.match-id').text(), $(this).attr('data'));
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
			if( data > 0 ){
				if( bet == 0 ){
					$(this).children('.home').html(data);
				} else {
					$(this).children('.away').html(data);
				}
			}
		}
	);
}