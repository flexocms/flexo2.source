<?php
/* @var $this SnippetController */
/* @var $data Snippet */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('slug')); ?>:</b>
	<?php echo CHtml::encode($data->slug); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('filter')); ?>:</b>
	<?php echo CHtml::encode($data->filter); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('content')); ?>:</b>
	<?php echo CHtml::encode($data->content); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('content_html')); ?>:</b>
	<?php echo CHtml::encode($data->content_html); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('created_on')); ?>:</b>
	<?php echo CHtml::encode($data->created_on); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('updated_on')); ?>:</b>
	<?php echo CHtml::encode($data->updated_on); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('created_on_id')); ?>:</b>
	<?php echo CHtml::encode($data->created_on_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('updated_on_id')); ?>:</b>
	<?php echo CHtml::encode($data->updated_on_id); ?>
	<br />

	*/ ?>

</div>