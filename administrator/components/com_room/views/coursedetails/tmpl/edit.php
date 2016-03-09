<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_room
 *
 * @copyright   Copyright (C) 2012 - 2013 WhiteOf, Corp. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

// Include the HTML helpers.
JHtml::addIncludePath(JPATH_COMPONENT . '/helpers/html');
JHtml::_('behavior.tooltip');
JHtml::_('behavior.formvalidation');
JHtml::_('behavior.keepalive');
JHtml::_('formbehavior.chosen', 'select');

$app = JFactory::getApplication();
$input = $app->input;

$assoc = isset($app->item_associations) ? $app->item_associations : 0;
?>
<script type="text/javascript">
	Joomla.submitbutton = function(task)
	{
		if (task == 'product.cancel' || document.formvalidator.isValid(document.id('product-form')))
		{
			Joomla.submitform(task, document.getElementById('product-form'));
		}
	}
</script>

<form action="<?php echo JRoute::_('index.php?option=com_room&id='.(int) $this->item->id); ?>" method="post" name="adminForm" id="product-form" class="form-validate form-horizontal">
	<div class="row-fluid">
		<!-- Begin Newsfeed -->
		<div class="span10 form-horizontal">

	<fieldset>
	<?php echo JHtml::_('bootstrap.startTabSet', 'myTab', array('active' => 'details')); ?>

		<?php echo JHtml::_('bootstrap.addTab', 'myTab', 'details', empty($this->item->id) ? JText::_('COM_ROOM_NEW_PRODUCT', true) : JText::sprintf('COM_ROOM_EDIT_PRODUCT', $this->item->id, true)); ?>
			<div class="control-group">
				<div class="control-label"><?php echo $this->form->getLabel('title'); ?></div>
				<div class="controls"><?php echo $this->form->getInput('title'); ?></div>
			</div>
			<div class="control-group">
				<div class="control-label"><?php echo $this->form->getLabel('make'); ?></div>
				<div class="controls"><?php echo $this->form->getInput('make'); ?></div>
			</div>
			<div class="control-group">
				<div class="control-label"><?php echo $this->form->getLabel('model'); ?></div>
				<div class="controls"><?php echo $this->form->getInput('model'); ?></div>
			</div>
			<div class="control-group">
				<div class="control-label"><?php echo $this->form->getLabel('year'); ?></div>
				<div class="controls"><?php echo $this->form->getInput('year'); ?></div>
			</div>
			<div class="control-group">
				<div class="control-label"><?php echo $this->form->getLabel('article'); ?></div>
				<div class="controls"><?php echo $this->form->getInput('article'); ?></div>
			</div>
			<div class="control-group">
				<div class="control-label"><?php echo $this->form->getLabel('price'); ?></div>
				<div class="controls"><?php echo $this->form->getInput('price'); ?></div>
			</div>
			<div class="control-group">
				<div class="control-label"><?php echo $this->form->getLabel('description'); ?></div>
				<div class="controls"><?php echo $this->form->getInput('description'); ?></div>
			</div>
			<div class="control-group">
				<div class="control-label"><?php echo $this->form->getLabel('category_id'); ?></div>
				<div class="controls">
					<select id="jform_category_id" required="required" name="jform[category_id]" style="width: 500px;">
						<option></option>
						<?php foreach($this->categories as  $item): ?>
							<option value="<?php echo $item->id ?>" <?php if($this->item->category_id == $item->id) echo 'selected="selected"';?> style="padding-left: <?php echo $item->level*10?>px;">
								<?php echo $item->title ?>
							</option>
						<?php endforeach ?>						
					</select>
				</div>
			</div>
			<div class="control-group">
				<div class="control-label"><?php echo $this->form->getLabel('image'); ?></div>
				<div class="controls"><?php echo $this->form->getInput('image'); ?></div>
			</div>

		<?php echo JHtml::_('bootstrap.endTab'); ?>

		<?php $fieldSets = $this->form->getFieldsets('params'); ?>
		<?php foreach ($fieldSets as $name => $fieldSet) : ?>
			<?php $paramstabs = 'params-' . $name; ?>
			<?php echo JHtml::_('bootstrap.addTab', 'myTab', $paramstabs, JText::_($fieldSet->label, true)); ?>
				<?php echo $this->loadTemplate('params'); ?>
			<?php echo JHtml::_('bootstrap.endTab'); ?>
		<?php endforeach; ?>

		<?php $fieldSets = $this->form->getFieldsets('metadata'); ?>
		<?php foreach ($fieldSets as $name => $fieldSet) : ?>
			<?php $metadatatabs = 'metadata-' . $name; ?>
			<?php echo JHtml::_('bootstrap.addTab', 'myTab', $metadatatabs, JText::_($fieldSet->label, true)); ?>
				<?php echo $this->loadTemplate('metadata'); ?>
			<?php echo JHtml::_('bootstrap.endTab'); ?>
		<?php endforeach; ?>

		<?php if ($assoc) : ?>
			<?php echo JHtml::_('bootstrap.addTab', 'myTab', 'associations', JText::_('JGLOBAL_FIELDSET_ASSOCIATIONS', true)); ?>
				<?php echo $this->loadTemplate('associations'); ?>
			<?php echo JHtml::_('bootstrap.endTab'); ?>
		<?php endif; ?>

		<?php echo JHtml::_('bootstrap.endTabSet'); ?>
	</fieldset>

		<input type="hidden" name="task" value="" />
		<?php echo JHtml::_('form.token'); ?>
		</div>
		<!-- End Newsfeed -->
		<!-- Begin Sidebar -->
			<?php echo JLayoutHelper::render('joomla.edit.details', $this); ?>
		<!-- End Sidebar -->
	</div>
</form>
