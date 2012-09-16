<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity{
	
	private $_id;
	
	/**
     * Authenticates a user using the User data model.
     * @return boolean whether authentication succeeds.
     */
	public function authenticate(){
		
		$oUser = User::model()
			->scopeEmail( $this->username ) // по email
			//->scopeNotDeleted()				// не удален
			->find()
		;
		
		if ($oUser === null){
			$this->errorCode = self::ERROR_USERNAME_INVALID;
		}else{
			if( $oUser->password !== $oUser->encrypt( $this->password )){
				$this->errorCode = self::ERROR_PASSWORD_INVALID;
			}else{
				
				// там еще дополнительные проверки
				if( $this->setId( $oUser ) ){

					$this->errorCode = self::ERROR_NONE;
				}else{
					$this->errorCode = self::ERROR_PASSWORD_INVALID;	
				}
			}
		}
		
		return !$this->errorCode;
		
	}

	public function getId(){
		return $this->_id;
	}

	/**
	 * Установить id пользователя и установить username (email)
	 * @param mixed $mUserId Id пользователя или объект пользователя
	 * @return boolean Существование пользователя с таким id
	 */
	public function setId( $mUserId ){
		
		if( is_object( $mUserId ) ){
			
			$iUserId	= $mUserId->id;
			$oUser		= $mUserId;
			
		} else {

			$oUser = User::model()->findByPk( $mUserId );
		}
			
		if( !$oUser ){
			return false;
		}
			
		$iUserId = $oUser->id;

		if( $oUser->nickname ){
			
			$this->username = $oUser->nickname;
		
		} elseif( $oUser->email ){
			
			$this->username = $oUser->email;
		
		} else {
			// непонятный аккаунт какой то
			return false;
		}
		
		$this->_id = $iUserId;
		return true;
		
	}
	
}