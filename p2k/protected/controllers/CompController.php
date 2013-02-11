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
		
		$sTitle = $oMatchList->data[0]->id > 96 ?
			'Плэй-офф':
			'Групповой этап'
		;
		
		$this->render(
			'index',
			array(
				'oUser'		=> Yii::app()->user->getModel(),
				'sTitle'		=> $sTitle,
				'oMatchList'	=> $oMatchList,
				'aSt'			=> array(),
			)
		);
	}
}
?>
