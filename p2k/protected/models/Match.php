<?php

/**
 * This is the model class for table "matches".
 *
 * The followings are the available columns in table 'users':
 * @property inetger $id
 * @property date $date
 * @property integer $competition_id
 * @property integer $home_id
 * @property integer $away_id
 * @property integer $home_score
 * @property itneger $away_score
 * @property boolean $get_reslt
 */
class Match extends CActiveRecord
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
		return 'matches';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name', 'safe'),
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
			'date'	=> 'date',
			'competition_id' => 'competition_id',
			'home_id'	=> 'home_id',
			'away_id'	=> 'away_id',
			'home_score'	=> 'home_score',
			'away_score'	=> 'away_score',
			'get_result'	=> 'get_result'
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
		$criteria->compare('date',$this->date,true);
		$criteria->compare('competition_id',$this->competition_id,true);
		$criteria->compare('home_id',$this->home_id,true);
		$criteria->compare('away_id',$this->away_id,true);
		$criteria->compare('home_score',$this->home_score,true);
		$criteria->compare('away_score',$this->away_score,true);
		$criteria->compare('get_result',$this->get_result,true);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
	

	
}

?>