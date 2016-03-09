<?php
	
   // No direct access.
   defined('_JEXEC') or die;
	
   // Include dependancy of the main controllerform class
   jimport('joomla.application.component.controllerform');
	
   class SurveyControllerStepone extends JControllerForm
   {
	
	   public function getModel($name = '', $prefix = '', $config = array('ignore_request' => true))
	   {
		   return parent::getModel($name, $prefix, array('ignore_request' => false));
	   }
	
	   public function submit()
	   {
		   // Check for request forgeries.
		   JRequest::checkToken() or jexit(JText::_('JINVALID_TOKEN'));
	
		   // Initialise variables.
		   $app	= JFactory::getApplication();
		   $model	= $this->getModel('stepone');
	
		   // Get the data from the form POST
		   $data = JRequest::getVar('jform', array(), 'post', 'array');
	
		   // Now update the loaded data to the database via a function in the model
		   $save = $model->save($data);
	
		   // check if ok and display appropriate message.  This can also have a redirect if desired.
		   if ($save) {
			   echo "<h2>Updated Greeting has been saved</h2>";
		   } else {
			   echo "<h2>Updated Greeting failed to be saved</h2>";
		   }
	
		   return true;
	   }
	
   }
