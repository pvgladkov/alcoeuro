<?php

class UserStat extends CComponent{
	
	private $oUser;
	
	public function init(){
		
	}
	
	public function __construct( $oUser ) {
		$this->oUser = $oUser;
	}
	
	/**
	 * 
	 */
	public function getStat(){
		
		$iWin = 0;
		$aAll = UserMatch::getUserMatches( $this->oUser->id );
		
		foreach( $aAll as $oUserMatch ){
			if( $oUserMatch->checkMatch() == 'yes' ){
				$iWin++;
			}
		}
		
		$aReturn = array(
			'username' => $this->oUser->getName(),
			'all'=> count( $aAll ),
			'win' => $iWin,
			'tie' => 0,
		);
		
		return $aReturn;
	}
	
	/**
	 * Получить статистику по играм пользователя
	 */
	public function getGamesStat(){
		$aReturn = array();
		$aGameIds = GameUser::getUserGames($this->oUser->id);
		$aGames = Game::model()->findAllByPk($aGameIds);
		foreach( $aGames as $oGame ){
			$aReturn[$oGame->id] = $this->getGameStat($oGame);
		}
		return $aReturn;
	}

	/**
	 * 
	 * @param Game $oGame
	 */
	public function getGameStat( Game $oGame ){
		
		// получим ставки пользователя в этой игре
		$aUserMatches = UserMatch::getUserMatches( $this->oUser->id, $oGame );
		
		$iWin = 0;
		
		foreach( $aUserMatches as $oUserMatch ){
			if( $oUserMatch->checkMatch() == 'yes' ){
				$iWin++;
			}
		}
		
		$aReturn = array(
			'name' => $oGame->nickname,
			'all' => count( $aUserMatches ),
			'win' => $iWin
		);
		
		return $aReturn;
	}
	
}
?>
