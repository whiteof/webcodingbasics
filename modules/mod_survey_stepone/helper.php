<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  mod_survey_stepone
 *
 * @copyright   Copyright (C) 2012 - 2016 WhiteOf, Corp. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

/**
 * Helper for mod_survey_stepone
 *
 * @package     Joomla.Site
 * @subpackage  mod_survey_stepone
 * @since       1.5
 */
class ModSurveySteponeHelper
{
	public static function getItems()
	{
		$items = array();
		$db = JFactory::getDBO();
		$query = '
			SELECT *
			FROM #__survey_stepone
		';
		$db->setQuery($query);
		$items = $db->loadObjectList();
		return $items;
	}
}
