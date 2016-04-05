<?php
	
	// No direct access to this file
	defined('_JEXEC') or die('Restricted access');
	
	class RoomViewPayment extends JViewLegacy
	{
        
		function display($tpl = null) 
		{
			//$pp_hostname = "www.paypal.com";
			$pp_hostname = "www.sandbox.paypal.com";
			$req = 'cmd=_notify-synch';
			$tx_token = JRequest::getVar('tx');
			$auth_token = "2A6Pj6BOGt40qxP8q5aTbdkww8jV4Fod7C0mCqWru8UBvtnPEBeWNg8ZZ9O";
			$req .= "&tx=$tx_token&at=$auth_token";
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, "https://$pp_hostname/cgi-bin/webscr");
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $req);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
			curl_setopt($ch, CURLOPT_HTTPHEADER, array("Host: $pp_hostname"));
			$res = curl_exec($ch);
			curl_close($ch);
			if(!$res){
				return false;
			}else{
				$lines = explode("\n", $res);
				$keyarray = array();
				if (strcmp ($lines[0], "SUCCESS") == 0) {
					foreach($lines as $line){
						$line_arr = explode("=", $line);
						if(isset($line_arr[0])) $key = $line_arr[0]; else $key = "";
						if(isset($line_arr[1])) $val = $line_arr[1]; else $val = "";
						$keyarray[urldecode($key)] = urldecode($val);
					}
					$firstname = $keyarray['first_name'];
					$lastname = $keyarray['last_name'];
					
					if(!empty($keyarray['custom'])) $email = $keyarray['custom'];
					else $email = $keyarray['payer_email'];
					
					if(!empty($email)) {
						// Try to find user
						$db = JFactory::getDbo();
						$query = $db->getQuery(true)->select('a.*')->from('#__users AS a');
						$query->where('a.username = '.$db->quote($db->escape($email, true)));
						$db->setQuery($query);
						$item = $db->loadObject();
						if($item) {
							$user = JUser::getInstance($item->id);
							$groups = $user->groups;
							if(!in_array('10', $groups)) $groups[] = '10';
							$groups[] = '11';
							$user->groups = $groups;
						}else {
							// Create new user
							$code = md5(time()).$this->get('Randomstring');
							$data = array(
								"name" => $firstname.' '.$lastname,
								"username" => $email,
								"password" => $code,
								"password2" => $code,
								"email" => $email,
								"block" => 0,
								"groups" => array('2', '10', '11')
							);
							$user = new JUser;
							if(!$user->bind($data)) {
								throw new Exception("Could not bind data. Error: " . $user->getError());
							}else {
								$user->code = $code;
							}
						}
						if (!$user->save()) {
							throw new Exception("Could not save user. Error: " . $user->getError());
						}							

						// Send email
						$mailer = JFactory::getMailer();
						$config = JFactory::getConfig();
						$mailer->setSender(array($config->get('mailfrom'), $config->get('fromname')));
						$mailer->addRecipient(array($user->email));
						$mailer->setSubject('Оплата прошла успешно!');
						$mailer->isHTML(true);
						$mailer->Encoding = 'base64';
						$user = JUser::getInstance($user->id);
						if($user->funnel_step > 0) {
							$body = '<p>Доступ к видео курсу "Как стать web-программистом за 2 недели и найти работу в США" открыт:'.
									'<p><a href="http://webcodingbasics.com/course/lesson1/part1">http://webcodingbasics.com/course/lesson1/part1</a></p>'.
									'<p>Сергей Холодинский<br />'.
									'<a href="http://webcodingbasics.com">www.webcodingbasics.com</p>';								
						}else {
							$body = '<p>Доступ к видео курсу "Как стать web-программистом за 2 недели и найти работу в США":'.
									'<p><a href="http://webcodingbasics.com/course-start?code='.$user->code.'">http://webcodingbasics.com/course/lesson1/part1</a></p>'.
									'<p>Сергей Холодинский<br />'.
									'<a href="http://webcodingbasics.com">www.webcodingbasics.com</p>';
						}
						$mailer->setBody($body);				
						$send = $mailer->Send();
						if ( $send !== true ) {
							throw new Exception("Could not send email. Error: " . $send->__toString());
						}else {
							$app = JFactory::getApplication();
							$app->redirect('index.php?payment=success');
						}						
					}
				}else if (strcmp ($lines[0], "FAIL") == 0) {
					return false;
				}
			}
		}
	}