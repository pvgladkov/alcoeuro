<?php

/**
 * This is the model class for table "users".
 *
 * The followings are the available columns in table 'users':
 * @property ineger $id
 * @property date $create_time
 * @property string $nickname
 * @property string $email
 * @property string $name
 * @property string $password
 */
class User extends CActiveRecord
{
	
	/**
	 * Соль для пароля
	 * @var string
	 */
	private static $_salt = 'XFy.^%\!fsbdhf4%*@dd';
	
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
		return 'users';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array( 'email, nickname, password', 'safe' ),
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

	public function beforeSave() {
		
		$this->password = $this->encrypt( $this->password );
		return true;
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id'	=> 'id',
			'create_time'	=> 'create_time',
			'nickname'		=> 'nickname',
			'email'		=> 'email',
			'name'		=> 'name',
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
		$criteria->compare('create_time',$this->create_time,true);
		$criteria->compare('nickname',$this->nickname,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('name',$this->name,true);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
	
	/**
	* запись нового пароля
	* 
	* @param mixed $sNotCryptPassword
	*/
	public function savePassword( $sNotCryptPassword ){
		
		$sPassword = $this->encrypt( $sNotCryptPassword );
		$sql = "UPDATE `users` SET `password` = '" . $sPassword . "' WHERE `id` = " . $this->id;
		Yii::app()->db->createCommand($sql)->execute();
		
	}
	
	/**
	 * Хэширование пароля с солью
	 * @param string $value
	 * @return string
	 */
	public function encrypt( $sValue ){
		return md5( self::$_salt . $sValue . md5( self::$_salt ) );
	}
	
	
	/**
	 * Именованная группа условия (scopes) c параметром для email
	 * @param string $sEmail
	 * @return User
	 */
	public function scopeEmail( $sEmail ){
			
		$this->getDbCriteria()->mergeWith(array(
			'condition' => "`email` = '$sEmail'",
		));
			
		
		return $this;
	}
	
	public function scopeNickname( $sNick ){
			
		$this->getDbCriteria()->mergeWith(array(
			'condition' => "`nickname` = '$sNick'",
		));
		
		return $this;
	}
	
	/**
	 * 
	 * @return User
	 */
	public function scopeNotDeleted() {

		return $this;
	}	
	
	/**
	 * 
	 */
	public function getName(){
		if( $this->nickname ){
			return $this->nickname;
		}
		return $this->email;
	}
}

?>