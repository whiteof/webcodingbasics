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
			$data = array(
				"name"=>$post_data['first_name'].' '.$post_data['last_name'],
				"username"=>$post_data['email'],
				"password"=>'456123',
				"password2"=>'456123',
				"email"=>$post_data['email'],
				"block"=>0,
				"groups"=>array ('2')
			);
			$user = new JUser;
			if(!$user->bind($data)) {
				throw new Exception("Could not bind data. Error: " . $user->getError());
			}
			if (!$user->save()) {
				throw new Exception("Could not save user. Error: " . $user->getError());
			}
			
			// Add first lesson to the user
			$model->addLesson($user->id);
			
			return true;
		}
	 
	}
