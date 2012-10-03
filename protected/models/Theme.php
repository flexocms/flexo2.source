<?php

/**
 * This is the model class for table "theme".
 *
 * The followings are the available columns in table 'theme':
 * @property integer $id
 * @property string $name
 * @property string $is_active
 * @property string $created_on
 * @property string $updated_on
 * @property integer $created_by_id
 * @property integer $updated_by_id
 *
 * The followings are the available model relations:
 * @property Javascript[] $javascripts
 * @property Layout[] $layouts
 * @property Stylesheet[] $stylesheets
 * @property User $createdBy
 * @property User $updatedBy
 */
class Theme extends CActiveRecord
{
    const ACTIVE_NO = '0';
    const ACTIVE_YES = '1';

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Theme the static model class
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
		return 'theme';
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
			array('is_active', 'length', 'max'=>1),
			array('created_on, updated_on', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, is_active, created_on, updated_on, created_by_id, updated_by_id', 'safe', 'on'=>'search'),
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
			'javascripts' => array(self::HAS_MANY, 'Javascript', 'theme_id'),
			'layouts' => array(self::HAS_MANY, 'Layout', 'theme_id'),
			'stylesheets' => array(self::HAS_MANY, 'Stylesheet', 'theme_id'),
			'createdBy' => array(self::BELONGS_TO, 'User', 'created_by_id'),
			'updatedBy' => array(self::BELONGS_TO, 'User', 'updated_by_id'),
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
			'is_active' => 'Is Active',
			'created_on' => 'Created On',
			'updated_on' => 'Updated On',
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
		$criteria->compare('is_active',$this->is_active,true);
		$criteria->compare('created_on',$this->created_on,true);
		$criteria->compare('updated_on',$this->updated_on,true);
		$criteria->compare('created_by_id',$this->created_by_id);
		$criteria->compare('updated_by_id',$this->updated_by_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}


    /**
     * Возвращает активную тему либо null, если активная тема не обнаружена.
     *
     * @return Theme|null Объект активной темы
     */
    static public function getActive()
    {
        $criteria = new CDbCriteria();
        $criteria->addCondition('is_active', self::ACTIVE_YES);

        return self::model()->find($criteria);
    }
}