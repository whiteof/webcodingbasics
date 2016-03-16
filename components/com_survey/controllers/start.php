<?php

// No direct access.
defined('_JEXEC') or die;
 
// Include dependancy of the main controllerform class
jimport('joomla.application.component.controllerform');

jimport( 'joomla.user.helper');
 
class SurveyControllerStart extends JControllerForm
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
        $model	= $this->getModel('start');
        $data  = $this->input->post->get('jform', array(), 'array');
        if($model->save($data)) {
            $user = $model->getUserByCode($data['code']);
            $app = JFactory::getApplication();
            $app->login(array('username' => $user->username, 'password' => $data['password1']));
            $this->setRedirect(JRoute::_('/course/lesson1/part1', true));
        }else {
            $message = JText::sprintf('COM_USERS_FIELD_RESET_PASSWORD1_MESSAGE');
            $this->setRedirect(JRoute::_('/course-start?code='.$data['code'], false), $message, 'error');
        }
        return true;
    }
    
 
}
