<?php

/**
 * This is the model class for table "games".
 *
 * The followings are the available columns in table 'users':
 * @property ineger $id
 * @property date $create_time
 * @property date $start_time
 * @property date $end_time
 * @property string $nickname
 * @property array $options
 * @property integer $owner_id
 * 
 */
class Game extends CActiveRecord
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
		return 'games';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nickname, owner_id', 'safe'),
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
			'id'	=> 'id',
			'create_time'	=> 'create_time',
			'start_time'	=> 'start_time',
			'end_time'	=> 'end_time',
			'nickname' => 'nickname',
			'options'	=> 'options',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search(){
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('create_time',$this->create_time,true);
		$criteria->compare('start_time',$this->start_time,true);
		$criteria->compare('end_time',$this->end_time,true);
		$criteria->compare('nickname',$this->nickname,true);
		$criteria->compare('options',$this->options,true);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
	
	/**
	 * 
	 * @param type $aUsers
	 */
	public function linkUsers( $aUsers ){
		foreach($aUsers as $iUserId ){
			$oGameUser = new GameUser();
			$oGameUser->game_id = $this->id;
			$oGameUser->user_id = $iUserId;
			$oGameUser->save();
		}
	}
}

?>