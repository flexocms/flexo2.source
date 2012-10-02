<?php

/**
 * This is the model class for table "snippet".
 *
 * The followings are the available columns in table 'snippet':
 * @property integer $id
 * @property string $slug
 * @property string $filter
 * @property string $content
 * @property string $content_html
 * @property string $created_on
 * @property string $updated_on
 * @property integer $created_on_id
 * @property integer $updated_on_id
 *
 * The followings are the available model relations:
 * @property User $createdOn
 * @property User $updatedOn
 */
class Snippet extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Snippet the static model class
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
		return 'snippet';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('created_on_id, updated_on_id', 'numerical', 'integerOnly'=>true),
			array('slug', 'length', 'max'=>100),
			array('filter', 'length', 'max'=>25),
			array('content, content_html, created_on, updated_on', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, slug, filter, content, content_html, created_on, updated_on, created_on_id, updated_on_id', 'safe', 'on'=>'search'),
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
			'createdOn' => array(self::BELONGS_TO, 'User', 'created_on_id'),
			'updatedOn' => array(self::BELONGS_TO, 'User', 'updated_on_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'slug' => 'Slug',
			'filter' => 'Filter',
			'content' => 'Content',
			'content_html' => 'Content Html',
			'created_on' => 'Created On',
			'updated_on' => 'Updated On',
			'created_on_id' => 'Created On',
			'updated_on_id' => 'Updated On',
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
		$criteria->compare('slug',$this->slug,true);
		$criteria->compare('filter',$this->filter,true);
		$criteria->compare('content',$this->content,true);
		$criteria->compare('content_html',$this->content_html,true);
		$criteria->compare('created_on',$this->created_on,true);
		$criteria->compare('updated_on',$this->updated_on,true);
		$criteria->compare('created_on_id',$this->created_on_id);
		$criteria->compare('updated_on_id',$this->updated_on_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}