<?php
/* @var $this SnippetController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Snippets',
);

$this->menu=array(
	array('label'=>'Create Snippet', 'url'=>array('create')),
	array('label'=>'Manage Snippet', 'url'=>array('admin')),
);
?>

<h1>Snippets</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
