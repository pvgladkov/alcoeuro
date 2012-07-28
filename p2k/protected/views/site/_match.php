<?php

$oUserMatch = null;

if( !Yii::app()->user->isGuest ){

	$oUserMatch = UserMatch::model()->findByAttributes(
		array(
			'match_id'	=> $data->id,
			'user_id'	=> Yii::app()->user->getId()
		)
	);
}

$sLabelClass = 'label-info';

$aBet = array(
	0 => '',
	1 => ''
);

if( $oUserMatch ){
	
	$aBet[ $oUserMatch->bet ] = Yii::app()->user->getName();
	$oMatch = Match::model()->findByPk( $data->id );
	if(strtotime( $oMatch->date )+90*60 < date( mktime() ) ){
		if( $oUserMatch->checkMatch() == 'yes' ){
			$sLabelClass = 'label-success';
		} 
		elseif( $oUserMatch->checkMatch() == 'draw' ) {
			$sLabelClass = 'label-warning';
		} else {
			$sLabelClass = 'label-important';
		}
	}
}

if( !$data->get_result ){
	$sHomeScore = ' - ';
	$sAwayScore = ' - ';
}else {
	$sHomeScore = ' '.$data->home_score.' ';
	$sAwayScore = ' '.$data->away_score.' ';
}

?>


<tr class="alert alert-success" style="color:black">

	<td class="ar match-id"><?php echo $data->id ?></td>
	<td class="ar "><?php echo TransDataComponent::getHumanDateTime($data->date) ?></td>
	
	<td class="ar bet" data="0" style="text-align:right;">
			
			<span class="home" id="<?php echo $data->id.'-home' ?>">
			<?php if( $aBet[0] ){ ?>
				<span class="label <?=$sLabelClass?>">
					<?php echo $aBet[0].' '?>
				</span>	
			<?php } ?>
			</span>&nbsp;
			
		<?php echo $data->home_id ?>&nbsp;<img height="15" width="22"  src="/images/flags/<?php echo $data->home_id ?>.png" />&nbsp;
		<span style="font-weight: bold;"><?=$sHomeScore?></span>
	</td>
	
	<td class="ar bet" data="1" style="text-align:left;">
		
		<span style="font-weight: bold;"><?=$sAwayScore?></span>
		
		&nbsp<img height="15" width="22"  src="/images/flags/<?php echo $data->away_id ?>.png" />&nbsp;<?php echo $data->away_id ?>
		<span class="away" id="<?php echo $data->id.'-away' ?>" >
		
		<?php if( $aBet[1] ){ ?>
			<span class="label <?=$sLabelClass?>">
				<?php echo $aBet[1].' '?>
			</span>	
		<?php } ?>
		</span>&nbsp;
	</td>
	
</tr>
