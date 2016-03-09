<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_survey
 *
 * @copyright   Copyright (C) 2012 - 2013 WhiteOf, Corp. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

/**
 * Survey component helper.
 *
 * @package     Joomla.Administrator
 * @subpackage  com_survey
 * @since       1.6
 */
class SurveyHelper
{
	public static $extension = 'com_survey';

	/**
	 * Configure the Linkbar.
	 *
	 * @param   string	The name of the active view.
	 */
	public static function addSubmenu($vName)
	{
		JHtmlSidebar::addEntry(
			JText::_('COM_SURVEY_SUBMENU_CATEGORIES'),
			'index.php?option=com_survey&view=categories',
			$vName == 'categories'
		);
		JHtmlSidebar::addEntry(
			JText::_('COM_SURVEY_SUBMENU_PRODUCTS'),
			'index.php?option=com_survey&view=products',
			$vName == 'products'
		);
	}

	/**
	 * Gets a list of the actions that can be performed.
	 *
	 * @param   integer  The category ID.
	 *
	 * @return  JObject
	 */
	public static function getActions($categoryId = 0, $productId = 0)
	{
		$user	= JFactory::getUser();
		$result	= new JObject;

		if (empty($categoryId))
		{
			$assetName = 'com_survey';
			$level = 'component';
		}
		else
		{
			$assetName = 'com_survey.category.'.(int) $categoryId;
			$level = 'category';
		}

		$actions = JAccess::getActions('com_survey', $level);

		foreach ($actions as $action)
		{
			$result->set($action->name,	$user->authorise($action->name, $assetName));
		}

		return $result;
	}
}
