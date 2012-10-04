<fieldset class="item">
    <legend><?php echo $form->textField($model,'[' . $index . ']name'); ?></legend>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php if ($model->id): ?>
        <?php echo $form->hiddenField($model,'[' . $index . ']id'); ?>
        <?php endif; ?>
        <?php echo $form->labelEx($model,'[' . $index . ']content'); ?>
        <?php echo $form->textArea($model,'[' . $index . ']content',array('rows'=>6, 'cols'=>50, 'class'=>'pagePartContent', 'data-index'=>$index)); ?>
        <?php echo $form->error($model,'[' . $index . ']content'); ?>
    </div>
    <?php if ($index > 0): ?>
    <div class="row">
        <?php echo CHtml::link(Yii::t('app', 'Remove Page part'), '#', array('onclick' => '$(this).parents(".item").remove();')); ?>
    </div>
    <?php endif; ?>
</fieldset>