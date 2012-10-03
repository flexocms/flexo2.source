<?php

/**
 * This is the model class for table "page".
 *
 * The followings are the available columns in table 'page':
 * @property integer $id
 * @property string $title
 * @property string $slug
 * @property string $breadcrumb
 * @property string $keywords
 * @property string $description
 * @property integer $left_key
 * @property integer $right_key
 * @property integer $level
 * @property integer $layout_id
 * @property string $behavior
 * @property integer $status
 * @property string $created_on
 * @property string $updated_on
 * @property string $published_on
 * @property integer $position
 * @property integer $created_by_id
 * @property integer $updated_by_id
 *
 * The followings are the available model relations:
 * @property User $createdBy
 * @property User $updatedBy
 * @property Layout $layout
 * @property Page $parent
 * @property Page[] $pages
 * @property PagePart[] $pageParts
 * @property PageTag[] $pageTags
 * @property NestedSetBehavior $nestedSetBehavior
 */
class Page extends CActiveRecord
{
    const SCENARIO_CREATE = 'create';
    const SCENARIO_UPDATE = 'update';
    const SCENARIO_UPDATE_ROOT = 'updateRoot';

    const STATUS_DRAFT = 1;
    const STATUS_REVIEWED = 50;
    const STATUS_PUBLISHED = 100;
    const STATUS_HIDDEN = 101;

    const LOGIN_NOT_REQUIRED = 0;
    const LOGIN_REQUIRED = 1;
    const LOGIN_INHERIT = 2;

    const MSG_MODEL_SAVED = 'Page {title} saved successfully!';

    /**
     * @var ID родительской записи
     */
    public $parentId;

    // behaviors
    public function behaviors()
    {
        return array(
            'tree'=>array(
                'class'=>'ext.NestedSetBehavior.NestedSetBehavior',
                'leftAttribute'=>'left_key',
                'rightAttribute'=>'right_key',
                'levelAttribute'=>'level',
            ),
        );
    }

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Page the static model class
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
		return 'page';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
            array('status, title, published_on', 'required'),
            array('slug', 'required', 'on' => self::SCENARIO_CREATE),
            array('layout_id', 'required', 'on' => self::SCENARIO_UPDATE_ROOT),
            array('slug', 'default', 'value' => '', 'setOnEmpty' => false, 'on' => self::SCENARIO_UPDATE_ROOT),
			array('status, position, created_by_id, updated_by_id', 'numerical', 'integerOnly'=>true),
			array('title, keywords', 'length', 'max'=>255),
			array('slug', 'length', 'max'=>100),
			array('breadcrumb', 'length', 'max'=>160),
			array('behavior', 'length', 'max'=>25),
			array('description, created_on, updated_on', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, title, slug, breadcrumb, keywords, description, layout_id, behavior, status, created_on, updated_on, published_on, position, created_by_id, updated_by_id', 'safe', 'on'=>'search'),
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
			'createdBy' => array(self::BELONGS_TO, 'User', 'created_by_id'),
			'updatedBy' => array(self::BELONGS_TO, 'User', 'updated_by_id'),
			'layout' => array(self::BELONGS_TO, 'Layout', 'layout_id'),
			//'parent' => array(self::BELONGS_TO, 'Page', 'parent_id'),
			//'pages' => array(self::HAS_MANY, 'Page', 'parent_id'),
			'pageParts' => array(self::HAS_MANY, 'PagePart', 'page_id'),
			'pageTags' => array(self::HAS_MANY, 'PageTag', 'page_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => Yii::t('app', '#'),
			'title' => Yii::t('app', 'Title'),
			'slug' => Yii::t('app', 'Slug'),
			'breadcrumb' => Yii::t('app', 'Breadcrumb'),
			'keywords' => Yii::t('app', 'Keywords'),
			'description' => Yii::t('app', 'Description'),
			//'parent_id' => Yii::t('app', 'Parent'),
			'layout_id' => Yii::t('app', 'Layout'),
			'behavior' => Yii::t('app', 'Behavior'),
			'status' => Yii::t('app', 'Status'),
			'created_on' => Yii::t('app', 'Created on'),
			'updated_on' => Yii::t('app', 'Updated on'),
			'published_on' => Yii::t('app', 'Published on'),
			'position' => Yii::t('app', 'Position'),
			'created_by_id' => Yii::t('app', 'Created by'),
			'updated_by_id' => Yii::t('app', 'Updated by'),
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

        // nested tree
        $criteria->order = $this->tree->hasManyRoots
                           ? $this->tree->rootAttribute . ', ' . $this->tree->leftAttribute
                           : $this->tree->leftAttribute;

		$criteria->compare('id',$this->id);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('slug',$this->slug,true);
		$criteria->compare('breadcrumb',$this->breadcrumb,true);
		$criteria->compare('keywords',$this->keywords,true);
		$criteria->compare('description',$this->description,true);
		//$criteria->compare('parent_id',$this->parent_id);
		$criteria->compare('layout_id',$this->layout_id);
		$criteria->compare('behavior',$this->behavior,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('created_on',$this->created_on,true);
		$criteria->compare('updated_on',$this->updated_on,true);
		$criteria->compare('published_on',$this->published_on,true);
		$criteria->compare('position',$this->position);
		$criteria->compare('created_by_id',$this->created_by_id);
		$criteria->compare('updated_by_id',$this->updated_by_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

    /**
     * Функция выполняется при первом сохранении информации из модели в БД.
     */
    public function onBeforeInsert()
    {
        $this->created_by_id = Yii::app()->user->id;
        $this->updated_by_id = Yii::app()->user->id;
        return true;
    }

    /**
     * Возвращает признак: является ли текущая страница корневой.
     *
     * @return bool Признак: является ли текущая страница корневой
     */
    public function isRoot()
    {
        return false;
        //return ! $this->getIsNewRecord() && $this->parent_id == null;
    }

    /**
     * Возвращает имя пользователя, создавшего текущию модель.
     * Если нет связанного пользователя - возвращает null.
     *
     * @return string|null Возвращает имя пользователя, создавшего текущию модель
     */
    public function getCreatedByName()
    {
        if ($this->createdBy) {
            return $this->createdBy->name;
        }
        return null;
    }

    /**
     * Возвращает имя пользователя, внесшего последнее изменение в текущию модель.
     * Если нет связанного пользователя - возвращает null.
     *
     * @return string|null Имя пользователя, внесшего последнее изменение в текущую модель
     */
    public function getUpdatedByName()
    {
        if ($this->updatedBy) {
            return $this->updatedBy->name;
        }
        return null;
    }

    /**
     * Возвращает список key => value, где в качестве ключа выступает
     * порядковый номер статуса, в качестве значения текстовое обозначение статуса.
     *
     * @return array Массив key => value. Ключь - номер статуса, значение - название статуса
     */
    static public function getStatusItems()
    {
        return array(
            Page::STATUS_DRAFT => Yii::t('app','Draft'),
            Page::STATUS_HIDDEN => Yii::t('app','Hidden'),
            Page::STATUS_PUBLISHED => Yii::t('app','Published'),
            Page::STATUS_REVIEWED => Yii::t('app','Reviewed'),
        );
    }
}