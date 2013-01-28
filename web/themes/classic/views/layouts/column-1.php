<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/mylayout', array('page' => $page)); ?>
<div id="content">
	<?php echo $page->getContent(); ?>
</div><!-- content -->
<?php $this->endContent(); ?>
