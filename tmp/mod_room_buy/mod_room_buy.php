<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  mod_room_buy
 *
 * @copyright   Copyright (C) 2012 - 2016 WhiteOf, Corp. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

// Include the syndicate functions only once
require_once __DIR__ . '/helper.php';

$items = ModRoomBuyHelper::getItems();

require JModuleHelper::getLayoutPath('mod_room_buy', $params->get('layout', 'default'));
