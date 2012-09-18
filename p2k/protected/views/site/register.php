<h1>Регистрация</h1>



<div class="form" style="text-align: center; padding-top: 70px" >

<?php $_form=$this->beginWidget('CActiveForm', array(
	'id'=>'register-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>
	<?php CHtml::$afterRequiredLabel = '';?>
	<div class="row">
		 <!-- Выводим поле для логина !-->
		<h3><?=$_form->labelEx( $form, 'email' ); ?></h3>
		<?=$_form->textField( $form, 'email' ) ?>
		<?=$_form->error( $form, 'email' ) ?>
	</div>
		 
	<div class="row">
		 <!-- Выводим поле для логина !-->
		<h3><?=$_form->labelEx( $form, 'nickname' ); ?></h3>
		<?=$_form->textField( $form, 'nickname' ) ?>
		<?=$_form->error( $form, 'nickname' ) ?>
	</div>
	
	<div class="row">
		<!-- Выводим поле для пароля !-->
		<h3><?=$_form->labelEx( $form, 'password' ); ?></h3>
		<?=$_form->passwordField( $form, 'password' ) ?>
		<?=$_form->error( $form, 'password' ) ?>
	</div>

	<div class="row">
		<!-- Еще раз пароль !-->
		<h3><?=$_form->labelEx( $form, 'password2' ); ?></h3>
		<?=$_form->passwordField( $form, 'password2' ) ?>
		<?=$_form->error( $form, 'password2' ) ?>
	</div>

	<div class="row buttons">
		<!-- Кнопка "регистрация" !-->
		<button type="submit" class="btn btn-primary">Готово</button>
	</div>


<?php $this->endWidget(); ?>
</div>