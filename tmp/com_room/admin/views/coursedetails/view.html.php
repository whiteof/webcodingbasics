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
 * View to edit a product.
 *
 * @package     Joomla.Administrator
 * @subpackage  com_room
 * @since       1.6
 */
class RoomViewProduct extends JViewLegacy
{
	protected $item;

	protected $form;

	protected $state;

	/**
	 * Display the view
	 */
	public function display($tpl = null)
	{
				

		$this->state	= $this->get('State');
		$this->item	= $this->get('Item');
		$this->form	= $this->get('Form');
		$this->categories	= $this->get('Categories');

		// Check for errors.
		if (count($errors = $this->get('Errors')))
		{
			JError::raiseError(500, implode("\n", $errors));
			return false;
		}

		$this->addToolbar();
		
		parent::display($tpl);
	}

	/**
	 * Add the page title and toolbar.
	 *
	 * @since   1.6
	 */
	protected function addToolbar()
	{
		JFactory::getApplication()->input->set('hidemainmenu', true);

		$user		= JFactory::getUser();
		$userId		= $user->get('id');
		$isNew		= ($this->item->id == 0);
		//$checkedOut	= !($this->item->checked_out == 0 || $this->item->checked_out == $user->get('id'));
		// Since we don't track these assets at the item level, use the category id.
		//$canDo		= RoomHelper::getActions($this->item->catid, 0);

		JToolbarHelper::title(JText::_('COM_ROOM_MANAGER_PRODUCT'), 'products.png');

		// If not checked out, can save the item.
		//if (!$checkedOut && ($canDo->get('core.edit') || count($user->getAuthorisedCategories('com_room', 'core.create')) > 0))
		//{
			JToolbarHelper::apply('product.apply');
			JToolbarHelper::save('product.save');
		//}
		//if (!$checkedOut && count($user->getAuthorisedCategories('com_room', 'core.create')) > 0){
			JToolbarHelper::save2new('product.save2new');
		//}
		// If an existing item, can save to a copy.
		//if (!$isNew && $canDo->get('core.create'))
		//{
			JToolbarHelper::save2copy('product.save2copy');
		//}

		if (empty($this->item->id))
		{
			JToolbarHelper::cancel('product.cancel');
		}
		else
		{
			JToolbarHelper::cancel('product.cancel', 'JTOOLBAR_CLOSE');
		}

		JToolbarHelper::divider();
		JToolbarHelper::help('JHELP_COMPONENTS_ROOM_PRODUCTS_EDIT');
	}
}
