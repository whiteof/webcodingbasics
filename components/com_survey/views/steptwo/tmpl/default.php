<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
 
JHtml::_('behavior.keepalive');
JHtml::_('behavior.formvalidation');
 
?>
    <h2></h2>
 
    <form class="form-validate" action="<?php echo JRoute::_('index.php'); ?>" method="post" id="stepone" name="stepone">
        <?php echo $this->form->getInput('id'); ?>
		<div class="form-group">
			<?php echo $this->form->getLabel('family_situation'); ?>
            <?php echo $this->form->getInput('family_situation'); ?>
		</div>
		<div class="form-group">
			<?php echo $this->form->getLabel('learn_for'); ?>
            <?php echo $this->form->getInput('learn_for'); ?>
		</div>
		<div class="form-group">
			<?php echo $this->form->getLabel('challenges'); ?>
            <?php echo $this->form->getInput('challenges'); ?>
		</div>
		<div class="form-group">
			<?php echo $this->form->getLabel('expectations'); ?>
            <?php echo $this->form->getInput('expectations'); ?>
		</div>
		<div class="form-group">
            <input type="hidden" name="option" value="com_survey" />
            <input type="hidden" name="task" value="steptwo.submit" />
            <button type="submit" class="btn btn-danger button"><?php echo JText::_('COM_SURVEY_STEPTWO_SUBMIT'); ?></button>
			<?php echo JHtml::_('form.token'); ?>
		</div>
    </form>
    <div class="clr"></div>