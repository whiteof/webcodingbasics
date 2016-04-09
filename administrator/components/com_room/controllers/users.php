<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_room
 *
 * @copyright   Copyright (C) 2012 - 2013 WhiteOf, Corp. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

/**
 * Newsfeeds list controller class.
 *
 * @package     Joomla.Administrator
 * @subpackage  com_room
 * @since       1.6
 */
class RoomControllerUsers extends JControllerAdmin
{
	/**
	 * Proxy for getModel.
	 */
	public function getModel($name = 'Users', $prefix = 'RoomModel', $config = array('ignore_request' => true))
	{
		$model = parent::getModel($name, $prefix, $config);
		return $model;
	}

	public function emailone()
	{
		$app = JFactory::getApplication();
		// Get the input
		$input = JFactory::getApplication()->input;
		$ids = $input->post->get('cid', array(), 'array');
		
		foreach($ids as $id) {
			// Try to find user
			$user = JUser::getInstance($id);
			if(!$user) {
				throw new Exception("Could not find user. Error: " . $user->getError());
			}
			if(!$this->sendEmailOne($user)) {
				$message = JText::sprintf('COM_ROOM_MESSAGE_EMAILONE_ERROR');
				if($this->saveUserLog($user, $message)) $app->redirect(JRoute::_('index.php?option=com_room&view=users', false), $message, 'error');
				else throw new Exception("Could not find user. Error: Failed to save user log.");
			}else {
				//$user->funnel_step = 1;
				//$user->save();
			}
		}		
		
		$message = JText::sprintf('COM_ROOM_MESSAGE_EMAILONE_SUCCESS');
		if($this->saveUserLog($user, $message)) $app->redirect(JRoute::_('index.php?option=com_room&view=users', false), $message, 'message');
		else throw new Exception("Could not find user. Error: Failed to save user log.");
	}
	
	public function sendEmailOne($user)
	{
		// Send email
		$mailer = JFactory::getMailer();
		$config = JFactory::getConfig();
		$mailer->setSender(array($config->get('mailfrom'), $config->get('fromname')));
		$mailer->addRecipient(array($user->email));
		$mailer->setSubject('Бесплатный второй урок курса "Как стать web-программистом за 2 недели"');
		$mailer->isHTML(true);
		$mailer->Encoding = 'base64';
		$user = JUser::getInstance($user->id);
		$body = '<p>Привет,</p>'.
				'<p>В данное время я работаю над усовершенствованием своего курса “Как стать программистом за две недели”. Я знаю, ты еще не прошел полный курс и тебе наверняка будет трудно оценить его по одному уроку, но все же я буду очень признателен если ты оставишь небольшой feedback.</p>'.
				'<p>Чтобы лучше понять что может реально помочь людям сдвинуться с места и начать поиск хорошей работы, я подготовил несколько вопросов. Нажми, пожалуйста, на ссылку, указанную ниже и поделись своими впечатлениями. Это займет всего лишь несколько минут, но я буду очень благодарен и вышлю тебе совершенно бесплатно второй урок, по углубленному изучению HTML.</p>'.
				'<p><a href="http://webcodingbasics.com/course-feedback?code='.$user->code.'">http://webcodingbasics.com/course-feedback</a></p>'.
				'<p>В этом уроке мы создадим первую страницу нашего интернет магазина, ты поймешь принципы блочной верстки, которая являеться основой 99% современных сайтов.</p>'.
				'<p>Заранее спасибо,<br />'.
				'Сергей Холодинский<br />'.
				'<a href="http://webcodingbasics.com">www.webcodingbasics.com</a></p>';
		$mailer->setBody($body);				
		$send = $mailer->Send();
		if ( $send !== true ) {
			throw new Exception("Could not send email. Error: " . $send->__toString());
		}
		return $send;
	}
	
