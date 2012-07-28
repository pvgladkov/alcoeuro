<?php

/**
 * This is the model class for table "competitions".
 *
 * The followings are the available columns in table 'users':
 * @property ineger $id
 * @property date $create_time
 * @property date $end_time
 * @property string $nickname
 * @property integer $type_id
 * 
 */
class Competition extends CActiveRecord
{
	
	const CTYPE_CL = 1;
	
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
		return 'competitions';
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
			'start_time'	=> 'create_time',
			'end_time'	=> 'end_time',
			'nickname' => 'nickname',
			'type_id'	=> 'type_id',
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
		$criteria->compare('end_time',$this->end_time,true);
		$criteria->compare('nickname',$this->nickname,true);
		$criteria->compare('type_id',$this->type_id,true);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
	
}

?>