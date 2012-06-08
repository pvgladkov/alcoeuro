<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
	/**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */
	public function authenticate()
	{
		$users=array(
			// username => password
			'dimon'=>'dimon',
			'pavel'=>'pavel',
			'matt'	=> 'matt'
		);
		if(!isset($users[$this->username]))
			$this->errorCode=self::ERROR_USERNAME_INVALID;
		else if($users[$this->username]!==$this->password)
			$this->errorCode=self::ERROR_PASSWORD_INVALID;
		else
			$this->errorCode=self::ERROR_NONE;
		return !$this->errorCode;
	}
	
	public static function getUserId( $sName ){
		if( $sName == 'dimon' ) return 1;
		if( $sName == 'pavel' ) return 2;
		if( $sName == 'matt' ) return 3;
	}
	
	public static function getUserName( $iUserId ){
		if( $iUserId == 1 ) return 'Дима';
		if( $iUserId == 2 ) return 'Павел';
		if( $iUserId == 3 ) return 'Матвей';
	}
}