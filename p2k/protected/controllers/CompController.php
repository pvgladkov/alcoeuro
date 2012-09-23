<?php
class CompController extends Controller{

	/**
	 * 
	 * @return type
	 */
	public function filters() {
		return array(
			'IsGuest'
		);
	}


	/**
	 * 
	 * @param type $id
	 */
	public function actionIndex( $id ){

		$oMatchList = new CActiveDataProvider(
			'Match',
			array(
				'criteria'	=> array(
					 'condition'=>"competition_id=$id",
				),
				'pagination'	=> array(
					'pageSize' => 16,
				)
			)
		);
		
		$this->render(
			'index',
			array(
				'oUser'		=> Yii::app()->user->getModel(),
				'sTitle'		=> 'Групповой этап',
				'oMatchList'	=> $oMatchList,
				'aSt'			=> array(),
			)
		);
	}
}
?>
