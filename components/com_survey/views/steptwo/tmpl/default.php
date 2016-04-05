<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
 
JHtml::_('behavior.keepalive');
JHtml::_('behavior.formvalidation');
 
?>
    <h3>Пожалуйста, помоги мне усовершенствовать курс</h3>
	<h4>Ответь на эти четыре вопроса, и в качестве благодарности я открою тебе доступ ко второму уроку совершенно бесплатно!</h4>
	<p><em>Во втором уроке мы создадим первую страницу нашего интернет магазина, ты поймешь принципы блочной верстки, которая являеться основой 99% современных сайтов.</em></p>
	<hr />
    <form class="form-validate" action="<?php echo JRoute::_('index.php'); ?>" method="post" id="steptwo" name="steptwo">
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
		<hr />
		<div class="form-group">
			<input type="hidden" name="jform[code]" value="<?php echo $this->user->code?>" />
            <input type="hidden" name="option" value="com_survey" />
            <input type="hidden" name="task" value="steptwo.submit" />
            <button type="submit" class="btn btn-danger button"><?php echo JText::_('COM_SURVEY_STEPTWO_SUBMIT'); ?></button>
			<?php echo JHtml::_('form.token'); ?>
		</div>
    </form>
    <div class="clr"></div>