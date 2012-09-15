<?php

/**
 * NewGameForm class.
 * NewGameForm is the data structure for keeping
 * 
 */
class NewGameForm extends CFormModel {
	
	public $nickname;
	public $users;
	public $owner_id;

	/**
	 * Declares the validation rules.
	 * The rules state that username and password are required,
	 * and password needs to be authenticated.
	 */
	public function rules(){
		return array(
			// username and password are required
			array( 'nickname', 'required' ),
			array( 'nickname, users', 'safe' )
		);
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels(){
		
		return array(
			'nickname'=>'Название игры',
		);
	}
	
	/**
	 * 
	 */
	public function unique(){
		
		$oGame = Game::model()->scopeEmail( $this->nickname )->findAll();
		if( $oGame ){
			$this->addError( 'nickname', 'nickname занят' );
		}
	}
	
}
