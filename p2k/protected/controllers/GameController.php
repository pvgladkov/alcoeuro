<?php

class GameController extends Controller
{
	
	/**
	 * 
	 */
	public function actionCreate(){
	
		$oGame = new Game();
		$oGame->owner_id = Yii::app()->user->getId();
		$oGame->save();
	}
	
	/**
	 * 
	 */
	public function actionDelete( $id ){
		
		Game::model()->deleteByPk($id);	
	}
}
?>
