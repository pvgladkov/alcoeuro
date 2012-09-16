<?php

/**
 * RegisterForm class.
 * RegisterForm is the data structure for keeping
 * 
 */
class RegisterForm extends CFormModel {
	
	public $email;
	public $nickname;
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
			array( 'nickname', 'uniqueUsername'),
			array( 'email, nickname, password', 'length', 'min' => 5)
		);
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels(){
		
		return array(
			'email'=>'Email',
			'nickname' => 'Username',
			'password' => 'пароль',
			'password2' => 'повторите пароль'
		);
	}
	
	public function unique(){
		
		$oUser = User::model()->scopeEmail( $this->email )->findAll();
		if( $oUser ){
			$this->addError( 'email', 'email занят' );
		}
	}
	
	public function uniqueUsername(){
		
		$oUser = User::model()->scopeNickname( $this->nickname )->findAll();
		if( $oUser ){
			$this->addError( 'nickname', 'username занят' );
		}
	}
	
	public function confirmPassword(){
		
		if( $this->password != $this->password2 ){
			$this->addError('password2', 'пароли не совпадают');
		}
	}

}
