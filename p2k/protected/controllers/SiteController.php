<?php

class SiteController extends Controller
{
	private $aUrls = array(
		array('label'=>'Home', 'url'=>'/', 'active'=>false),
		array('label'=>'About', 'url'=>'/site/about', 'active'=>false),
		array('label'=>'Table', 'url'=>'/site/table', 'active'=>false),
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
		
		$oUserList = new CActiveDataProvider(
			'User',
			array(
				'pagination' => array(
					'pageSize' => 3,
				),
			)
		);
		
		
		$this->render('table', array(
			'oUserList' => $oUserList
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
	
	public function actionBet(){
		
	}
}