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
 * @package     Joomla.Administrator
 * @subpackage  com_survey
 */
class SurveyTableProduct extends JTable
{
	/**
	 * Helper object for storing and deleting tag information.
	 *
	 * @var    JHelperTags
	 * @since  3.1
	 */
	protected $tagsHelper = null;

	/**
	 * Constructor
	 *
	 * @param JDatabaseDriver A database connector object
	 */
	public function __construct(&$db)
	{
		parent::__construct('#__survey_products', 'id', $db);
		$this->tagsHelper = new JHelperTags();
		$this->tagsHelper->typeAlias = 'com_survey.product';
	}

	/**
	 * Overloaded bind function to pre-process the params.
	 *
	 * @param   array  Named array
	 * @return  null|string	null is operation was satisfactory, otherwise returns an error
	 * @see     JTable:bind
	 * @since   1.5
	 */
	public function bind($array, $ignore = '')
	{
		if (isset($array['params']) && is_array($array['params']))
		{
			$registry = new JRegistry;
			$registry->loadArray($array['params']);
			$array['params'] = (string) $registry;
		}

		if (isset($array['metadata']) && is_array($array['metadata']))
		{
			$registry = new JRegistry;
			$registry->loadArray($array['metadata']);
			$array['metadata'] = (string) $registry;
		}

		if (isset($array['images']) && is_array($array['images']))
		{
			$registry = new JRegistry;
			$registry->loadArray($array['images']);
			$array['images'] = (string) $registry;
		}

		return parent::bind($array, $ignore);
	}

	/**
	 * Overloaded check method to ensure data integrity.
	 *
	 * @return  boolean  True on success.
	 */
	public function check()
	{
		// Check for valid name.
		if (trim($this->title) == '')
		{
			$this->setError(JText::_('COM_SURVEY_WARNING_PROVIDE_VALID_NAME'));
			return false;
		}


		// clean up keywords -- eliminate extra spaces between phrases
		// and cr (\r) and lf (\n) characters from string
		if (!empty($this->metakey))
		{
			// only process if not empty
			$bad_characters = array("\n", "\r", "\"", "<", ">"); // array of characters to remove
			$after_clean = JString::str_ireplace($bad_characters, "", $this->metakey); // remove bad characters
			$keys = explode(',', $after_clean); // create array using commas as delimiter
			$clean_keys = array();

			foreach ($keys as $key)
			{
				if (trim($key)) {  // ignore blank keywords
					$clean_keys[] = trim($key);
				}
			}
			$this->metakey = implode(", ", $clean_keys); // put array back together delimited by ", "
		}

		// clean up description -- eliminate quotes and <> brackets
		if (!empty($this->metadesc))
		{
			// only process if not empty
			$bad_characters = array("\"", "<", ">");
			$this->metadesc = JString::str_ireplace($bad_characters, "", $this->metadesc);
		}

		return true;
	}

	/**
	 * Override parent delete method to delete tags information.
	 *
	 * @param   integer  $pk  Primary key to delete.
	 *
	 * @return  boolean  True on success.
	 *
	 * @since   3.1
	 * @throws  UnexpectedValueException
	 */
	public function delete($pk = null)
	{
		$result = parent::delete($pk);
		$this->tagsHelper->typeAlias = 'com_survey.product';
		return $result && $this->tagsHelper->deleteTagData($this, $pk);
	}

	/**
	 * Overriden JTable::store to set modified data.
	 *
	 * @param   boolean	True to update fields even if they are null.
	 * @return  boolean  True on success.
	 * @since   1.6
	 */
	public function store($updateNulls = false)
	{
		$date	= JFactory::getDate();
		$user	= JFactory::getUser();
		if ($this->id)
		{
			// Existing item
			$this->modified		= $date->toSql();
			$this->modified_by	= $user->get('id');
		}
		else
		{
			// New newsfeed. A feed created and created_by field can be set by the user,
			// so we don't touch either of these if they are set.
			if (!(int) $this->created)
			{
				$this->created = $date->toSql();
			}
			if (empty($this->created_by))
			{
				$this->created_by = $user->get('id');
			}
		}
		/*
		// Verify that the alias is unique
		$table = JTable::getInstance('Product', 'SurveyTable');
		if ($table->load(array('category_id' => $this->category_id)) && ($table->id != $this->id || $this->id == 0))
		{
			$this->setError(JText::_('COM_SURVEY_ERROR_UNIQUE_ALIAS'));
			return false;
		}
		*/
		$this->tagsHelper->typeAlias = 'com_survey.product';
		$this->tagsHelper->preStoreProcess($this);
		$result = parent::store($updateNulls);

		return $result && $this->tagsHelper->postStoreProcess($this);
	}

}
