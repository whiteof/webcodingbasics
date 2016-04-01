<?php
	
	// No direct access.
	defined('_JEXEC') or die;
	 
	// Include dependancy of the main controllerform class
	jimport('joomla.application.component.controllerform');
	
	jimport( 'joomla.user.helper');
	 
	class SurveyControllerSteptwo extends JControllerForm
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
			$model	= $this->getModel('steptwo');
	 
			$post_data = $app->input->post->getArray();
			$model->save($post_data);
			  
			// Create new user
			
			// Add first lesson to the user
			$model->addLesson($user->id);
			
			return true;
		}
	 
	}
