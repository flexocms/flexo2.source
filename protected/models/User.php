<?php

/**
 * This is the model class for table "user".
 *
 * The followings are the available columns in table 'user':
 * @property integer $id
 * @property string $name
 * @property string $email
 * @property string $login
 * @property string $password
 * @property string $salt
 * @property string $language
 * @property string $created_on
 * @property integer $created_by_id
 * @property integer $updated_by_id
 *
 * The followings are the available model relations:
 * @property Javascript[] $javascripts
 * @property Javascript[] $javascripts1
 * @property Layout[] $layouts
 * @property Layout[] $layouts1
 * @property Page[] $pages
 * @property Page[] $pages1
 * @property Snippet[] $snippets
 * @property Snippet[] $snippets1
 * @property Stylesheet[] $stylesheets
 * @property Stylesheet[] $stylesheets1
 * @property Theme[] $themes
 * @property Theme[] $themes1
 * @property UserPermission[] $userPermissions
 */
class User extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return User the static model class
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
		return 'user';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('created_by_id, updated_by_id', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>100),
			array('email', 'length', 'max'=>255),
			array('login, password', 'length', 'max'=>40),
			array('salt', 'length', 'max'=>45),
			array('language', 'length', 'max'=>5),
			array('created_on', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, email, login, password, salt, language, created_on, created_by_id, updated_by_id', 'safe', 'on'=>'search'),
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
			'javascripts' => array(self::HAS_MANY, 'Javascript', 'created_by_id'),
			'javascripts1' => array(self::HAS_MANY, 'Javascript', 'updated_by_id'),
			'layouts' => array(self::HAS_MANY, 'Layout', 'created_by_id'),
			'layouts1' => array(self::HAS_MANY, 'Layout', 'updated_by_id'),
			'pages' => array(self::HAS_MANY, 'Page', 'created_by_id'),
			'pages1' => array(self::HAS_MANY, 'Page', 'updated_by_id'),
			'snippets' => array(self::HAS_MANY, 'Snippet', 'created_on_id'),
			'snippets1' => array(self::HAS_MANY, 'Snippet', 'updated_on_id'),
			'stylesheets' => array(self::HAS_MANY, 'Stylesheet', 'created_by_id'),
			'stylesheets1' => array(self::HAS_MANY, 'Stylesheet', 'updated_by_id'),
			'themes' => array(self::HAS_MANY, 'Theme', 'created_by_id'),
			'themes1' => array(self::HAS_MANY, 'Theme', 'updated_by_id'),
			'userPermissions' => array(self::HAS_MANY, 'UserPermission', 'user_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Name',
			'email' => 'Email',
			'login' => 'Login',
			'password' => 'Password',
			'salt' => 'Salt',
			'language' => 'Language',
			'created_on' => 'Created On',
			'created_by_id' => 'Created By',
			'updated_by_id' => 'Updated By',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('login',$this->login,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('salt',$this->salt,true);
		$criteria->compare('language',$this->language,true);
		$criteria->compare('created_on',$this->created_on,true);
		$criteria->compare('created_by_id',$this->created_by_id);
		$criteria->compare('updated_by_id',$this->updated_by_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}