<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_survey
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

JHtml::_('behavior.keepalive');
JHtml::_('behavior.formvalidation');
JHtml::_('behavior.tooltip');

?>
<div class="create-password">

	<form class="form-validate form-horizontal well" action="<?php echo JRoute::_('index.php'); ?>" method="post" id="start" name="start">
		<?php foreach ($this->form->getFieldsets() as $fieldset) : ?>
			<fieldset>
				<legend>Создать пароль</legend>
				<p><?php echo JText::_($fieldset->label); ?></p>
				<?php foreach ($this->form->getFieldset($fieldset->name) as $name => $field) : ?>
					<div class="control-group">
						<div class="control-label">
							<?php echo $field->label; ?>
						</div>
						<div class="controls">
							<?php echo $field->input; ?>
						</div>
					</div>
				<?php endforeach; ?>
			</fieldset>
		<?php endforeach; ?>

		<div class="control-group">
			<div class="controls">
				<input type="hidden" name="jform[code]" value="<?php echo $this->user->code?>" />
				<input type="hidden" name="option" value="com_survey" />
            	<input type="hidden" name="task" value="start.submit" />				
				<button type="submit" class="btn btn-primary validate"><?php echo JText::_('COM_SURVEY_SUBMIT_BUTTON'); ?></button>
			</div>
		</div>
		<?php echo JHtml::_('form.token'); ?>
	</form>
</div>
