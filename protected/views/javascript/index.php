<?php
/* @var $this JavascriptController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Javascripts',
);

$this->menu=array(
	array('label'=>'Create Javascript', 'url'=>array('create')),
	array('label'=>'Manage Javascript', 'url'=>array('admin')),
);
?>

<h1>Javascripts</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
