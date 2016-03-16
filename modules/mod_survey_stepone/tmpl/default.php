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

		<!-- Modal - Free Lesson -->
		<div class="modal fade modal-free" id="modalFree" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h3 class="modal-title" id="myModalLabel">
							Правильное решение!<br />
							Уже скоро Ты станешь веб-программистом!
						</h3>
					</div>
					<div class="modal-body">
						<div class="modal-request">
							<p>
								Ответь на несколько простых вопросов, укажи свой email и я вышлю тебе певый урок абсолютно бесплатно!
							</p>
							<form class="form-validate" action="<?php echo JRoute::_('index.php?option=com_survey'); ?>" method="post" id="stepone" name="stepone">
								<?php echo $form->getInput('id'); ?>
								<div class="form-group">
									<div class="row">
										<div class="col-sm-6">
											<?php echo $form->getLabel('first_name'); ?>
											<?php echo $form->getInput('first_name'); ?>
										</div>
										<div class="col-sm-6">
											<?php echo $form->getLabel('last_name'); ?>
											<?php echo $form->getInput('last_name'); ?>
										</div>
									</div>
								</div>
								<div class="form-group">
									<?php echo $form->getLabel('years_in_usa'); ?>
									<?php echo $form->getInput('years_in_usa'); ?>
								</div>
								<div class="form-group">
									<?php echo $form->getLabel('job'); ?>
									<?php echo $form->getInput('job'); ?>
								</div>
								<div class="form-group">
									<div class="row">
										<div class="col-sm-6">
											<?php echo $form->getLabel('education'); ?>
											<?php echo $form->getInput('education'); ?>
										</div>
										<div class="col-sm-6">
											<?php echo $form->getLabel('english_level'); ?>
											<?php echo $form->getInput('english_level'); ?>
										</div>
									</div>
								</div>
								<div class="form-group">
									<?php echo $form->getLabel('why'); ?>
									<?php echo $form->getInput('why'); ?>
								</div>
								<div class="form-group">
									<?php echo $form->getLabel('what'); ?>
									<?php echo $form->getInput('what'); ?>
								</div>
								<div class="form-group">
									<div class="row">
										<div class="col-sm-6">
											<?php echo $form->getLabel('sex'); ?>
											<?php echo $form->getInput('sex'); ?>
										</div>
										<div class="col-sm-6">
											<?php echo $form->getLabel('age'); ?>
											<?php echo $form->getInput('age'); ?>
										</div>
									</div>
								</div>
								<div class="form-group">
									<?php echo $form->getLabel('email'); ?>
									<?php echo $form->getInput('email'); ?>
								</div>							
						</div>
						<div class="loader"></div>
						<div class="modal-response">
							<p align="center"><strong>Спасибо за регистрацию!</strong></p>
							<p align="center">Теперь проверь свой электронный ящик!</p>
							<p align="center">Тебя ожидают дальнейшие инструкции!</p>
						</div>
					</div>
					<div class="modal-footer">
						<input type="hidden" name="option" value="com_survey" />
						<input type="hidden" name="task" value="stepone.submit" />
						<button type="submit" class="btn btn-danger"><?php echo JText::_('COM_SURVEY_FORM_LBL_STEPONE_SUBMIT'); ?></button>
						<?php echo JHtml::_('form.token'); ?>
						<button type="button" class="btn btn-default close-modal" data-dismiss="modal">Закрыть</button>
					</div>
							</form>
				</div>
			</div>
		</div>