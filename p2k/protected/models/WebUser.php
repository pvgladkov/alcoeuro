<?php

class WebUser extends CWebUser {
	
	private $_model;
	
	public function getModel(){
		if( $this->_model === null ){
			$this->_model= User::model()->findByPk( $this->getId() );
        }
        return $this->_model;
	}
}
?>
