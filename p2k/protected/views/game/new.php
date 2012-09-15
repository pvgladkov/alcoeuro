<br/>
<br/>
<br/>

<?php $form = $this->beginWidget('CActiveForm', array(
	'id'=>'newgame-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); 
?>

	<div class="row">
		<?php echo $form->labelEx( $oNewGameForm,'nickname' ); ?>
		<?php echo $form->textField( $oNewGameForm,'nickname' ); ?>
		<?php echo $form->error( $oNewGameForm,'nickname' ); ?>
	</div>

	<br/>
	
	<div class="checkbox inline">
		<p>участники</p>
		<?= CHtml::checkBoxList( 'NewGameForm[users]', array(), $aUsers )?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Создать'); ?>
	</div>

<?php $this->endWidget(); ?>
</div><!-- form -->