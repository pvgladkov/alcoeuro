<?php

/**
 * This is the model class for table "matches".
 *
 * The followings are the available columns in table 'user_matches':
 * @property date $day
 */
class UserMatch extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Metro the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'user_matches';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	
	
	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'id',
			'user_id' => 'user_id',
			'bet'	=> 'bet',
			'is_done' => 'is_done'
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('user_id',$this->user_id,true);
		$criteria->compare('bet',$this->bet,true);
		$criteria->compare('is_done',$this->is_done,true);
		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
	
	/**
	 * Проверка результата
	 * @return string
	 */
	public function checkMatch(){
		
		$oMatch = Match::model()->findByPk( $this->match_id );
		
		// матч начался, а ставка не сделана
		if( strtotime($oMatch->date) < date(mktime()) && !$this->is_done ){
			return 'no';
		}
		
		if( $oMatch->home_score == $oMatch->away_score ){
			return 'draw';
		}
		
		if( $oMatch->home_score > $oMatch->away_score  && $this->bet == 0 ){
			return 'yes';
		}
		
		if( $oMatch->home_score < $oMatch->away_score  && $this->bet == 1 ){
			return 'yes';
		}
		
		return 'no';
	}
	
	public static function getStat(){
		
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
		
		return $aSt;
	}
	
}

?>