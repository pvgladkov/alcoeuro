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
					'pageSize' => 30,
				)
			)
		);
		
		$this->render('index', array(
			'oMatchList'	=> $oMatchList,
			'aSt'			=> array(),
		));
	}
}
?>
