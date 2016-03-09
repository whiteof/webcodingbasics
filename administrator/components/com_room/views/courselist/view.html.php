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
 * View class for a list of products.
 *
 * @package     Joomla.Administrator
 * @subpackage  com_room
 * @since       1.6
 */
class RoomViewProducts extends JViewLegacy
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

		RoomHelper::addSubmenu('products');

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
		JToolbarHelper::title(JText::_('COM_ROOM_MANAGER_PRODUCTS'), 'products.png');

			JToolbarHelper::addNew('product.add');

			JToolbarHelper::editList('product.edit');
			JToolbarHelper::publish('products.publish', 'JTOOLBAR_PUBLISH', true);
			JToolbarHelper::unpublish('products.unpublish', 'JTOOLBAR_UNPUBLISH', true);
			//JToolbarHelper::archiveList('products.archive');
			//JToolbarHelper::checkin('products.checkin');
		//if ($state->get('filter.published') == -2)
		//{
			JToolbarHelper::deleteList('', 'products.delete', 'JTOOLBAR_DELETE');
		//} else
		//{
		//	JToolbarHelper::trash('categories.trash');
		//}
			//JToolbarHelper::preferences('com_room');
		//JToolbarHelper::help('JHELP_COMPONENTS_ROOM_PRODUCTS');

		JHtmlSidebar::setAction('index.php?option=com_room&view=products');
/*
		JHtmlSidebar::addFilter(
			JText::_('JOPTION_SELECT_PUBLISHED'),
			'filter_published',
			JHtml::_('select.options', JHtml::_('jgrid.publishedOptions'), 'value', 'text', $this->state->get('filter.published'), true)
		);

		JHtmlSidebar::addFilter(
			JText::_('JOPTION_SELECT_CATEGORY'),
			'filter_category_id',
			JHtml::_('select.options', JHtml::_('category.options', 'com_room'), 'value', 'text', $this->state->get('filter.category_id'))
		);
*/
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
			'a.published' => JText::_('JSTATUS'),
			'a.title' => JText::_('JGLOBAL_TITLE'),
			'a.description' => JText::_('COM_ROOM_DESCRIPTION'),
			'a.price' => JText::_('COM_ROOM_PRICE'),
			'b.title' => JText::_('COM_ROOM_CATEGORY'),
			'a.created' => JText::_('COM_ROOM_CREATED')
		);
	}
}
