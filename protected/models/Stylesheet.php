<?php

/**
 * This is the model class for table "stylesheet".
 *
 * The followings are the available columns in table 'stylesheet':
 * @property integer $id
 * @property string $name
 * @property string $content
 * @property integer $media_type
 * @property string $created_on
 * @property string $updated_on
 * @property integer $theme_id
 * @property integer $created_by_id
 * @property integer $updated_by_id
 *
 * The followings are the available model relations:
 * @property LayoutStylesheet[] $layoutStylesheets
 * @property User $createdBy
 * @property User $updatedBy
 * @property Theme $theme
 */
class Stylesheet extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Stylesheet the static model class
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
		return 'stylesheet';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('theme_id', 'required'),
			array('media_type, theme_id, created_by_id, updated_by_id', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>255),
			array('content, created_on, updated_on', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, content, media_type, created_on, updated_on, theme_id, created_by_id, updated_by_id', 'safe', 'on'=>'search'),
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
			'layoutStylesheets' => array(self::HAS_MANY, 'LayoutStylesheet', 'stylesheet_id'),
			'createdBy' => array(self::BELONGS_TO, 'User', 'created_by_id'),
			'updatedBy' => array(self::BELONGS_TO, 'User', 'updated_by_id'),
			'theme' => array(self::BELONGS_TO, 'Theme', 'theme_id'),
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
			'content' => 'Content',
			'media_type' => 'Media Type',
			'created_on' => 'Created On',
			'updated_on' => 'Updated On',
			'theme_id' => 'Theme',
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
		$criteria->compare('content',$this->content,true);
		$criteria->compare('media_type',$this->media_type);
		$criteria->compare('created_on',$this->created_on,true);
		$criteria->compare('updated_on',$this->updated_on,true);
		$criteria->compare('theme_id',$this->theme_id);
		$criteria->compare('created_by_id',$this->created_by_id);
		$criteria->compare('updated_by_id',$this->updated_by_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}