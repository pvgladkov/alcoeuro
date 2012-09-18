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
	<?php CHtml::$afterRequiredLabel = '';?>
	<div class="row">
		<h3><?= $form->labelEx( $model,'username' ); ?></h3>
		<?= $form->textField( $model,'username' ); ?>
		<?= $form->error( $model,'username' ); ?>
	</div>

	<div class="row">
		<h3><?= $form->labelEx($model,'password'); ?></h3>
		<?= $form->passwordField($model,'password'); ?>
		<?= $form->error($model,'password'); ?>

	</div>

		<button type="submit" class="btn btn-primary">Войти</button>
		<a class="btn" href="/register">Регистрация</a>
	

<?php $this->endWidget(); ?>
</div><!-- form -->
