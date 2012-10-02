<?php

/**
 * This is the model class for table "layout".
 *
 * The followings are the available columns in table 'layout':
 * @property integer $id
 * @property string $name
 * @property string $content_type
 * @property string $filter
 * @property string $content
 * @property string $content_html
 * @property string $created_on
 * @property string $updated_on
 * @property integer $theme_id
 * @property integer $created_by_id
 * @property integer $updated_by_id
 *
 * The followings are the available model relations:
 * @property Theme $theme
 * @property User $createdBy
 * @property User $updatedBy
 * @property LayoutJavascript[] $layoutJavascripts
 * @property LayoutStylesheet[] $layoutStylesheets
 * @property Page[] $pages
 */
class Layout extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Layout the static model class
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
		return 'layout';
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
			array('theme_id, created_by_id, updated_by_id', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>100),
			array('content_type', 'length', 'max'=>40),
			array('filter', 'length', 'max'=>25),
			array('content, content_html, created_on, updated_on', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, content_type, filter, content, content_html, created_on, updated_on, theme_id, created_by_id, updated_by_id', 'safe', 'on'=>'search'),
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
			'theme' => array(self::BELONGS_TO, 'Theme', 'theme_id'),
			'createdBy' => array(self::BELONGS_TO, 'User', 'created_by_id'),
			'updatedBy' => array(self::BELONGS_TO, 'User', 'updated_by_id'),
			'layoutJavascripts' => array(self::HAS_MANY, 'LayoutJavascript', 'layout_id'),
			'layoutStylesheets' => array(self::HAS_MANY, 'LayoutStylesheet', 'layout_id'),
			'pages' => array(self::HAS_MANY, 'Page', 'layout_id'),
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
			'content_type' => 'Content Type',
			'filter' => 'Filter',
			'content' => 'Content',
			'content_html' => 'Content Html',
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
		$criteria->compare('content_type',$this->content_type,true);
		$criteria->compare('filter',$this->filter,true);
		$criteria->compare('content',$this->content,true);
		$criteria->compare('content_html',$this->content_html,true);
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