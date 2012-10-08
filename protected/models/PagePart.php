<?php

/**
 * This is the model class for table "page_part".
 *
 * The followings are the available columns in table 'page_part':
 * @property integer $id
 * @property string $name
 * @property string $filter
 * @property string $content
 * @property string $content_html
 * @property integer $page_id
 * @property string $is_protected
 *
 * The followings are the available model relations:
 * @property Page $page
 */
class PagePart extends CActiveRecord
{
    const DEFAULT_NAME = 'body';

    const PROTECTED_NO = '0';
    const PROTECTED_YES = '1';

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return PagePart the static model class
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
		return 'page_part';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('page_id', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>100),
            array('name, content', 'required'),
			array('filter', 'length', 'max'=>25),
			array('is_protected', 'in', 'range'=>array(self::PROTECTED_YES, self::PROTECTED_NO)),
			array('content, content_html', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, filter, content, content_html, page_id, is_protected', 'safe', 'on'=>'search'),
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
			'page' => array(self::BELONGS_TO, 'Page', 'page_id'),
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
			'filter' => 'Filter',
			'content' => 'Content',
			'content_html' => 'Content Html',
			'page_id' => 'Page',
			'is_protected' => 'Is Protected',
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
		$criteria->compare('filter',$this->filter,true);
		$criteria->compare('content',$this->content,true);
		$criteria->compare('content_html',$this->content_html,true);
		$criteria->compare('page_id',$this->page_id);
		$criteria->compare('is_protected',$this->is_protected,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

    /**
     * Сгенерировать новую модель с начальными параметрами.
     *
     * @return PagePart Новая модель класса PagePart
     */
    static public function newModel()
    {
        $model = new PagePart();
        $model->name = self::DEFAULT_NAME;
        return $model;
    }

} // end class