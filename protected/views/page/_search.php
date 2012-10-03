<?php
/* @var $this PageController */
/* @var $model Page */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'slug'); ?>
		<?php echo $form->textField($model,'slug',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'breadcrumb'); ?>
		<?php echo $form->textField($model,'breadcrumb',array('size'=>60,'maxlength'=>160)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'keywords'); ?>
		<?php echo $form->textField($model,'keywords',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'description'); ?>
		<?php echo $form->textArea($model,'description',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<?php /* <div class="row">
		<?php echo $form->label($model,'parent_id'); ?>
		<?php echo $form->textField($model,'parent_id'); ?>
	</div> */ ?>

	<div class="row">
		<?php echo $form->label($model,'layout_id'); ?>
		<?php echo $form->textField($model,'layout_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'behavior'); ?>
		<?php echo $form->textField($model,'behavior',array('size'=>25,'maxlength'=>25)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'status'); ?>
		<?php echo $form->textField($model,'status'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'created_on'); ?>
		<?php echo $form->textField($model,'created_on'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'updated_on'); ?>
		<?php echo $form->textField($model,'updated_on'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'published_on'); ?>
		<?php echo $form->textField($model,'published_on'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'position'); ?>
		<?php echo $form->textField($model,'position'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'created_by_id'); ?>
		<?php echo $form->textField($model,'created_by_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'updated_by_id'); ?>
		<?php echo $form->textField($model,'updated_by_id'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->