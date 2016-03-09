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
			// set the variables from the passed data
			$id = $data['id'];
			$first_name = $data['first_name'];
	 
			// set the data into a query to update the record
			$db = $this->getDbo();
			$query = $db->getQuery(true);
			$query->clear();
			$query->update(' #__survey_stepone ');
			$query->set(' first_name = '.$db->Quote($first_name) );
			$query->where(' id = ' . (int) $id );
	 
			$db->setQuery((string)$query);
	 
			if (!$db->query()) {
				JError::raiseError(500, $db->getErrorMsg());
				return false;
			} else {
				return true;
			}
		}
	}