	public function emailtwo()
	{
		$app = JFactory::getApplication();
		// Get the input
		$input = JFactory::getApplication()->input;
		$ids = $input->post->get('cid', array(), 'array');
		
		foreach($ids as $id) {
			// Try to find user
			$user = JUser::getInstance($id);
			if(!$user) {
				throw new Exception("Could not find user. Error: " . $user->getError());
			}
			if(!$this->sendEmailTwo($user)) {
				$message = JText::sprintf('COM_ROOM_MESSAGE_EMAILTWO_ERROR');
				if($this->saveUserLog($user, $message)) $app->redirect(JRoute::_('index.php?option=com_room&view=users', false), $message, 'error');
				else throw new Exception("Could not find user. Error: Failed to save user log.");
			}else {
				//$user->funnel_step = 3;
				//$user->save();
			}
		}		
		$message = JText::sprintf('COM_ROOM_MESSAGE_EMAILTWO_SUCCESS');
		if($this->saveUserLog($user, $message)) $app->redirect(JRoute::_('index.php?option=com_room&view=users', false), $message, 'message');
		else throw new Exception("Could not find user. Error: Failed to save user log.");
	}
	
	public function sendEmailTwo($user)
	{
		// Send email
		$mailer = JFactory::getMailer();
		$config = JFactory::getConfig();
		$mailer->setSender(array($config->get('mailfrom'), $config->get('fromname')));
		$mailer->addRecipient(array($user->email));
		$mailer->setSubject('СУПЕР БОНУС!!!');
		$mailer->isHTML(true);
		$mailer->Encoding = 'base64';
		$user = JUser::getInstance($user->id);
		$body = '
			<h3 style="color: #d40000">СУПЕР БОНУС!!!</h3>	
			<p>Спасибо Тебе за обратную связь! Я собрал много полезной информации, которая существенно помогла улучшить мой курс.</p>
			<p>Я очень надеюсь, что ты прошел второй урок, тебе он понравился и ты хочешь больше. На основе полученных ответов от тебя и других начинающих программистов я внес значительные изменения в курс и я уверен он оправдает твои ожидания.</p>
			<p>Я хочу сказать тебе спасибо за твою активность и в качестве благодарности предложить то, что еще ни разу не предлагал никому за время существования этого курса:</p>
			<ul>
				<li style="margin-bottom: 20px;"><strong>супер скидку - только для тебя и тех кто мне действительно помог в работе над курсом стоимость снижена до <font color="#d40000">$99.00</font></strong></li>
				<li style="margin-bottom: 20px;"><strong>супер бонус - бесплатная часовая онлайн консультация со мной (стоимость консультации $100/час)</strong></li>
				<li style="margin-bottom: 20px;"><strong>в данное время я работаю над дополнительным курсом “Как найти работу программиста в США”, где подробно расскажу о том с чего начинать поиск работы, как правильно составить резюме, что говорить рекрутерам по телефону и какие вопросы подготовить непосредственно к интервью и много других моментов. Все это будут не общие рекомендации, а конкретные действия, которые помогут тебе найти хорошую работу. Я планирую выпустить этот курс в начале июня и стоимость будет $149.00. В рамках моей благодарности ты получишь его абсолютно бесплатно!</strong></li>
				<li style="margin-bottom: 20px;"><strong>и пожалуй самый ценный бонус - доступ к закрытой группе в Facebook. Я поставил себе цель не просто создать курс по программированию и быстренько втюхать его кому-угодно, а создать сообщество программистов и людей которые хотят ими стать, где можно будет обмениваться опытом, быстро получать ответы на вопросы и впринципе находить работу. Я регулярно публикую там реальные вакансии. В этой группе состоят уже опытные программисты которым ты всегда можешь задать вопрос воде: “у меня на интерью спросили знаком ли я с ********, что это такое?”. Разумеется, и я сам активный участник этой группы и буду стараться оперативно отвечать на все вопросы.</strong></li>
			</ul>
			<p>
				И так:<br />
				<h4 style="color: #d40000;">$249.00 + $100.00 + $149.00 + своего рода пожизненная поддержка = $99.00</h4>
				математически это выражение конечно не имеет смысла… ;)
			</p>
			<p>Но это предложение только для активных пользователей, для тех, кто реально хочет стать программистом уже сегодня! И потому предложение ограничено, и <strong style="color: #d40000;">бонусы действуют только в течении трех дней - до 8 апреля 2016!</strong></p>
			<p><a href="http://webcodingbasics.com/super-bonus?code='.$user->code.'">http://webcodingbasics.com/super-bonus</a></p>
			<p>Сергей Холодинский<br />
			<a href="http://webcodingbasics.com">www.webcodingbasics.com</a></p>
		';
		$mailer->setBody($body);				
		$send = $mailer->Send();
		if ( $send !== true ) {
			throw new Exception("Could not send email. Error: " . $send->__toString());
		}
		return $send;
	}
	
	public function emailvk()
	{
		$app = JFactory::getApplication();
		// Get the input
		$input = JFactory::getApplication()->input;
		$ids = $input->post->get('cid', array(), 'array');
		
		foreach($ids as $id) {
			// Try to find user
			$user = JUser::getInstance($id);
			if(!$user) {
				throw new Exception("Could not find user. Error: " . $user->getError());
			}
			if(!$this->sendEmailVk($user)) {
				$message = JText::sprintf('COM_ROOM_MESSAGE_EMAILVK_ERROR');
				if($this->saveUserLog($user, $message)) $app->redirect(JRoute::_('index.php?option=com_room&view=users', false), $message, 'error');
				else throw new Exception("Could not find user. Error: Failed to save user log.");
			}else {
				//$user->funnel_step = 3;
				//$user->save();
			}
		}		
		$message = JText::sprintf('COM_ROOM_MESSAGE_EMAILVK_SUCCESS');
		if($this->saveUserLog($user, $message)) $app->redirect(JRoute::_('index.php?option=com_room&view=users', false), $message, 'message');
		else throw new Exception("Could not find user. Error: Failed to save user log.");
	}
	
	public function sendEmailVk($user)
	{
		// Send email
		$mailer = JFactory::getMailer();
		$config = JFactory::getConfig();
		$mailer->setSender(array($config->get('mailfrom'), $config->get('fromname')));
		$mailer->addRecipient(array($user->email));
		$mailer->setSubject('Вступай в группу Вконтакте - Как стать программистом и найти работу в США');
		$mailer->isHTML(true);
		$mailer->Encoding = 'base64';
		$user = JUser::getInstance($user->id);
		$body = '
			<p>Привет,</p>
			<p><strong>Вступай в группу Вконтакте - "Как стать программистом и найти работу в США!"</strong></p>
			<p>
				В этой группе я публикую последние новости в сфере веб-программирования и ситуации на рынке труда, дублирую статьи с моего блога <a href="http://learn.webcodingbasics.com">learn.webcodingbasics.com</a>.
				Там ты можешь задавать вопросы мне и другим программистам, оставлять свои комментарии и пожелания.
				Иногда я даже буду публиковать в группе реальные вакансии!
			</p>
			<p>Добавляйся в группу!<br />
			<a href="https://vk.com/webcodingbasics">vk.com/webcodingbasics</a>
			</p>
			<p>Сергей Холодинский<br />
			<a href="http://webcodingbasics.com">www.webcodingbasics.com</a></p>			
		';
		$mailer->setBody($body);				
		$send = $mailer->Send();
		if ( $send !== true ) {
			throw new Exception("Could not send email. Error: " . $send->__toString());
		}
		return $send;
	}
	
	public function saveUserLog($user, $message)
	{
		$userlog = $user->log;
		$user->log = $userlog.date('m/d/Y H:i:s').' - '.$message.";\n";
		if($user->save()) return true;
		else return false;
	}
}
