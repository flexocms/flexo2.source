<?php
/* @var $this StylesheetController */
/* @var $model Stylesheet */

$this->breadcrumbs=array(
	'Stylesheets'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Stylesheet', 'url'=>array('index')),
	array('label'=>'Create Stylesheet', 'url'=>array('create')),
	array('label'=>'Update Stylesheet', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Stylesheet', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Stylesheet', 'url'=>array('admin')),
);
?>

<h1>View Stylesheet #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'content',
		'media_type',
		'created_on',
		'updated_on',
		'theme_id',
		'created_by_id',
		'updated_by_id',
	),
)); ?>
