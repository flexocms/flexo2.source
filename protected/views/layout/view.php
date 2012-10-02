<?php
/* @var $this LayoutController */
/* @var $model Layout */

$this->breadcrumbs=array(
	'Layouts'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Layout', 'url'=>array('index')),
	array('label'=>'Create Layout', 'url'=>array('create')),
	array('label'=>'Update Layout', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Layout', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Layout', 'url'=>array('admin')),
);
?>

<h1>View Layout #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'content_type',
		'filter',
		'content',
		'content_html',
		'created_on',
		'updated_on',
		'theme_id',
		'created_by_id',
		'updated_by_id',
	),
)); ?>
