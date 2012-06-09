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
			
			if( data != '' ){
				$('#'+match_id+'-home').html('');
				$('#'+match_id+'-away').html('');
				if( bet == 0 ){
					$('#'+match_id+'-home').html(data);
				} else {
					$('#'+match_id+'-away').html(data);
				}
			}
		}
	);
}