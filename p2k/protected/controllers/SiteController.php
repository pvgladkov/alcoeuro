<?php

class SiteController extends Controller
{
	private $aUrls = array(
		//array('label'=>'Home', 'url'=>'/', 'active'=>false),
		array('label'=>'Алкорейтинг', 'url'=>'/site/table', 'active'=>false),
		array('label'=>'О нас', 'url'=>'/site/about', 'active'=>false),
		
	);
	
	/**
	 * Declares class-based actions.
	 */
	public function actions() {
		
		return array(
			
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),

			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * Основной индекс
	 * 
	 */
	public function actionIndex(){
		

		if( Yii::app()->user->isGuest ){
			$sUserName = '%Username%';
		} else {
			$sUserName = Yii::app()->user->name;
			$iUserId = UserIdentity::getUserId( $sUserName );

		}

		$oMatchList = new CActiveDataProvider(
			'Match',
			array(
				'pagination' => array(
					'pageSize' => 30,
				),
			)
		);
		
		$this->render('index', array(
			'sUserName' => $sUserName,
			'oMatchList'	=> $oMatchList,
		));
	}

	/**
	 * Страница about
	 */
	public function actionAbout(){
		
		$oUser = new User();
		$oUser->setAttributes(array(
			'name' => 'Pavel'
		));
		//$oUser->save();
		
		$this->render('about');
	}
	
	/**
	 * Таблица
	 */
	public function actionTable(){
		
		$aStat = array(
			1 => 0,
			2 => 0,
			3 => 0,
			4 => 0,
		);	
		
		$aUserMatches = UserMatch::model()->findAll();
		
		foreach( $aUserMatches as $oUserMatch){
			if( $oUserMatch->checkMatch() == 'yes' ){
				$aStat[ $oUserMatch->user_id ]++;
			}
			
			if( $oUserMatch->checkMatch() == 'no' ){
				for( $i = 1; $i < 5; $i++ ){
					if( $i == $oUserMatch->user_id ){
						continue;
					}
					$aStat[ $i ]++;
				}
				
			}
		}
		
		$aSt = array();
		
		foreach( $aStat as $key=>$val ){
			$aSt[] = array(
				'id' => $key,
				'score' => $val
			);
		}
		
		for( $i=0; $i< 4; $i++){
			for( $j=$i; $j< 4; $j++){
				if( $aSt[$j]['score'] > $aSt[$i]['score'] ){
					// меняем
					$aTmp['id'] = $aSt[$j]['id'];
					$aTmp['score'] = $aSt[$j]['score'];
					$aSt[$j]['id'] = $aSt[$i]['id'];
					$aSt[$j]['score'] = $aSt[$i]['score'];
					$aSt[$i]['id'] = $aTmp['id'];
					$aSt[$i]['score'] = $aTmp['score'];
				}
			}
		}
		
		//var_dump($aSt);
		//die();
		
		$this->render('table', array(
			'aStat' => $aStat,
			'aSt' => $aSt
		));
	}

		
	/**
	 * Верхняя менюшка
	 * 
	 * @return array 
	 */
	public function getMenu(){
		
		
		foreach( $this->aUrls as $key => $aItem ) {
			if( $aItem['url'] == '/'.Yii::app()->request->getPathInfo()  ) {
				$this->aUrls[$key]['active'] = true;
			}
		}
		
		$aMenu = array(
			array(
				'class'=>'bootstrap.widgets.BootMenu',
				'items'=> $this->aUrls
			),
		);
		
		if( Yii::app()->user->isGuest ){
			$aMenu[] = array(
				'class'=>'bootstrap.widgets.BootMenu',
				'htmlOptions'=>array('class'=>'pull-right'),
				'items'=>array(
					array('label'=>'Login', 'url'=>'/site/login'),
				),
			);

		} else {
			$aMenu[] = array(
				'class'=>'bootstrap.widgets.BootMenu',
				'htmlOptions'=>array('class'=>'pull-right'),
				'items'=>array(
					array('label'=>'Logout', 'url'=>'/site/logout'),
				),
			);
		}
		
		return $aMenu;
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin() {
		
		$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form') {
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm'])) {
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
				$this->redirect('/');
		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout() {
		Yii::app()->user->logout();
		
		$this->redirect('/');
	}
	
	/**
	 * аяксовая голосовалка
	 */
	public function actionBet(){
		
		if( !Yii::app()->user->isGuest ){
			
			$iMatchId = Yii::app()->request->getParam('match_id');
			$bBet = Yii::app()->request->getParam('bet');
		
			$iUserId = UserIdentity::getUserId( Yii::app()->user->name );
		
			$aMyMatches = UserMatch::model()->findAllByAttributes(
				array( 'user_id' => $iUserId ),
				array( 'index'	=> 'match_id' )
			);
			$aMyMatchesIds = array_keys( $aMyMatches );
			
			if( in_array( $iMatchId, $aMyMatchesIds ) ){
				
				$oMatch = Match::model()->findByPk( $iMatchId );
				// время не ислекло
				if(strtotime($oMatch->date) >= date(mktime()) ){
					// проставить
					$oUSerMatch = UserMatch::model()->findByAttributes(array( 'match_id' => $iMatchId ));
					$oUSerMatch->bet = $bBet;
					$oUSerMatch->is_done = 1;
					$oUSerMatch->save();

					echo '<span class="label label-info">'.UserIdentity::getUserName($iUserId).'</span>';
				}
				
			}

		}
		
		echo '';
	}
}