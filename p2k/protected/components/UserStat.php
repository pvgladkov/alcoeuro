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
	public function getStat( Game $oGame = null ){
		
		$iWin = 0;
		$aAll = UserMatch::getUserMatches( $this->oUser->id, $oGame );
		
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
		$aGameIds = GameUser::getUserGames( $this->oUser->id );
		$aGames = Game::model()->findAllByPk( $aGameIds );
		foreach( $aGames as $oGame ){
			$aReturn[$oGame->id] = $this->getTotalStat( $oGame );
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
	
	/**
	 * Турнираня таблица
	 * @param Game $oGame
	 * @return type
	 */
	public static function getTotalStat( Game $oGame = null ){
		$aStat = array();
		$aUsers = array();
		if( $oGame == null ){
			$aUsers = User::model()->findAll();
		} else {
			$aGameUsers = GameUser::model()->findAllByAttributes(
				array(
					'game_id' => $oGame->id
				), 
				array(
					'index' => 'user_id'
				)
			);
			if( !empty($aGameUsers) ){
				$aUsersIds = array_keys( $aGameUsers );
				$aUsers = User::model()->findAllByPk( $aUsersIds );
			}
		}
		
		
		foreach( $aUsers as $oUser ){
			$oStat = new UserStat( $oUser );
			$aStat[ $oUser->getName() ] = $oStat->getStat( $oGame );
		}
		
		usort( $aStat, function($a, $b){
			if ($a['win'] == $b['win']) return 0;
				return ($a['win'] > $b['win']) ? -1 : 1;
			}
		);
		
		return $aStat;
	}
	
}
?>