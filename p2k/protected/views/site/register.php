<h1>Регистрация</h1>


 <!-- То самое место где будут выводиться ошибки
     если они будут при валидации !-->
<?=CHtml::errorSummary( $form ); ?><br>

<?php $_form=$this->beginWidget('CActiveForm', array(
	'id'=>'login-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>

    <table id="form2" border="0" width="400" cellpadding="10" cellspacing="10">
         <tr>
            <!-- Выводим поле для логина !-->
            <td width="150"><?=$_form->labelEx( $form, 'email' ); ?></td>
            <td><?=$_form->textField( $form, 'email' ) ?></td>
         </tr>
        <tr>
            <!-- Выводим поле для пароля !-->
            <td><?=$_form->labelEx( $form, 'password' ); ?></td>
            <td><?=$_form->passwordField( $form, 'password' ) ?></td>
         </tr>
       
        <tr>
            <td></td>
            <!-- Кнопка "регистрация" !-->
             <td><?=CHtml::submitButton( 'Регистрация', array('id' => "submit") ); ?></td>
        </tr>
    </table>

<?php $this->endWidget(); ?>