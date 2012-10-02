<?php

/**
 * This is the model class for table "layout_javascript".
 *
 * The followings are the available columns in table 'layout_javascript':
 * @property integer $layout_id
 * @property integer $javascript_id
 *
 * The followings are the available model relations:
 * @property Layout $layout
 * @property Javascript $javascript
 */
class LayoutJavascript extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return LayoutJavascript the static model class
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
		return 'layout_javascript';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('layout_id, javascript_id', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('layout_id, javascript_id', 'safe', 'on'=>'search'),
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
			'layout' => array(self::BELONGS_TO, 'Layout', 'layout_id'),
			'javascript' => array(self::BELONGS_TO, 'Javascript', 'javascript_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'layout_id' => 'Layout',
			'javascript_id' => 'Javascript',
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

		$criteria->compare('layout_id',$this->layout_id);
		$criteria->compare('javascript_id',$this->javascript_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}