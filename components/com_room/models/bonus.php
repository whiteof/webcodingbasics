<?php

	// No direct access to this file
	defined('_JEXEC') or die('Restricted access');
	 
	// import Joomla modelitem library
	jimport('joomla.application.component.modelitem');
	// Include dependancy of the dispatcher
	jimport('joomla.event.dispatcher');
	 
	/**
	 * Stepone Model
	 */
	class RoomModelBonus extends JModelLegacy
	{
		/**
		 * @var object item
		 */
		protected $item;
		
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
			if (empty($user)) JError::raiseError(404, JText::_('COM_ROOM_USER_NOT_FOUND'));
			$user = JFactory::getUser($user->id);
			if(!in_array("12", $user->groups)) JError::raiseError(404, JText::_('COM_ROOM_USER_NOT_FOUND'));
            return $user;		
		}
		
	}