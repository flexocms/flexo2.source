<?php
/* @var $this PageController */
/* @var $model Page */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'page-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'title'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'slug'); ?>
		<?php echo $form->textField($model,'slug',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'slug'); ?>
	</div>

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

    <?php if ($model->getIsNewRecord() || ! $model->isRoot()): ?>
	<div class="row">
		<?php echo $form->labelEx($model,'parent_id'); ?>
		<?php echo $form->dropDownList($model,'parent_id',
            CHtml::listData(Page::model()->findAll(), 'id', 'title')
        ); ?>
		<?php echo $form->error($model,'parent_id'); ?>
	</div>
    <?php endif; ?>

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
		<?php echo $form->dropDownList($model,'status',array(
            Page::STATUS_DRAFT => Yii::t('app','Draft'),
            Page::STATUS_HIDDEN => Yii::t('app','Hidden'),
            Page::STATUS_PUBLISHED => Yii::t('app','Published'),
            Page::STATUS_REVIEWED => Yii::t('app','Reviewed'),
        )); ?>
		<?php echo $form->error($model,'status'); ?>
	</div>

    <div class="row">
        <?php echo $form->labelEx($model,'published_on'); ?>
        <?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
            'model' => $model,
            'attribute' => 'published_on',
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
        <?php echo Yii::t('app','Created by:'); ?> <?php echo $model->createdBy->name; ?>
	</div>

	<div class="row">
        <?php echo Yii::t('app','Updated by:'); ?> <?php echo $model->updatedBy->name; ?>
	</div>
    <?php endif; ?>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->getIsNewRecord() ? Yii::t('app','Create') : Yii::t('app','Save')); ?>
        <?php echo CHtml::link(Yii::t('app', 'Cancel'), $this->createUrl('index')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->