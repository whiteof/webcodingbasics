<?php
	
	// No direct access to this file
	defined('_JEXEC') or die('Restricted access');
	 
	class RoomViewCourse extends JViewLegacy
	{
        
		function display($tpl = null) 
		{
            $path='/var/www/html/video.webcodingbasics.com/intro.mp4';

			header('Content-type: video/mp4');    
			header('Content-Length: '.filesize($path)); // provide file size    
			readfile($path);
			exit;

		}
	}