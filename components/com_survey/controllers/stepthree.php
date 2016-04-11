<?php
	
	// No direct access.
	defined('_JEXEC') or die;
	 
	// Include dependancy of the main controllerform class
	jimport('joomla.application.component.controllerform');
	
	jimport( 'joomla.user.helper');
	 
	class SurveyControllerStepthree extends JControllerForm
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
			$model	= $this->getModel('stepthree');
	 
			$post_data = $app->input->post->getArray();
			$model->save($post_data['jform']);
			  			
			echo '
				<h3 style="color: #c94a4a; text-align: center;">Спасибо за обратную связь!</h3>
				<p align="center">
					<a href="'.JRoute::_(JURI::root()).'">Перейти на главную страницу</p>
				</p>
			';
			
			return true;
		}
	 
	}
