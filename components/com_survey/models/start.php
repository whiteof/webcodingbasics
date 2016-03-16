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
	 * Start Model
	 */
	class SurveyModelStart extends JModelForm
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
			$form = $this->loadForm('com_survey.start', 'start', array('control' => 'jform', 'load_data' => true));
			if (empty($form)) {
				return false;
			}
			return $form;
	 
		}
	 
		/**
		 * Get the message
		 * @return object The message to be displayed to the user
		 */
		public function getItem()
		{
	 
			if (!isset($this->item))
			{
				$cache = JFactory::getCache('com_survey', '');
				$id = $this->getState('start.id');
				$this->item =  $cache->get($id);
				if ($this->item === false) {
	 
				}
			}
			return $this->item;
	 
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
            if($user->funnel_step < 1) {
                return $user;
            }else {
                $app = JFactory::getApplication();
                //$app->login(array('username' => $user->username, 'password' => $user->code));
                $app->redirect(JRoute::_(JURI::root().'course/lesson10'));
				
            }
		}
		
		public function save($data)
		{
			$code = $data['code'];
			
			// Get the form.
			$form = $this->getForm();
	
			// Check for an error.
			if ($form instanceof Exception)
			{
				return $form;
			}
		
			// Filter and validate the form data.
			$data = $form->filter($data);
			$return = $form->validate($data);

			// Check for an error.
			if ($return instanceof Exception)
			{
				return $return;
			}
			
			// Check the validation results.
			if ($return === false)
			{
				// Get the validation messages from the form.
				foreach ($form->getErrors() as $formError)
				{
					$this->setError($formError->getMessage());
				}
				return false;
			}
			
			// Get the token and user id from the confirmation process.
			$app = JFactory::getApplication();


			// Get the user object.
			$user = $this->getUserByCode($code);

			// Check if the user is reusing the current password if required to reset their password
			if (JUserHelper::verifyPassword($data['password1'], $user->password))
			{
				$this->setError(JText::_('JLIB_USER_ERROR_CANNOT_REUSE_PASSWORD'));
				return false;
			}

			// Update the user object.
			$user->password = JUserHelper::hashPassword($data['password1']);
			//$user->activation = '';
			$user->password_clear = $data['password1'];
			$user->funnel_step = 1;
			
			// Save the user to the database.
			if (!$user->save(true))
			{
				return new JException(JText::sprintf('COM_USERS_USER_SAVE_FAILED', $user->getError()), 500);
			}
			
			return true;

		}
	 
	}