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
 * @property integer $parent_id
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
            array('layout_id, status, title, published_on', 'required'),
            array('parent_id, slug', 'required', 'on' => self::SCENARIO_CREATE),
            array('layout_id', 'required', 'on' => self::SCENARIO_UPDATE_ROOT),
			array('parent_id, status, position, created_by_id, updated_by_id', 'numerical', 'integerOnly'=>true),
			array('title, keywords', 'length', 'max'=>255),
			array('slug', 'length', 'max'=>100),
			array('breadcrumb', 'length', 'max'=>160),
			array('behavior', 'length', 'max'=>25),
			array('description, created_on, updated_on', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, title, slug, breadcrumb, keywords, description, parent_id, layout_id, behavior, status, created_on, updated_on, published_on, position, created_by_id, updated_by_id', 'safe', 'on'=>'search'),
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
			'parent' => array(self::BELONGS_TO, 'Page', 'parent_id'),
			'pages' => array(self::HAS_MANY, 'Page', 'parent_id'),
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
			'id' => 'ID',
			'title' => 'Title',
			'slug' => 'Slug',
			'breadcrumb' => 'Breadcrumb',
			'keywords' => 'Keywords',
			'description' => 'Description',
			'parent_id' => 'Parent',
			'layout_id' => 'Layout',
			'behavior' => 'Behavior',
			'status' => 'Status',
			'created_on' => 'Created On',
			'updated_on' => 'Updated On',
			'published_on' => 'Published On',
			'position' => 'Position',
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
		$criteria->compare('title',$this->title,true);
		$criteria->compare('slug',$this->slug,true);
		$criteria->compare('breadcrumb',$this->breadcrumb,true);
		$criteria->compare('keywords',$this->keywords,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('parent_id',$this->parent_id);
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
     * Возвращает признак: является ли текущая страница корневой.
     *
     * @return bool Признак: является ли текущая страница корневой
     */
    public function isRoot()
    {
        return $this->parent_id == null;
    }
}