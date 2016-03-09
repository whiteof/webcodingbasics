<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_survey
 *
 * @copyright   Copyright (C) 2012 - 2013 WhiteOf, Corp. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */


defined('_JEXEC') or die;

JTable::addIncludePath(JPATH_COMPONENT_ADMINISTRATOR . '/tables');

$controller	= JControllerLegacy::getInstance('Survey');

$controller->execute(JFactory::getApplication()->input->get('task'));
$controller->redirect();
