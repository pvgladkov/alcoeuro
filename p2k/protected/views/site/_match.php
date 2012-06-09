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

if( in_array( $data->id, $aMyMatchesIds ) &&  !$aMyMatches[$data->id]->is_done ){
	$sClass = 'bred';
} else {
	$sClass = 'bgreen';
}

$aBet = array(
	0 => '',
	1 => ''
);

$oUserMatch = UserMatch::model()->findByAttributes(array('match_id' => $data->id));

if( $oUserMatch ){
	if( $oUserMatch->is_done ){
		
		$aBet[ $oUserMatch->bet ] = UserIdentity::getUserName( $oUserMatch->user_id);
	}
}

?>


<tr class="<?= $sClass?>">

	<td class="ar match-id"><?php echo $data->id ?></td>
	<td class="ar "><?php echo $data->date ?></td>
	<td class="ar bet" data="0">
		
			<span class="home" id="<?php echo $data->id.'-home' ?>">
			<?php if( $aBet[0] ){ ?>
				<span class="label label-info">
					<?php echo $aBet[0].' '?>
				</span>	
			<?php } ?>
		</span>&nbsp;
		<img height="15" width="22"  src="/images/flags/<?php echo $data->home ?>.png" />&nbsp;<?php echo $data->home ?>
	</td>
	<td class="ar bet" data="1" >
		
		
		<img height="15" width="22"  src="/images/flags/<?php echo $data->away ?>.png" />&nbsp;<?php echo $data->away ?>
		<span class="away" id="<?php echo $data->id.'-away' ?>" >
		
		<?php if( $aBet[1] ){ ?>
			<span class="label label-info">
				<?php echo $aBet[1].' '?>
			</span>	
		<?php } ?>
		</span>&nbsp;
	</td>
	
</tr>
