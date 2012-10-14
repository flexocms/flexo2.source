<?php
/* @var $this PageController */
/* @var $model Page */

$this->breadcrumbs=array(
	'Pages'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Page', 'url'=>array('index')),
	array('label'=>'Create Page', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('page-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1><?php echo Yii::t('app', 'Pages'); ?></h1>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('ext.widgets.tree.CQTreeGridView', array(
	'id'=>'page-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
    'ajaxUpdate'=>false,
    'enablePagination'=>false,
    'type'=>'striped bordered condensed',
	'columns'=>array(
		array(
            'name' => 'title',
            'type' => 'raw',
            'value' => 'CHtml::link($data->title, Yii::app()->createUrl("page/update", array("id"=>$data->id)));',
            'sortable' => false,
        ),
        array(
            'name' => 'published_on',
            'sortable' => false,
        ),
        array(
            'header' => CHtml::encode(Page::model()->getAttributeLabel("status")),
            'value' => '$data->getStatusText();',
        ),
		array(
			'class'=>'CButtonColumn',
            'template'=>'{create}{update}{delete}',
            'buttons'=>array(
                'create' => array(
                    'url'=>'Yii::app()->createUrl("page/create", array("id" => $data->id));',
                ),
            ),
		),
	),
)); ?>
