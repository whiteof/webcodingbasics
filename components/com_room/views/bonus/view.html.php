<?php
	
	// No direct access to this file
	defined('_JEXEC') or die('Restricted access');
	 
	// import Joomla view library
	jimport('joomla.application.component.view');
	 
	/**
	 * HTML View class for the Stepone Component
	 */
	class RoomViewBonus extends JViewLegacy
	{
		// Overwriting JView display method
		function display($tpl = null) 
		{
			// Get some data from the models
			$this->user	= $this->get('User');
	 
			// Check for errors.
			if (count($errors = $this->get('Errors'))) 
			{
				JError::raiseError(500, implode('<br />', $errors));
				return false;
			}
			// Display the view
			parent::display($tpl);
		}
	}