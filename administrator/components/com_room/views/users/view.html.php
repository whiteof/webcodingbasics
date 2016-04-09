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
 * View class for a list of users.
 *
 * @package     Joomla.Administrator
 * @subpackage  com_room
 * @since       1.6
 */
class RoomViewUsers extends JViewLegacy
{
	protected $items;

	protected $pagination;

	protected $state;

	/**
	 * Display the view
	 */
	public function display($tpl = null)
	{
		$this->items		= $this->get('Items');
		$this->pagination	= $this->get('Pagination');
		$this->state		= $this->get('State');

		RoomHelper::addSubmenu('users');

		// Check for errors.
		if (count($errors = $this->get('Errors')))
		{
			JError::raiseError(500, implode("\n", $errors));
			return false;
		}

		$this->addToolbar();
		$this->sidebar = JHtmlSidebar::render();
		parent::display($tpl);
	}

	/**
	 * Add the page title and toolbar.
	 *
	 * @since   1.6
	 */
	protected function addToolbar()
	{
		$state	= $this->get('State');
		$user	= JFactory::getUser();
		// Get the toolbar object instance
		$bar = JToolBar::getInstance('toolbar');
		JToolbarHelper::title(JText::_('COM_ROOM_MANAGER_USERS'), 'users.png');

		//JToolbarHelper::editList('user.edit');
		JToolbarHelper::custom('users.emailone', 'emailButton.png', 'emailButton.png', 'COM_ROOM_EMAILONE', true);
		JToolbarHelper::custom('users.emailtwo', 'emailButton.png', 'emailButton.png', 'COM_ROOM_EMAILTWO', true);
		JToolbarHelper::custom('users.emailvk', 'emailButton.png', 'emailButton.png', 'COM_ROOM_EMAILVK', true);
		
		JHtmlSidebar::setAction('index.php?option=com_room&view=users');
	}

	/**
	 * Returns an array of fields the table can be sorted by
	 *
	 * @return  array  Array containing the field name to sort by as the key and display text as value
	 *
	 * @since   3.0
	 */
	protected function getSortFields()
	{
		return array(
			'a.username' => JText::_('COM_ROOM_USERNAME'),
			'a.funel_step' => JText::_('COM_ROOM_FUNNEL_STEP')
		);
	}
}
