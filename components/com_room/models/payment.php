<?php

	// No direct access to this file
	defined('_JEXEC') or die('Restricted access');
	 	 
	/**
	 * Course Model
	 */
	class RoomModelPayment extends JModelLegacy
	{
		public function getRandomstring() {
            $length = 5;
			$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
			$charactersLength = strlen($characters);
			$randomString = '';
			for ($i = 0; $i < $length; $i++) {
				$randomString .= $characters[rand(0, $charactersLength - 1)];
			}
			return $randomString;
		}
    }