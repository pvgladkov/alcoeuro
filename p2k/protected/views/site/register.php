<h1>Регистрация</h1>



<div class="form">

<?php $_form=$this->beginWidget('CActiveForm', array(
	'id'=>'register-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>
	
	<div class="row">
		 <!-- Выводим поле для логина !-->
		<?=$_form->labelEx( $form, 'email' ); ?>
		<?=$_form->textField( $form, 'email' ) ?>
		<?=$_form->error( $form, 'email' ) ?>
	</div>
		 
	<div class="row">
		<!-- Выводим поле для пароля !-->
		<?=$_form->labelEx( $form, 'password' ); ?>
		<?=$_form->passwordField( $form, 'password' ) ?>
		<?=$_form->error( $form, 'password' ) ?>
	</div>

	<div class="row">
		<!-- Еще раз пароль !-->
		<?=$_form->labelEx( $form, 'password2' ); ?>
		<?=$_form->passwordField( $form, 'password2' ) ?>
		<?=$_form->error( $form, 'password2' ) ?>
	</div>

	<div class="row buttons">
		<!-- Кнопка "регистрация" !-->
		<?=CHtml::submitButton( 'Регистрация', array('id' => "submit") ); ?>
	</div>


<?php $this->endWidget(); ?>
</div>