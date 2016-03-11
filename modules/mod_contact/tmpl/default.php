<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  mod_wcatalog_banner
 *
 * @copyright   Copyright (C) 2012 - 2016 WhiteOf, Corp. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

?>

<!-- Modal - Question -->
<div class="modal fade modal-question" id="modalQuestion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h3 class="modal-title" id="myModalLabel">
					Задай вопрос Сергею!
				</h3>
			</div>
			<div class="modal-body">
				<div class="modal-request">
					<div class="contact-form">
						<form id="contact-form" action="/index.php/contact" method="post" class="form-validate form-horizontal">
							<fieldset>
								<div class="control-group">
									<div class="control-label">
										<label id="jform_contact_name-lbl" for="jform_contact_name" class="hasTooltip required" title="&lt;strong&gt;Name&lt;/strong&gt;&lt;br /&gt;Your name.">
											Имя<span class="star">&#160;*</span>
										</label>
									</div>
									<div class="controls">
										<input type="text" name="jform[contact_name]" id="jform_contact_name" value="" class="form-control required" size="30" required aria-required="true" />
									</div>
								</div>
								<div class="control-group">
									<div class="control-label">
										<label id="jform_contact_email-lbl" for="jform_contact_email" class="hasTooltip required" title="&lt;strong&gt;Email&lt;/strong&gt;&lt;br /&gt;Email Address for contact.">
											Email<span class="star">&#160;*</span>
										</label>
									</div>
									<div class="controls">
										<input type="email" name="jform[contact_email]" class="form-control validate-email required" id="jform_contact_email" value="" size="30" required aria-required="true" />
									</div>
								</div>
								<div class="control-group">
									<div class="control-label">
										<label id="jform_contact_emailmsg-lbl" for="jform_contact_emailmsg" class="hasTooltip required" title="&lt;strong&gt;Subject&lt;/strong&gt;&lt;br /&gt;Enter the subject of your message here.">
											Тема<span class="star">&#160;*</span>
										</label>
									</div>
									<div class="controls">
										<input type="text" name="jform[contact_subject]" id="jform_contact_emailmsg" value="" class="form-control required" size="60" required aria-required="true" />
									</div>
								</div>
								<div class="control-group">
									<div class="control-label">
										<label id="jform_contact_message-lbl" for="jform_contact_message" class="hasTooltip required" title="&lt;strong&gt;Message&lt;/strong&gt;&lt;br /&gt;Enter your message here.">
											Вопрос<span class="star">&#160;*</span>
										</label>
									</div>
									<div class="controls">
										<textarea name="jform[contact_message]" id="jform_contact_message" cols="50" rows="10" class="form-control required" required aria-required="true" ></textarea>
									</div>
								</div>
								<div class="control-group">
									<div class="controls checkbox-left">
										<input type="checkbox" name="jform[contact_email_copy]" id="jform_contact_email_copy" value="1" />
									</div>
									<div class="control-label">
										<label id="jform_contact_email_copy-lbl" for="jform_contact_email_copy" class="hasTooltip" title="&lt;strong&gt;Send Copy to Yourself&lt;/strong&gt;&lt;br /&gt;Sends a copy of the message to the address you have supplied.">
											выслать копию на мой email
										</label>
									</div>
								</div>
								<div class="control-group">
									<div class="controls">
									</div>
								</div>
								<div class="clear_both"></div>
								<div class="form-actions">
									<button class="btn btn-primary validate" type="submit">Спросить</button>
									<input type="hidden" name="option" value="com_contact" />
									<input type="hidden" name="task" value="contact.submit" />
									<input type="hidden" name="return" value="" />
									<input type="hidden" name="id" value="1:contact-form" />
									<?php echo JHtml::_('form.token'); ?>
								</div>
							</fieldset>
						</form>
					</div>
				</div>
				<div class="loader"></div>
				<div class="modal-response">
					<p align="center"><strong>Спасибо за твой вопрос!</strong></p>
					<p align="center">Я постараюсь ответить тебе как можно скорее!</p>
				</div>
			</div>
		</div>
	</div>
</div>