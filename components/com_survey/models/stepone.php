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
	class SurveyModelStepone extends JModelForm
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
			$form = $this->loadForm('com_survey.stepone', 'stepone', array('control' => 'jform', 'load_data' => true));
			if (empty($form)) {
				return false;
			}
			return $form;
	 
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
				$id = $this->getState('stepone.id');
				$this->item =  $cache->get($id);
				if ($this->item === false) {
	 
				}
			}
			return $this->item;
	 
		}
	 
		public function save($data)
		{
			$id = $data['id'];
			if($id == 0) {
				$db = $this->getDbo();
				$query = $db->getQuery(true);
				$query->insert($db->quoteName('#__survey_stepone'))
					->columns(array(
						$db->quoteName('first_name'),
						$db->quoteName('last_name'),
						$db->quoteName('years_in_usa'),
						$db->quoteName('job'),
						$db->quoteName('education'),
						$db->quoteName('english_level'),
						$db->quoteName('why'),
						$db->quoteName('what'),
						$db->quoteName('sex'),
						$db->quoteName('age'),
						$db->quoteName('email'),
						$db->quoteName('ip'),
						$db->quoteName('created')
					))
					->values(
						$db->quote($data['first_name']).', '.
						$db->quote($data['last_name']).', '.
						(int)$data['years_in_usa'].', '.
						$db->quote($data['job']).', '.
						(int)$data['education'].', '.
						(int)$data['english_level'].', '.
						$db->quote($data['why']).', '.
						$db->quote($data['what']).', '.
						$db->quote($data['sex']).', '.
						$db->quote($data['age']).', '.
						$db->quote($data['email']).', '.
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
			}
		}
			
	}