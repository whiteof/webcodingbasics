<?php

	// No direct access to this file
	defined('_JEXEC') or die('Restricted access');
	 	 
	/**
	 * Course Model
	 */
	class RoomModelVideo extends JModelLegacy
	{
		/**
		 * @var object item
		 */
		protected $lessons;
	 	 
		function getLessons()
		{
			$user = JFactory::getUser();
			
			$db = $this->getDbo();
			$query = $db->getQuery(true)->select('a.*')->from('#__lesson AS a');
			$query->select('b.user_id')->join('LEFT', '#__user_lesson AS b on a.id = b.lesson_id AND b.user_id = '.$user->id);
			$db->setQuery($query);
			$lessons = $db->loadObjectList();
			if (empty($lessons))
			{
				JError::raiseError(404, JText::_('COM_ROOM_LESSONS_NOT_FOUND'));
			}
			return $lessons;
		}

	}