<?php
$aMyMatches = array();
$aMyMatchesIds = array();
if( !Yii::app()->user->isGuest ){
	$iUserId = UserIdentity::getUserId( Yii::app()->user->name );
	// получим мои матчи
	$aMyMatches = UserMatch::model()->findAllByAttributes(
		array( 'user_id' => $iUserId ),
		array( 'index'	=> 'match_id' )
	);
	$aMyMatchesIds = array_keys( $aMyMatches );
}

if( in_array( $data->id, $aMyMatchesIds ) ){
	$sClass = 'bred';
} else {
	$sClass = 'bgreen';
}

$sLabelClass = 'label-info';


$aBet = array(
	0 => '',
	1 => ''
);

$oUserMatch = UserMatch::model()->findByAttributes(array('match_id' => $data->id));

if( $oUserMatch ){
	if( $oUserMatch->is_done ){
		
		$aBet[ $oUserMatch->bet ] = UserIdentity::getUserName( $oUserMatch->user_id);
		$oMatch = Match::model()->findByPk( $data->id );
		if(strtotime($oMatch->date) < date(mktime()) ){
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
	
}

if(strtotime($data->date) >= date(mktime()) + 90*60*60 ){
	$sHomeScore = ' - ';
	$sAwayScore = ' - ';
}else {
	$sHomeScore = ' '.$data->home_score.' ';
	$sAwayScore = ' '.$data->away_score.' ';
}

?>


<tr class="<?= $sClass?>">

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
			
		<?php echo $data->home ?>&nbsp;<img height="15" width="22"  src="/images/flags/<?php echo $data->home ?>.png" />&nbsp;
		<span style="font-weight: bold;"><?=$sHomeScore?></span>
	</td>
	
	<td class="ar bet" data="1" style="text-align:left;">
		
		<span style="font-weight: bold;"><?=$sAwayScore?></span>
		
		&nbsp<img height="15" width="22"  src="/images/flags/<?php echo $data->away ?>.png" />&nbsp;<?php echo $data->away ?>
		<span class="away" id="<?php echo $data->id.'-away' ?>" >
		
		<?php if( $aBet[1] ){ ?>
			<span class="label <?=$sLabelClass?>">
				<?php echo $aBet[1].' '?>
			</span>	
		<?php } ?>
		</span>&nbsp;
	</td>
	
</tr>
