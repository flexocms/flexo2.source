<?php
/* @var $this StylesheetController */
/* @var $model Stylesheet */

$this->breadcrumbs=array(
	'Stylesheets'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Stylesheet', 'url'=>array('index')),
	array('label'=>'Create Stylesheet', 'url'=>array('create')),
	array('label'=>'View Stylesheet', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Stylesheet', 'url'=>array('admin')),
);
?>

<h1>Update Stylesheet <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>