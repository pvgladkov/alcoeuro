<?php

class GameController extends Controller
{
	/**
	 * 
	 */
	public function actionIndex(){
		
	}

	/**
	 * 
	 */
	public function actionNew(){

		$aForm = Yii::app()->request->getPost( 'NewGameForm' );
		$oGame = new Game();
		$oNewGameForm = new NewGameForm();
		
		$aUsers = User::model()->findAll(array('index' => 'id'));

		foreach( $aUsers as $key => $oUser ){
			$aUsers[$key] = $oUser->getName();
		}
		
		if( !empty($aForm) ){
			$oNewGameForm->attributes = $aForm;
			$oNewGameForm->owner_id = Yii::app()->user->getId();

			if( $oNewGameForm->validate() ){
				$oGame->attributes = $oNewGameForm->attributes;
				$aUsers = array_merge($aUsers, array($oGame->owner_id => $oGame->owner_id));
				if( $oGame->save() ){
					$oGame->linkUsers( $oNewGameForm->users );
					$this->redirect( '/' );
				}
			}	
		}
		$this->render(
			'new',
			array(
				'oNewGameForm'	=> $oNewGameForm,
				'aUsers'		=> $aUsers
			)
		);
	}
	
	/**
	 * 
	 */
	public function actionDelete( $id ){
		
		Game::model()->deleteByPk($id);	
	}
}
?>
