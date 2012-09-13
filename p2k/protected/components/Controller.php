<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{
	/**
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout='//layouts/column1';
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu=array();
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs=array();
	
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
	 *
	 * @var type 
	 */
	public $aUrls = array(
		//array('label'=>'Home', 'url'=>'/', 'active'=>false),
		array('label'=>'Алкорейтинг', 'url'=>'/site/table', 'active'=>false),
		array('label'=>'О нас', 'url'=>'/site/about', 'active'=>false),	
	);

	/**
	 * 
	 * @param type $filterChain
	 */
	public function filterIsGuest( $filterChain ){
		if( Yii::app()->user->isGuest ){
			$this->redirect('/site/hello');
		}
		$filterChain->run();
	}
}