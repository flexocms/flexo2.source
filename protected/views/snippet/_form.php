<?php
/* @var $this SnippetController */
/* @var $model Snippet */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'snippet-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'slug'); ?>
		<?php echo $form->textField($model,'slug',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'slug'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'filter'); ?>
		<?php echo $form->textField($model,'filter',array('size'=>25,'maxlength'=>25)); ?>
		<?php echo $form->error($model,'filter'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'content'); ?>
		<?php echo $form->textArea($model,'content',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'content'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'content_html'); ?>
		<?php echo $form->textArea($model,'content_html',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'content_html'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'created_on'); ?>
		<?php echo $form->textField($model,'created_on'); ?>
		<?php echo $form->error($model,'created_on'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'updated_on'); ?>
		<?php echo $form->textField($model,'updated_on'); ?>
		<?php echo $form->error($model,'updated_on'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'created_on_id'); ?>
		<?php echo $form->textField($model,'created_on_id'); ?>
		<?php echo $form->error($model,'created_on_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'updated_on_id'); ?>
		<?php echo $form->textField($model,'updated_on_id'); ?>
		<?php echo $form->error($model,'updated_on_id'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->