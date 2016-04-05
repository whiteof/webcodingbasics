<?php
	
	// No direct access.
	defined('_JEXEC') or die;
	 
	// Include dependancy of the main controllerform class
	jimport('joomla.application.component.controllerform');
	
	jimport( 'joomla.user.helper');
	 
	class SurveyControllerStepone extends JControllerForm
	{
	 
		public function getModel($name = '', $prefix = '', $config = array('ignore_request' => true))
		{
			return parent::getModel($name, $prefix, array('ignore_request' => false));
		}
	
		public function submit()
		{
			JRequest::checkToken() or jexit(JText::_('JINVALID_TOKEN'));
	 
			// Initialise variables.
			$app	= JFactory::getApplication();
			$model	= $this->getModel('stepone');
	 
			$post_data = $app->input->post->getArray();
			$model->save($post_data);
			  
			// Create new user
			$code = md5(time()).$this->generateRandomString();
			$data = array(
				"name" => $post_data['first_name'].' '.$post_data['last_name'],
				"username" => $post_data['email'],
				"password" => $code,
				"password2" => $code,
				"email" => $post_data['email'],
				"block" => 0,
				"groups" => array ('2')
			);
			$user = new JUser;
			if(!$user->bind($data)) {
				throw new Exception("Could not bind data. Error: " . $user->getError());
			}else {
				$user->code = $code;
			}
			if (!$user->save()) {
				throw new Exception("Could not save user. Error: " . $user->getError());
			}else {
				// Send email
				$mailer = JFactory::getMailer();
				$config = JFactory::getConfig();
				$mailer->setSender(array($config->get('mailfrom'), $config->get('fromname')));
				$mailer->addRecipient(array($user->email, 'victor.yurkin@gmail.com'));
				$mailer->setSubject('Уже скоро Ты станешь веб-программистом!');
				$body = '<p>Привет!</p>'.
						'<p>Как и обещал высылаю тебе ссылку на первый видеоурок:'.
						'<p><a href="http://webcodingbasics.com/course-start?code='.$user->code.'">http://webcodingbasics.com/course/lesson10</a></p>'.
						'<p><strong>Не теряй время и переходи к изучению прямо сейчас!</strong></p>'.
						'<p>Сергей Холодинский<br />'.
						'<a href="http://webcodingbasics.com">www.webcodingbasics.com</p>';
				$mailer->isHTML(true);
				$mailer->Encoding = 'base64';
				$mailer->setBody($body);				
				$send = $mailer->Send();
				if ( $send !== true ) {
					throw new Exception("Could not send email. Error: " . $send->__toString());
				}
			}
			
			// Add first lesson to the user
			$model->addLesson($user->id);
			
			return true;
		}
		
		public function generateRandomString($length = 5) {
			$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
			$charactersLength = strlen($characters);
			$randomString = '';
			for ($i = 0; $i < $length; $i++) {
				$randomString .= $characters[rand(0, $charactersLength - 1)];
			}
			return $randomString;
		}		
	 
	}
