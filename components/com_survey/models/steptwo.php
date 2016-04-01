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
	class SurveyModelSteptwo extends JModelForm
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
			$form = $this->loadForm('com_survey.steptwo', 'steptwo', array('control' => 'jform', 'load_data' => true));
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
				$id = $this->getState('steptwo.id');
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
				$query->insert($db->quoteName('#__survey_steptwo'))
					->columns(array(
						$db->quoteName('user_id'),
						$db->quoteName('family_situation'),
						$db->quoteName('learn_for'),
						$db->quoteName('challenges'),
						$db->quoteName('expectations'),
						$db->quoteName('ip'),
						$db->quoteName('created')
					))
					->values(
						(int)$data['user_id'].', '.
						$db->quote($data['family_situation']).', '.
						(int)$data['learn_for'].', '.
						$db->quote($data['challenges']).', '.
						$db->quote($data['expectations']).', '.
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