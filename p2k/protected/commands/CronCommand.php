<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CronCommands
 *
 * @author pavel
 */
include( Yii::app()->getBasePath().'/components/simple_html_dom.php');
//include( Yii::app()->getBasePath().'/models/Match.php');

class CronCommand extends CConsoleCommand{
	
	public function actionGetResults(){
		
		$aMatches = Match::model()->findAllByAttributes(
			array('get_result' => 0)
		);
		
		foreach( $aMatches as $oMatch ){
			if(
				strtotime($oMatch->date)+90*60 < date(mktime())

			){
				
				$oHome = Team::model()->findByPk($oMatch->home_id);
				$oAway = Team::model()->findByPk($oMatch->away_id);
				$sUrl = 'http://yandex.ru/yandsearch?text='.$oHome->name.'+'.$oAway->name;
				echo $sUrl."\n";
				$html = file_get_html($sUrl); 
		
				$ret = $html->find("html/body/div[2]/div[1]/div/div[2]/ol/li[1]/h2/span[1]");
				$ret2 = $html->find("html/body/div[2]/div[1]/div/div[2]/ol/li[1]/h2/span[2]");

				if(trim($ret2[0]->plaintext) == 'матч окончен'){
					$aScore = explode(':', $ret[0]->plaintext);
					$oMatch->home_score = trim($aScore[0]);
					$oMatch->away_score = trim($aScore[1]);
					$oMatch->get_result = 1;
					$oMatch->save();
				}
				sleep(3);
			}
			
		}
		
		
		
		echo "ok \n";
	}
}

?>
