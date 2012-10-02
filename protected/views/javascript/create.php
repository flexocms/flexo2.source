<?php
/* @var $this JavascriptController */
/* @var $model Javascript */

$this->breadcrumbs=array(
	'Javascripts'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Javascript', 'url'=>array('index')),
	array('label'=>'Manage Javascript', 'url'=>array('admin')),
);
?>

<h1>Create Javascript</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>