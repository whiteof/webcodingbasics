<?php

	// No direct access to this file
	defined('_JEXEC') or die('Restricted access');
	 	 
	/**
	 * Course Model
	 */
	class RoomModelLesson extends JModelLegacy
	{
		/**
		 * @var object item
		 */
		protected $lesson;
	 	 
		function getDownload()
		{
			$lesson = JRequest::getVar('download');
			if(!empty($lesson)) {
				$lessons_access = array(
					'lesson1' => 2,
					'lesson2' => 10,
					'lesson3' => 11,
					'lesson4' => 11,
					'lesson5' => 11,
					'lesson6' => 11
				);
				$user = JFactory::getUser();
				if(in_array($lessons_access[$lesson], $user->groups)) return true;
				else return false;
			}else return false;
		}

	}