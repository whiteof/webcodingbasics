<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
 
JHtml::_('behavior.keepalive');
JHtml::_('behavior.formvalidation');
JHtml::_('behavior.tooltip');
 
?>
    <h2>Update the Hello World greeting</h2>
 
    <form class="form-validate" action="<?php echo JRoute::_('index.php'); ?>" method="post" id="stepone" name="stepone">
		<fieldset>
        	<dl>
          	    <dt><?php echo $this->form->getLabel('id'); ?></dt>
             	<dd><?php echo $this->form->getInput('id'); ?></dd>
                <dt></dt><dd></dd>
        	    <dt><?php echo $this->form->getLabel('first_name'); ?></dt>
        	    <dd><?php echo $this->form->getInput('first_name'); ?></dd>
                <dt></dt><dd></dd>
                <dt></dt>
            	<dd><input type="hidden" name="option" value="com_survey" />
            	    <input type="hidden" name="task" value="stepone.submit" />
                </dd>
                <dt></dt>
                <dd><button type="submit" class="button"><?php echo JText::_('Submit'); ?></button>
			                <?php echo JHtml::_('form.token'); ?>
                </dd>
        	</dl>
        </fieldset>
    </form>
    <div class="clr"></div>