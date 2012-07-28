<?php

/**
 * This is the model class for table "matches".
 *
 * The followings are the available columns in table 'user_matches':
 * @property integer $id
 * @property integer $match_id
 * @property date $create_time
 * @property integer $user_id
 * @property ineger $bet
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
			'id'		=> 'id',
			'match_id'		=> 'match id',
			'create_time'		=> 'create_time',
			'user_id'	=> 'user_id',
			'bet'		=> 'bet',
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
		$criteria->compare('match_id',$this->match_id,true);
		$criteria->compare('create_time',$this->create_time,true);
		$criteria->compare('user_id',$this->user_id,true);
		$criteria->compare('bet',$this->bet,true);
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
		if( strtotime( $oMatch->date ) < date(mktime()) && !$this->is_done ){
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
	
	/**
	 * Получить пользовательские ставки
	 * @param integer $iUserId
	 * @return array
	 */
	public static function getUserMatches( $iUserId ){
		
		$aMatches = UserMatch::model()->findAllByAttributes(
			array( 'user_id' => $iUserId ),
			array( 'index'	=> 'match_id' )
		);
		
		return $aMatches;
	}
	
	
	
}

?>