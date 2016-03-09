<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_room
 *
 * @copyright   Copyright (C) 2012 - 2013 WhiteOf, Corp. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */


defined('_JEXEC') or die;

/**
 * Room Component Controller
 *
 * @package     Joomla.Site
 * @subpackage  com_room
 * @since       1.5
 */
class RoomController extends JControllerLegacy
{
	/**
	 * Method to show a newsfeeds view
	 *
	 * @param   boolean			If true, the view output will be cached
	 * @param   array  An array of safe url parameters and their variable types, for valid values see {@link JFilterInput::clean()}.
	 *
	 * @return  JController		This object to support chaining.
	 * @since   1.5
	 */
	public function display($cachable = false, $urlparams = false)
	{
		
		$cachable = true;

		// Set the default view name and format from the Request.
		$vName = $this->input->get('view', 'stepone');
		$this->input->set('view', $vName);

		$user = JFactory::getUser();

		if ($user->get('id') || ($this->input->getMethod() == 'POST' && $vName = 'stepone' ))
		{
			$cachable = false;
		}

		parent::display($cachable, false);
	}
}
