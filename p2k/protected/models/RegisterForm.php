<?php

/**
 * RegisterForm class.
 * RegisterForm is the data structure for keeping
 * 
 */
class RegisterForm extends CFormModel {
	
	public $email;
	public $password;
	public $password2;

	/**
	 * Declares the validation rules.
	 * The rules state that username and password are required,
	 * and password needs to be authenticated.
	 */
	public function rules(){
		return array(
			// username and password are required
			array( 'email, password, password2', 'required' ),
			array( 'password2', 'confirmPassword'),
			array( 'email', 'unique'),
		);
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels(){
		
		return array(
			'email'=>'Email',
			'password' => 'Password',
			'password2' => 'Password'
		);
	}
	
	public function unique(){
		
		$oUser = User::model()->scopeEmail( $this->email )->findAll();
		if( $oUser ){
			$this->addError( 'email', 'email занят' );
		}
	}
	
	public function confirmPassword(){
		
		if( $this->password != $this->password2 ){
			$this->addError('password2', 'пароли не совпадают');
		}
	}

}
