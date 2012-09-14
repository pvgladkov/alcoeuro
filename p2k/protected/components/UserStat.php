<?php

class UserStat extends CComponent{
	
	private $oUser;
	
	public function init(){
		
	}
	
	public function __construct( $oUser ) {
		$this->oUser = $oUser;
	}
	
	/**
	 * 
	 */
	public function getStat(){
		
		$aReturn = array(
			'all' => 0,
			'win' => 0,
			'tie' => 0,
		);
		
		return $aReturn;
	}
	
}
?>
