<?php
/* @var $this JavascriptController */
/* @var $model Javascript */

$this->breadcrumbs=array(
	'Javascripts'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Javascript', 'url'=>array('index')),
	array('label'=>'Create Javascript', 'url'=>array('create')),
	array('label'=>'Update Javascript', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Javascript', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Javascript', 'url'=>array('admin')),
);
?>

<h1>View Javascript #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'content',
		'created_on',
		'updated_on',
		'theme_id',
		'created_by_id',
		'updated_by_id',
	),
)); ?>
