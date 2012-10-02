<?php
/* @var $this StylesheetController */
/* @var $model Stylesheet */

$this->breadcrumbs=array(
	'Stylesheets'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Stylesheet', 'url'=>array('index')),
	array('label'=>'Manage Stylesheet', 'url'=>array('admin')),
);
?>

<h1>Create Stylesheet</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>