<?php
/* @var $this JavascriptController */
/* @var $model Javascript */

$this->breadcrumbs=array(
	'Javascripts'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Javascript', 'url'=>array('index')),
	array('label'=>'Create Javascript', 'url'=>array('create')),
	array('label'=>'View Javascript', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Javascript', 'url'=>array('admin')),
);
?>

<h1>Update Javascript <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>