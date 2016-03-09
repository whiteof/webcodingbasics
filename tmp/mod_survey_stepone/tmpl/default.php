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
						<p>
							Ответь на несколько простых вопросов, укажи свой email и я вышлю тебе певый урок абсолютно бесплатно!
						</p>
						<form class="form-validate" action="/webcodingbasics.com/index.php/component/survey/" method="post" id="stepone" name="stepone">
							<div class="form-group">
								<div class="row">
									<div class="col-sm-6">
										<label for="jform[first_name]">Имя</label>
										<input aria-invalid="true" name="jform[first_name]" id="jform_first_name" value="" class="form-control required" required="required" aria-required="true" type="text">
									</div>
									<div class="col-sm-6">
										<label for="jform[last_name]">Фамилия</label>
										<input aria-invalid="true" name="jform[last_name]" id="jform_first_name" value="" class="form-control required" required="required" aria-required="true" type="text">
									</div>
								</div>
							</div>
							<div class="form-group">
								<label for="form[years]">Как давно ты в США?</label>
								<select class="form-control" name="form[years]">
									<option value="0"></option>
									<option value="1">1 год</option>
									<option value="2">2 год</option>
									<option value="3">3 год</option>
									<option value="4">4 год</option>
									<option value="5">5 год</option>
									<option value="6">более 5 лет</option>
								</select>
							</div>
							<div class="form-group">
								<label for="form[job]">Кем работаешь?</label>
								<input type="text" class="form-control" name="form[job]" />
							</div>
							<div class="form-group">
								<label for="form[education]">Образование</label>
								<div class="row">
									<div class="col-sm-6">
										<ul class="no-list">
											<li><input type="radio" name="form[education]" value="1" /> евляюсь студентом сейчас</li>
											<li><input type="radio" name="form[education]" value="2" /> бакалавр в США</li>
											<li><input type="radio" name="form[education]" value="3" /> комьюнити колледж в США</li>
										</ul>
									</div>
									<div class="col-sm-6">
										<ul class="no-list">
											<li><input type="radio" name="form[education]" value="4" /> прошел курсы</li>
											<li><input type="radio" name="form[education]" value="5" /> не учусь и не учился в США</li>
										</ul>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label for="form[english]">Уровень английского?</label>
								<div class="row">
									<div class="col-sm-6">
										<ul class="no-list">
											<li><input type="radio" name="form[education]" value="1" /> начальный</li>
											<li><input type="radio" name="form[education]" value="2" /> средний</li>
										</ul>
									</div>
									<div class="col-sm-6">
										<ul class="no-list">
											<li><input type="radio" name="form[education]" value="3" /> разговорный</li>
											<li><input type="radio" name="form[education]" value="4" /> литературный</li>
										</ul>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label for="form[why]">Почему ты хочешь научиться программировать? Опиши минимум в 10 словах.</label>
								<textarea name="form[why]" class="form-control"></textarea>
							</div>
							<div class="form-group">
								<label for="form[what]">Что бы ты первым делом сделал, если бы уже завтра ты бы нашел работу программистом на $60к в год и полным пакетом бенефитов. Опиши минимум в 10 словах.</label>
								<textarea name="form[what]" class="form-control"></textarea>
							</div>
							<div class="form-group">
								<div class="row">
									<div class="col-sm-6">
										<label for="form[sex]">Пол</label>
										<ul class="no-list">
											<li><input type="radio" name="form[sex]" value="male" /> мужской</li>
											<li><input type="radio" name="form[sex]" value="female" /> женский</li>
										</ul>										
									</div>
									<div class="col-sm-6">
										<label for="form[age]">Возраст</label>
										<input type="text" class="form-control" name="form[age]" />
									</div>
								</div>
							</div>
							<div class="form-group">
								<label for="form[email]">Email</label>
								<input type="email" class="form-control" name="form[email]" />
							</div>							
						
					</div>
					<div class="modal-footer">
						<button type="submit" class="btn btn-danger">Получить первый урок!</button>
					</div>
						</form>
				</div>
			</div>
		</div>