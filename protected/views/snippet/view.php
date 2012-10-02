<?php
/* @var $this SnippetController */
/* @var $model Snippet */

$this->breadcrumbs=array(
	'Snippets'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Snippet', 'url'=>array('index')),
	array('label'=>'Create Snippet', 'url'=>array('create')),
	array('label'=>'Update Snippet', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Snippet', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Snippet', 'url'=>array('admin')),
);
?>

<h1>View Snippet #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'slug',
		'filter',
		'content',
		'content_html',
		'created_on',
		'updated_on',
		'created_on_id',
		'updated_on_id',
	),
)); ?>
