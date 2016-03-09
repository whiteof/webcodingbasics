<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  mod_room_buy
 *
 * @copyright   Copyright (C) 2012 - 2016 WhiteOf, Corp. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
?>
		<!-- Modal - Buy Course -->
		<div class="modal fade modal-buy" id="modalBuy" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
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
						<h2>Стоимость инвестиции всего $249.00</h2>
						<p>&nbsp;</p>
						<p>Стоимость курса <strong>всего $249.00</strong>, тогда как средняя зарплата Junior Developer начинаеться от <strong>$60,000 в год</strong>. Или ты сможешь отбить эти деньги сделав всего один сайт на заказ, например на <a href="https://www.freelancer.com" target="_blank">freelancer.com</a>.</p>
						<p>К тому же, это напорядок меньше стоимости обучения в колледже или стоимости специализированных курсов. Ты сьэкономишь уйму времени и сил.</p>
						<p><strong>Но самое главное, что ты абсолютно ничем не рискуешь!</strong></p>
						<p align="center"><img class="img-responsive" style="max-width: 200px;" src="<?php echo JURI::base() . '/images/' ?>money_back.png" /></p>
						<p>Если тебе не понравится результат - в течение 30 дней верну все твои деньги без лишних вопросов в 100% размере.</p>
						<p>Если бы я не был уверен в результате на 100%, то вряд ли стал давать такую гарантию!</p>
						<p><strong>Поэтому немедленно отложи сомнения и стань программистом уже через 2 недели!</strong></p>
					</div>
					<div class="modal-footer">
						<div class="row">
							<div class="col-sm-6">
								<img class="img-responsive" style="max-width: 180px;" src="<?php echo JURI::base() . '/images/' ?>secure-payment-icon.jpg" />
							</div>
							<div class="col-sm-6">
								<button type="submit" class="btn btn-danger pay-button" data-form="paypal-button-full">Стать программистом!</button>
							</div>
						</div>
						<div class="hidden">
							<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top" id="paypal-button-full">
							<input type="hidden" name="cmd" value="_s-xclick">
							<input type="hidden" name="hosted_button_id" value="B67EWUWJC32WQ">
							<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
							<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>