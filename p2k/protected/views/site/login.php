<?php
$this->pageTitle=Yii::app()->name . ' - Login';
$this->breadcrumbs=array(
	'Login',
);
?>
<br/>
<br/>
<div class="form" style="text-align: center; padding-top: 70px" >
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'login-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>

	<div class="row">
		<?php echo $form->labelEx( $model,'username' ); ?>
		<?php echo $form->textField( $model,'username' ); ?>
		<?php echo $form->error( $model,'username' ); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'password'); ?>
		<?php echo $form->passwordField($model,'password'); ?>
		<?php echo $form->error($model,'password'); ?>

	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Login'); ?>
		<?php echo CHtml::link('Регистрация', '/register')?>
	</div>

<?php $this->endWidget(); ?>
</div><!-- form -->
