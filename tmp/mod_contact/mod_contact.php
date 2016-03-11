<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  mod_survey_stepone
 *
 * @copyright   Copyright (C) 2012 - 2016 WhiteOf, Corp. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

// Include the syndicate functions only once
require_once __DIR__ . '/helper.php';

$form = new JForm('MyForm');
$form->loadFile(JPATH_ROOT.'/components/com_contact/models/forms/contact.xml');

require JModuleHelper::getLayoutPath('mod_contact', $params->get('layout', 'default'));
