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
		$mailer->setSubject('Бесплатный второй урок экспресс-видеокурса по основам веб-программирования для начинающих!');
		$mailer->isHTML(true);
		$mailer->Encoding = 'base64';
		$user = JUser::getInstance($user->id);
		$body = '<p>Привет,</p>'.
				'<p>В данное время я работаю над усовершенствованием своего экспресс-видеокурса по основам веб-программирования для начинающих. Я знаю, ты еще не прошел полный курс и тебе наверняка будет трудно оценить его по одному уроку, но все же я буду очень признателен, если ты оставишь небольшой feedback.</p>'.
				'<p>Чтобы лучше понять, что может реально помочь людям сдвинуться с места и начать поиск хорошей работы, я подготовил несколько вопросов. Нажми, пожалуйста, на ссылку, указанную ниже и поделись своими впечатлениями. Это займет всего лишь несколько минут, но я буду очень благодарен и вышлю тебе совершенно бесплатно второй урок, по углубленному изучению HTML.</p>'.
				'<p><a href="http://webcodingbasics.com/course-feedback?code='.$user->code.'">http://webcodingbasics.com/course-feedback</a></p>'.
				'<p>В этом уроке мы создадим первую страницу нашего интернет-магазина, ты поймешь принципы блочной верстки, которая является основой 99% современных сайтов.</p>'.
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
	
	public function emailthree()
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
			if(!$this->sendEmailThree($user)) {
				$message = JText::sprintf('COM_ROOM_MESSAGE_EMAILTHREE_ERROR');
				if($this->saveUserLog($user, $message)) $app->redirect(JRoute::_('index.php?option=com_room&view=users', false), $message, 'error');
				else throw new Exception("Could not find user. Error: Failed to save user log.");
			}else {
				//$user->funnel_step = 1;
				//$user->save();
			}
		}		
		
		$message = JText::sprintf('COM_ROOM_MESSAGE_EMAILTHREE_SUCCESS');
		if($this->saveUserLog($user, $message)) $app->redirect(JRoute::_('index.php?option=com_room&view=users', false), $message, 'message');
		else throw new Exception("Could not find user. Error: Failed to save user log.");
	}
	
	public function sendEmailThree($user)
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
			<p>Привет,</p>
			<p>Я обнаружил, что иногда людям не доходят электронные письма, которые я им отправляю. Три дня назад я высылал тебе письмо с благодарностью за обратную связь и с супер бонусом. Возможно ты его не получил (в этом случае просто ответь мне на это письмо - “я не получил”), а возможно тебя что-то не устраивает в самом курсе или в моем предложении.</p>
			<p>Я бы хотел попросить тебя ответить всего на пару вопросов:</p>
			<p><a href="http://webcodingbasics.com/bonus-feedback?code='.$user->code.'">http://webcodingbasics.com/bonus-feedback</a></p>
			<p>Это займет меньше минуты и существенно поможет понять мне, что не так и, возможно, сделать предложение, которое тебя действительно заинтересует.</p>
			<p>
				Заранее спасибо,<br />
				Сергей Холодинский<br />
				<a href="http://webcodingbasics.com">www.webcodingbasics.com</a>
			</p>
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
				В этой группе я публикую последние новости в сфере веб-программирования и ситуации на рынке труда, дублирую статьи из моего блога <a href="http://learn.webcodingbasics.com">learn.webcodingbasics.com</a>.
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
	
	public function emailarticleone()
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
			if(!$this->sendEmailArticleOne($user)) {
				$message = JText::sprintf('COM_ROOM_MESSAGE_EMAIL_ARTICLE_ONE_ERROR');
				if($this->saveUserLog($user, $message)) $app->redirect(JRoute::_('index.php?option=com_room&view=users', false), $message, 'error');
				else throw new Exception("Could not find user. Error: Failed to save user log.");
			}else {
				//$user->funnel_step = 3;
				//$user->save();
			}
		}		
		$message = JText::sprintf('COM_ROOM_MESSAGE_EMAIL_ARTICLE_ONE_SUCCESS');
		if($this->saveUserLog($user, $message)) $app->redirect(JRoute::_('index.php?option=com_room&view=users', false), $message, 'message');
		else throw new Exception("Could not find user. Error: Failed to save user log.");
	}
	
	public function sendEmailArticleOne($user)
	{
		// Send email
		$mailer = JFactory::getMailer();
		$config = JFactory::getConfig();
		$mailer->setSender(array($config->get('mailfrom'), $config->get('fromname')));
		$mailer->addRecipient(array($user->email));
		$mailer->setSubject('Путь программиста — Часть 1: Так все же, с чего начать…');
		$mailer->isHTML(true);
		$mailer->Encoding = 'base64';
		$user = JUser::getInstance($user->id);
		$body = '
			<p>Привет,</p>
			<p>Если ты читаешь это письмо, значит, осмелюсь предположить, ты подумываешь найти работу программиста. По своему опыту, я точно знаю, труднее всего - сделать первый шаг. С чего лучше начать? Как научиться программировать?</p>
			<p>Я попытался ответить на эти вопросы в статье <a href="http://learn.webcodingbasics.com/index.php/2016/03/28/become-developer-part-one/">Путь программиста - Часть 1: Так все же, с чего начать…</a></p>
			<p>В этой статье я описываю возможные и наиболее популярные варианты обучения программированию, сравниваю их с точки зрения затрат денег и времени, анализирую результат - то что ты получишь на выходе.</p>
			<p><strong>Прочитай эту статью, думаю она окажеться для тебя полезной. Покрайней мере, ты получишь общую картину ситуации в сфере образования и специализированных курсов:</strong></p>
			<p>Ссылка на статью:<br /><a href="http://learn.webcodingbasics.com/index.php/2016/03/28/become-developer-part-one/">http://learn.webcodingbasics.com/index.php/2016/03/28/become-developer-part-one/</a></p>
			<p>Буду рад получить комментарии или вопросы,</p>
			<p>
				Сергей Холодинский<br />
				<a href="http://webcodingbasics.com">www.webcodingbasics.com</a>
			</p>			
		';
		$mailer->setBody($body);				
		$send = $mailer->Send();
		if ( $send !== true ) {
			throw new Exception("Could not send email. Error: " . $send->__toString());
		}
		return $send;
	}
	
	public function emailarticletwo()
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
			if(!$this->sendEmailArticleTwo($user)) {
				$message = JText::sprintf('COM_ROOM_MESSAGE_EMAIL_ARTICLE_TWO_ERROR');
				if($this->saveUserLog($user, $message)) $app->redirect(JRoute::_('index.php?option=com_room&view=users', false), $message, 'error');
				else throw new Exception("Could not find user. Error: Failed to save user log.");
			}else {
				//$user->funnel_step = 3;
				//$user->save();
			}
		}		
		$message = JText::sprintf('COM_ROOM_MESSAGE_EMAIL_ARTICLE_TWO_SUCCESS');
		if($this->saveUserLog($user, $message)) $app->redirect(JRoute::_('index.php?option=com_room&view=users', false), $message, 'message');
		else throw new Exception("Could not find user. Error: Failed to save user log.");
	}
	
	public function sendEmailArticleTwo($user)
	{
		// Send email
		$mailer = JFactory::getMailer();
		$config = JFactory::getConfig();
		$mailer->setSender(array($config->get('mailfrom'), $config->get('fromname')));
		$mailer->addRecipient(array($user->email));
		$mailer->setSubject('Путь программиста – Часть 2: Какой язык программирования выбрать?');
		$mailer->isHTML(true);
		$mailer->Encoding = 'base64';
		$user = JUser::getInstance($user->id);
		$body = '
			<p>Привет,</p>
			<p>В продолжение вчерашней статьи <a href="http://learn.webcodingbasics.com/index.php/2016/03/28/become-developer-part-one/">Путь программиста - Часть 1: Так с чего же начать…</a>, хочеться сказать, что многие люди, которые хотят работать программистами задаються вопросом: какой язык программирования выбрать?</p>
			<p>Когда я столкнулся с этим выбором, я перечитал кучу блогов, статей и комментариев. Естественно, каждый хвалил свой “огород”. Это заставило меня задуматься, по каким критериям нужно рассматривать язык программирования, исходя из чего делать выбор, чтобы он оказался более менее обьективным?</p>
			<p>Спустя практически 10 лет, имея представление о ситуации на рынке труда программистов, я пришел к выводу что выбирать язык программирования нужно исходя из следующих критериев:</p>
			<ul>
				<li>заработная плата</li>
				<li>количество рабочих мест</li>
				<li>как много времени уйдет на освоение минимальных знаний, с которыми можно начинать поиск работы</li>
				<li>перспективы карьерного роста</li>
			</ul>
			<p><strong>Прочитай статью <a href="http://learn.webcodingbasics.com/index.php/2016/04/08/become-developer-part-two/">Путь программиста - Часть 2: Какой язык программирования выбрать?</a>. В ней я рассматриваю наиболее популярные языки программирования с точки зрения этих критериев.</strong></p>
			<p>Ссылка на статью:<br /><a href="http://learn.webcodingbasics.com/index.php/2016/04/08/become-developer-part-two/">http://learn.webcodingbasics.com/index.php/2016/04/08/become-developer-part-two/</a></p>
			<p>Буду рад получить комментарии или вопросы,</p>
			<p>
				Сергей Холодинский<br />
				<a href="http://webcodingbasics.com">www.webcodingbasics.com</a>
			</p>			
		';
		$mailer->setBody($body);				
		$send = $mailer->Send();
		if ( $send !== true ) {
			throw new Exception("Could not send email. Error: " . $send->__toString());
		}
		return $send;
	}
	
	public function emailarticlethree()
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
			if(!$this->sendEmailArticleThree($user)) {
				$message = JText::sprintf('COM_ROOM_MESSAGE_EMAIL_ARTICLE_THREE_ERROR');
				if($this->saveUserLog($user, $message)) $app->redirect(JRoute::_('index.php?option=com_room&view=users', false), $message, 'error');
				else throw new Exception("Could not find user. Error: Failed to save user log.");
			}else {
				//$user->funnel_step = 3;
				//$user->save();
			}
		}		
		$message = JText::sprintf('COM_ROOM_MESSAGE_EMAIL_ARTICLE_THREE_SUCCESS');
		if($this->saveUserLog($user, $message)) $app->redirect(JRoute::_('index.php?option=com_room&view=users', false), $message, 'message');
		else throw new Exception("Could not find user. Error: Failed to save user log.");
	}
	
	public function sendEmailArticleThree($user)
	{
		// Send email
		$mailer = JFactory::getMailer();
		$config = JFactory::getConfig();
		$mailer->setSender(array($config->get('mailfrom'), $config->get('fromname')));
		$mailer->addRecipient(array($user->email));
		$mailer->setSubject('Путь программиста – Часть 3: Составляем правильное резюме, идем на собеседование!');
		$mailer->isHTML(true);
		$mailer->Encoding = 'base64';
		$user = JUser::getInstance($user->id);
		$body = '
			<p>Привет,</p>
			<p>В предыдущей статье <a href="http://learn.webcodingbasics.com/index.php/2016/04/08/become-developer-part-two/">Путь программиста - Часть 2: Какой язык программирования выбрать?</a> я разбирал различные языки программирования с точки зрения з/п, количества рабочих мест, сложности в изучении и перспектив.</p>
			<p>Предположим, ты выбрал язык программирования, определился с тем как будешь его изучать, изучил и вот наступает самый главный момент - <strong>ПОИСК РАБОТЫ!!!</strong></p>
			<p>Что делать?! Куда бежать?!</p>
			<p>
				<strong>
					Я считаю, что процесс поиска работы гоооораздо важнее самого обучения программированию. Если ты к этому хорошо подготовишься и будешь владеть определенными знаниями и фишками, ты сьэкономишь кучу времени и сил, найдешь работу на порядок быстрее, а соответственно сьэкономишь много денег.<br />
					Вот именно о таких фишках я и рассказываю в статье <a href="http://learn.webcodingbasics.com/index.php/2016/04/09/become-developer-part-three/">Путь программиста - Часть 3: Составляем правильное резюме, идем на собеседование…</a>
				</strong>
			</p>
			<p>Ссылка на статью:<br /><a href="http://learn.webcodingbasics.com/index.php/2016/04/09/become-developer-part-three/">http://learn.webcodingbasics.com/index.php/2016/04/09/become-developer-part-three/</a></p>
			<p>Буду рад получить комментарии или вопросы,</p>
			<p>
				Сергей Холодинский<br />
				<a href="http://webcodingbasics.com">www.webcodingbasics.com</a>
			</p>			
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
