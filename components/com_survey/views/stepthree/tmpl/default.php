<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
 
JHtml::_('behavior.keepalive');
JHtml::_('behavior.formvalidation');
 
?>
    <h4>Тебя не заинтересовало бонусное предложение.</h4>
	<p><em>Пожалуйста, ответь всего на один вопрос, возможно я смогу сделать предложение, которое тебя действительно заинтересует:</em></p>
	<hr />
    <form class="form-validate" action="<?php echo JRoute::_('index.php'); ?>" method="post" id="stepthree" name="stepthree">
        <?php echo $this->form->getInput('id'); ?>
		<div class="form-group">
			<?php echo $this->form->getLabel('why'); ?>
            <?php echo $this->form->getInput('why'); ?>
		</div>
		<hr />
		<div class="form-group">
			<input type="hidden" name="jform[code]" value="<?php echo $this->user->code?>" />
            <input type="hidden" name="option" value="com_survey" />
            <input type="hidden" name="task" value="stepthree.submit" />
            <button type="submit" class="btn btn-danger button"><?php echo JText::_('COM_SURVEY_STEPTHREE_SUBMIT'); ?></button>
			<?php echo JHtml::_('form.token'); ?>
		</div>
    </form>
    <div class="clr"></div>