<?php

	// No direct access to this file
	defined('_JEXEC') or die('Restricted access');
	 
	// Include dependancy of the main model form
	jimport('joomla.application.component.modelform');
	// import Joomla modelitem library
	jimport('joomla.application.component.modelitem');
	// Include dependancy of the dispatcher
	jimport('joomla.event.dispatcher');
	 
	/**
	 * Stepone Model
	 */
	class SurveyModelStepthree extends JModelForm
	{
		/**
		 * @var object item
		 */
		protected $item;
	 
		/**
		 * Get the data for a new qualification
		 */
		public function getForm($data = array(), $loadData = true)
		{
	 
			$app = JFactory::getApplication('site');
	 
			// Get the form.
			$form = $this->loadForm('com_survey.stepthree', 'stepthree', array('control' => 'jform', 'load_data' => true));
			if (empty($form)) {
				return false;
			}
			return $form;
	 
		}
		
		public function getUserByCode($code)
		{
            if(!empty($code)){
                $db = $this->getDbo();
                $query = $db->getQuery(true)->select('a.*')->from('#__users AS a');
                $query->where('a.code = '.$db->quote($db->escape($code, true)));
                $db->setQuery($query);
                $item = $db->loadObject();
				$user = JUser::getInstance($item->id);
				return $user;
            }else return false;
			
		}
		
		public function getUser()
		{
            $code = JRequest::getVar('code');            
            //$user = JFactory::getUser();
            if(!empty($code)){
                $db = $this->getDbo();
                $query = $db->getQuery(true)->select('a.*')->from('#__users AS a');
                $query->where('a.code = '.$db->quote($db->escape($code, true)));
                $db->setQuery($query);
                $user = $db->loadObject();
            }
			if (empty($user))
			{
				JError::raiseError(404, JText::_('COM_SURVEY_USER_NOT_FOUND'));
			}
			
            return $user;
		}
		
	 
		/**
		 * Get the message
		 * @return object The message to be displayed to the user
		 */
		function getItem()
		{
	 
			if (!isset($this->item))
			{
				$cache = JFactory::getCache('com_survey', '');
				$id = $this->getState('stepthree.id');
				$this->item =  $cache->get($id);
				if ($this->item === false) {
	 
				}
			}
			return $this->item;
	 
		}
	 
		public function save($data)
		{
			$id = $data['id'];
			$user = $this->getUserByCode($data['code']);
			if($id == 0 && ($user->id > 0)) {
				$db = $this->getDbo();
				$query = $db->getQuery(true);
				$query->insert($db->quoteName('#__survey_stepthree'))
					->columns(array(
						$db->quoteName('user_id'),
						$db->quoteName('why'),
						$db->quoteName('ip'),
						$db->quoteName('created')
					))
					->values(
						$user->id.', '.
						$db->quote($data['why']).', '.
						$db->quote($_SERVER['REMOTE_ADDR']).', '.
						$db->quote(date('Y-m-d H:i:s'))
					);
				$db->setQuery($query);
				try {
					$db->execute();
				}catch (RuntimeException $e) {
					JError::raiseWarning(500, $e->getMessage());
					return false;
				}				

				// add user group
				$user->funnel_step = 3;
				$user->log .= date('m/d/Y H:i:s')." - Completed survey #3;\n";
				// Save the user to the database.
				if (!$user->save(true))
				{
					return new JException(JText::sprintf('COM_USERS_USER_SAVE_FAILED', $user->getError()), 500);
				}else {
					//$app = JFactory::getApplication('site');
					//$app->redirect(JRoute::_(JURI::root().'course/lesson2/part1'));
				}
			}else {
				return new JException(JText::sprintf('COM_USERS_USER_SAVE_FAILED', 'Error'), 500);
			}
			
			
		}

	}