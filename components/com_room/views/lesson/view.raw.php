<?php
	
	// No direct access to this file
	defined('_JEXEC') or die('Restricted access');
	
	class RoomViewLesson extends JViewLegacy
	{
        
		function display($tpl = null) 
		{
			$lesson = JRequest::getVar('download');
			if(!empty($lesson)) {
				if($this->get('Download')) {
					$path='/var/www/html/files.webcodingbasics.com/lessons/'.$lesson.'.zip';
					header('Content-type: application/octet-stream');
					header('Content-Disposition: attachment; filename="'.$lesson.'.zip"');
					header('Content-Length: '.filesize($path));
					readfile($path);
					exit;
				}
			}
			return false;
		}
	}