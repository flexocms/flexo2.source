<?php
/* @var $this PageController */
/* @var $model Page */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'page-form',
	'enableAjaxValidation'=>false,
    'htmlOptions' => array(
        'class' => 'form',
    ),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'title'); ?>
	</div>

    <?php if (! $model->isRoot()): ?>
	<div class="row">
		<?php echo $form->labelEx($model,'slug'); ?>
		<?php echo $form->textField($model,'slug',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'slug'); ?>
	</div>
    <?php endif; ?>

	<div class="row">
		<?php echo $form->labelEx($model,'breadcrumb'); ?>
		<?php echo $form->textField($model,'breadcrumb',array('size'=>60,'maxlength'=>160)); ?>
		<?php echo $form->error($model,'breadcrumb'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'keywords'); ?>
		<?php echo $form->textField($model,'keywords',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'keywords'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php echo $form->textArea($model,'description',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'description'); ?>
	</div>

    <?php /* if ($model->getIsNewRecord() || ! $model->isRoot()): ?>
	<div class="row">
		<?php echo $form->labelEx($model,'parent_id'); ?>
		<?php echo $form->dropDownList($model,'parent_id',
            CHtml::listData(Page::model()->findAll(), 'id', 'title')
        ); ?>
		<?php echo $form->error($model,'parent_id'); ?>
	</div>
    <?php endif; */ ?>

	<div class="row">
		<?php echo $form->labelEx($model,'layout_id'); ?>
		<?php echo $form->dropDownList($model,'layout_id',
            CHtml::listData(Theme::getActive()->layouts, 'id', 'name'),
            array('empty' => ! $model->isRoot() ? array(''=>Yii::t('app','- Inherit -')): null)
        ); ?>
		<?php echo $form->error($model,'layout_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'behavior'); ?>
		<?php echo $form->textField($model,'behavior',array('size'=>25,'maxlength'=>25)); ?>
		<?php echo $form->error($model,'behavior'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'status'); ?>
		<?php echo $form->dropDownList($model,'status',Page::getStatusItems()); ?>
		<?php echo $form->error($model,'status'); ?>
	</div>

    <div class="row">
        <?php echo $form->labelEx($model,'published_on'); ?>
        <?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
            'model' => $model,
            'attribute' => 'published_on',
            'options' => array(
                'dateFormat' => 'yy-mm-dd 00:00:00',
            ),
        )); ?>
        <?php echo $form->error($model,'published_on'); ?>
    </div>

    <?php if (! $model->getIsNewRecord()): ?>
	<div class="row">
		<?php echo Yii::t('app','Created on:'); ?> <?php echo $model->created_on; ?>
	</div>

	<div class="row">
        <?php echo Yii::t('app','Updated on:'); ?> <?php echo $model->updated_on; ?>
	</div>

	<div class="row">
        <?php echo Yii::t('app','Created by:'); ?> <?php echo $model->createdByName; ?>
	</div>

	<div class="row">
        <?php echo Yii::t('app','Updated by:'); ?> <?php echo $model->updatedByName; ?>
	</div>
    <?php endif; ?>

    <div id="PageParts">
    <?php $this->renderPageParts($model, $form); ?>
    </div>

    <div class="row">
        <?php echo CHtml::ajaxLink(Yii::t('app', 'Add Page part'), $this->createUrl('getPagePart'), array(
            'dataType' => 'html',
            'success' => 'js:function(partContent) {
                $("#PageParts").append(partContent);
            }',
            'data' => 'js:{
                index: $(".pagePartContent:last").data("index")
            }',
        )); ?>
    </div>

	<div class="row buttons">
		<?php echo CHtml::submitButton(
            $model->getIsNewRecord() ? Yii::t('app','Create'): Yii::t('app','Save'),
            array('name' => 'commit')
        ); ?>
        <?php echo CHtml::submitButton(
            $model->getIsNewRecord() ? Yii::t('app','Create and Continue'): Yii::t('app','Save and Continue'),
            array('name' => 'continue')
        ); ?>
        <?php echo CHtml::submitButton(
            $model->getIsNewRecord() ? Yii::t('app','Create and Add new'): Yii::t('app','Save and Add new'),
            array('name' => 'new')
        ); ?>
        <?php echo CHtml::link(Yii::t('app', 'Cancel'), $this->createUrl('index')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

<?php
$script = <<<JS
$('.form .sticky input:not(.error), .form .sticky input:not(.error), .form .sticky select:not(.error), .form .sticky textarea:not(.error)').each(function(){
		var value;
		if(this.tagName=='SELECT')
			value=this.options[this.selectedIndex].text;
		else if(this.tagName=='TEXTAREA')
			value=$(this).html();
		else
			value=$(this).val();
		if(value=='')
			value='[empty]';
		$(this).before('<div class="value">'+value+'</div>').hide();
	});

	$(document).on('click', '.form .sticky .value', function(){
		$(this).hide();
		$(this).next().show().get(0).focus();
	});
JS;

Yii::app()->clientScript->registerScript('page.form', $script);
?>