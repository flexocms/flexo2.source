<?php
/* @var $this SnippetController */
/* @var $model Snippet */

$this->breadcrumbs=array(
	'Snippets'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Snippet', 'url'=>array('index')),
	array('label'=>'Manage Snippet', 'url'=>array('admin')),
);
?>

<h1>Create Snippet</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>