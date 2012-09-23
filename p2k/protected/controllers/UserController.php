<?php
class UserController extends Controller{
	
	public function actionIndex( $id ){
		
	
		$oUser = User::model()->findByPk($id);
		if( !$oUser ){
			throw new Exception( '404' );
		}
		
		$sTitle = 'Ставки '. $oUser->getName();
		
		$s = date('Y-m-d');
		
		$aUserMatches = UserMatch::model()->findAllByAttributes(
			array(
				'user_id' => $oUser->id
			), 
			array(
				'index' => 'match_id',
			)
		);
		
		
		if( empty($aUserMatches) ){
			
			$this->render(
				'index',
				array(
					'sTitle' => $sTitle,
				)
			);
			Yii::app()->end();
		}

		$aUserMatches = array_keys( $aUserMatches );
		
		$sUserMatches = implode(',', $aUserMatches);

		$oMatchList = new CActiveDataProvider(
			'Match',
			array(
				'criteria'	=> array(
					 'condition'=>"id IN ( $sUserMatches ) AND date < '$s'",
				),
				'pagination'	=> array(
					'pageSize' => 16,
				)
			)
		);


		$this->render(
			'/comp/index',
			array(
				'sTitle' => $sTitle,
				'oMatchList'	=> $oMatchList,
				'aSt'			=> array(),
			)
		);
	}
}
?>
