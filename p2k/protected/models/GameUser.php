<?php

/**
 * This is the model class for table "matches".
 *
 * The followings are the available columns in table 'game_users':
 * @property integer $game_id
 * @property integer $user_id
 */
class GameUser extends CActiveRecord
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
		return 'game_users';
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
			'game_id'		=> 'game id',
			'user_id'	=> 'user_id',
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

		$criteria->compare('game_id',$this->game_id,true);
		$criteria->compare('user_id',$this->user_id,true);
		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}

	public static function getUserGames($iUserId){
		$aGames = GameUser::model()->findAllByAttributes(
			array(
				'user_id' => $iUserId
			),
			array(
				'index' => 'game_id'
			)
		);
		$aGameIds = array_keys($aGames);
		return $aGameIds;
	}
	
}

?>
