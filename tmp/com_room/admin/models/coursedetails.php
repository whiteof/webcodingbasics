<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_room
 *
 * @copyright   Copyright (C) 2012 - 2013 WhiteOf, Corp. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

JLoader::register('RoomHelper', JPATH_ADMINISTRATOR . '/components/com_room/helpers/room.php');

/**
 * Newsfeed model.
 *
 * @package     Joomla.Administrator
 * @subpackage  com_room
 * @since       1.6
 */
class RoomModelProduct extends JModelAdmin
{
	/**
	 * @var        string    The prefix to use with controller messages.
	 * @since   1.6
	 */
	protected $text_prefix = 'COM_ROOM';

	/**
	 * Batch copy items to a new category or current.
	 *
	 * @param   integer  $value     The new category.
	 * @param   array    $pks       An array of row IDs.
	 * @param   array    $contexts  An array of item contexts.
	 *
	 * @return  mixed  An array of new IDs on success, boolean false on failure.
	 *
	 * @since   11.1
	 */
	protected function batchCopy($value, $pks, $contexts)
	{
		$categoryId = (int) $value;

		$table = $this->getTable();
		$i = 0;

		// Check that the category exists
		if ($categoryId)
		{
			$categoryTable = JTable::getInstance('Product');
			if (!$categoryTable->load($categoryId))
			{
				if ($error = $categoryTable->getError())
				{
					// Fatal error
					$this->setError($error);
					return false;
				}
				else
				{
					$this->setError(JText::_('JLIB_APPLICATION_ERROR_BATCH_MOVE_CATEGORY_NOT_FOUND'));
					return false;
				}
			}
		}

		if (empty($categoryId))
		{
			$this->setError(JText::_('JLIB_APPLICATION_ERROR_BATCH_MOVE_CATEGORY_NOT_FOUND'));
			return false;
		}

		// Check that the user has create permission for the component
		$user = JFactory::getUser();
		if (!$user->authorise('core.create', 'com_room.product.' . $categoryId))
		{
			$this->setError(JText::_('JLIB_APPLICATION_ERROR_BATCH_CANNOT_CREATE'));
			return false;
		}

		// Parent exists so we let's proceed
		while (!empty($pks))
		{
			// Pop the first ID off the stack
			$pk = array_shift($pks);

			$table->reset();

			// Check that the row actually exists
			if (!$table->load($pk))
			{
				if ($error = $table->getError())
				{
					// Fatal error
					$this->setError($error);
					return false;
				}
				else
				{
					// Not fatal error
					$this->setError(JText::sprintf('JLIB_APPLICATION_ERROR_BATCH_MOVE_ROW_NOT_FOUND', $pk));
					continue;
				}
			}

			// Alter the title & alias
			$data = $this->generateNewTitle($categoryId, $table->title);
			$table->title = $data['0'];

			// Reset the ID because we are making a copy
			$table->id = 0;

			// New category ID
			$table->catid = $categoryId;

			// TODO: Deal with ordering?
			//$table->ordering	= 1;

			// Check the row.
			if (!$table->check())
			{
				$this->setError($table->getError());
				return false;
			}

			// Store the row.
			if (!$table->store())
			{
				$this->setError($table->getError());
				return false;
			}

			// Get the new item ID
			$newId = $table->get('id');

			// Add the new ID to the array
			$newIds[$i] = $newId;
			$i++;
		}

		// Clean the cache
		$this->cleanCache();

		return $newIds;
	}

	/**
	 * Method to test whether a record can be deleted.
	 *
	 * @param   object    A record object.
	 * @return  boolean  True if allowed to delete the record. Defaults to the permission set in the component.
	 * @since   1.6
	 */
	/*
	protected function canDelete($record)
	{
		if (!empty($record->id))
		{
			if ($record->published != -2)
			{
				return;
			}
			$user = JFactory::getUser();

			if (!empty($record->catid))
			{
				return $user->authorise('core.delete', 'com_room.product.' . (int) $record->category_id);
			}
			else
			{
				return parent::canDelete($record);
			}
		}
	}
*/
	/**
	 * Method to test whether a record can have its state changed.
	 *
	 * @param   object    A record object.
	 * @return  boolean  True if allowed to change the state of the record. Defaults to the permission set in the component.
	 * @since   1.6
	 */
	protected function canEditState($record)
	{
		$user = JFactory::getUser();

		if (!empty($record->catid))
		{
			return $user->authorise('core.edit.state', 'com_room.product.' . (int) $record->catid);
		}
		else
		{
			return parent::canEditState($record);
		}
	}

	/**
	 * Returns a Table object, always creating it.
	 *
	 * @param   type      The table type to instantiate
	 * @param   string    A prefix for the table class name. Optional.
	 * @param   array     Configuration array for model. Optional.
	 * @return  JTable    A database object
	 */
	public function getTable($type = 'Product', $prefix = 'RoomTable', $config = array())
	{
		return JTable::getInstance($type, $prefix, $config);
	}

	/**
	 * Method to get the record form.
	 *
	 * @param   array      $data        Data for the form.
	 * @param   boolean    $loadData    True if the form is to load its own data (default case), false if not.
	 * @return  JForm    A JForm object on success, false on failure
	 * @since   1.6
	 */
	public function getForm($data = array(), $loadData = true)
	{
		// Get the form.
		$form = $this->loadForm('com_room.product', 'product', array('control' => 'jform', 'load_data' => $loadData));
		if (empty($form))
		{
			return false;
		}

		// Determine correct permissions to check.
		if ($this->getState('product.id'))
		{
			// Existing record. Can only edit in selected categories.
			$form->setFieldAttribute('catid', 'action', 'core.edit');
		}
		else
		{
			// New record. Can only create in selected categories.
			$form->setFieldAttribute('catid', 'action', 'core.create');
		}

		// Modify the form based on access controls.
		if (!$this->canEditState((object) $data))
		{
			// Disable fields for display.
			$form->setFieldAttribute('ordering', 'disabled', 'true');
			$form->setFieldAttribute('published', 'disabled', 'true');
			$form->setFieldAttribute('publish_up', 'disabled', 'true');
			$form->setFieldAttribute('publish_down', 'disabled', 'true');

			// Disable fields while saving.
			// The controller has already verified this is a record you can edit.
			$form->setFieldAttribute('ordering', 'filter', 'unset');
			$form->setFieldAttribute('published', 'filter', 'unset');
			$form->setFieldAttribute('publish_up', 'filter', 'unset');
			$form->setFieldAttribute('publish_down', 'filter', 'unset');
		}

		return $form;
	}

	/**
	 * Method to get the data that should be injected in the form.
	 *
	 * @return  mixed  The data for the form.
	 * @since   1.6
	 */
	protected function loadFormData()
	{
		// Check the session for previously entered form data.
		$data = JFactory::getApplication()->getUserState('com_room.edit.product.data', array());

		if (empty($data))
		{
			$data = $this->getItem();

			// Prime some default values.
			if ($this->getState('product.id') == 0)
			{
				$app = JFactory::getApplication();
				$data->set('catid', $app->input->get('catid', $app->getUserState('com_room.products.filter.category_id'), 'int'));
			}
		}

		$this->preprocessData('com_room.product', $data);

		return $data;
	}
	
	public function getCategories()
	{
		$db = $this->getDbo();
		$query = $db->getQuery(true);
		$query->select('MAX(level) as max_l')->from('#__room_categories');
		$db->setQuery($query);
		$rows = $db->loadObjectList();
		$max_l = $rows[0]->max_l;
		
		$query = $db->getQuery(true);

		$select = '';
		for($i = 1; $i <= $max_l; $i++) $select .= 't'.$i.'.id as id'.$i.', ';
		$select = substr($select, 0, -2);
		$query->select($select);
		$query->from('#__room_categories as t1');
		for($i = 2; $i <= $max_l; $i++) $query->join('LEFT', '#__room_categories AS t'.$i.' ON t'.($i-1).'.id = t'.$i.'.parent_id');
		$query->where('t1.parent_id = 0');
		$order = '';
		for($i = 1; $i <= $max_l; $i++) $order .= 't'.$i.'.ordering, ';
		$order = substr($order, 0, -2);		
		$query->order($order.' ASC');
		$db->setQuery($query);
		$items = $db->loadObjectList();
		
		foreach($items as $i => $field)
		{
			for($j = 1; $j <= $max_l; $j++)
			{
				eval('
					if($field->id'.$j.')
					{
						$menu[$field->id'.$j.'] = "";
					}
				');
			}
		}
		$items = array();
		foreach($menu as $id => $val)
		{
			$db = JFactory::getDbo();
			$db->setQuery('SELECT * FROM #__room_categories WHERE id = '.$id);
			$items[] = $db->loadObject();
		}
		return $items;
	}	

	/**
	 * Method to save the form data.
	 *
	 * @param   array  The form data.
	 *
	 * @return  boolean  True on success.
	 * @since    3.0
	 */
	public function save($data)
	{
		$app = JFactory::getApplication();

		// Alter the title for save as copy
		if ($app->input->get('task') == 'save2copy')
		{
			list($title) = $this->generateNewTitle($data['category_id'], $data['title']);
			$data['title'] = $title;
			$data['published'] = 0;
		}

		if (parent::save($data))
		{

			$assoc = isset($app->item_associations) ? $app->item_associations : 0;
			if ($assoc)
			{
				$id = (int) $this->getState($this->getName() . '.id');
				$item = $this->getItem($id);

				// Adding self to the association
				$associations = $data['associations'];

				foreach ($associations as $tag => $id)
				{
					if (empty($id))
					{
						unset($associations[$tag]);
					}
				}

				// Detecting all item menus
				$all_language = $item->language == '*';

				if ($all_language && !empty($associations))
				{
					JError::raiseNotice(403, JText::_('COM_ROOM_ERROR_ALL_LANGUAGE_ASSOCIATED'));
				}

				$associations[$item->language] = $item->id;

				// Deleting old association for these items
				$db = JFactory::getDbo();
				$query = $db->getQuery(true)
					->delete('#__associations')
					->where($db->quoteName('context') . ' = ' . $db->quote('com_room.item'))
					->where($db->quoteName('id') . ' IN (' . implode(',', $associations) . ')');
				$db->setQuery($query);
				$db->execute();

				if ($error = $db->getErrorMsg())
				{
					$this->setError($error);
					return false;
				}

				if (!$all_language && count($associations))
				{
					// Adding new association for these items
					$key = md5(json_encode($associations));
					$query->clear()
						->insert('#__associations');

					foreach ($associations as $tag => $id)
					{
						$query->values($id . ',' . $db->quote('com_room.item') . ',' . $db->quote($key));
					}

					$db->setQuery($query);
					$db->execute();

					if ($error = $db->getErrorMsg())
					{
						$this->setError($error);
						return false;
					}
				}
			}

			return true;
		}

		return false;
	}

	/**
	 * Method to get a single record.
	 *
	 * @param   integer    The id of the primary key.
	 *
	 * @return  mixed  Object on success, false on failure.
	 * @since   1.6
	 */
	public function getItem($pk = null)
	{
		/*
		if ($item = parent::getItem($pk))
		{
			// Convert the params field to an array.
			$registry = new JRegistry;
			$registry->loadString($item->metadata);
			$item->metadata = $registry->toArray();

			// Convert the images field to an array.
			$registry = new JRegistry;
			$registry->loadString($item->images);
			$item->images = $registry->toArray();
		}
		*/
		$item = parent::getItem($pk);
		// Load associated newsfeeds items
		$app = JFactory::getApplication();
		$assoc = isset($app->item_associations) ? $app->item_associations : 0;

		if ($assoc)
		{
			$item->associations = array();

			if ($item->id != null)
			{
				$associations = JLanguageAssociations::getAssociations('com_room', '#__room_products', 'com_room.item', $item->id);

				foreach ($associations as $tag => $association)
				{
					$item->associations[$tag] = $association->id;
				}
			}
		}
		if (!empty($item->id))
		{
			$item->tags = new JHelperTags;
			$item->tags->getTagIds($item->id, 'com_room.product');
			$item->metadata['tags'] = $item->tags;
		}

		return $item;
	}

	/**
	 * Prepare and sanitise the table prior to saving.
	 */
	protected function prepareTable($table)
	{
		$date = JFactory::getDate();
		$user = JFactory::getUser();

		$table->title = htmlspecialchars_decode($table->title, ENT_QUOTES);


		if (empty($table->id))
		{
			// Set the values
			$table->created = $date->toSql();
			$table->published = 1;
		}
		else
		{
			// Set the values
			$table->modified = $date->toSql();
			$table->modified_by = $user->get('id');
		}

	}

	/**
	 * Method to change the published state of one or more records.
	 *
	 * @param   array    $pks      A list of the primary keys to change.
	 * @param   integer  $value    The value of the published state.
	 *
	 * @return  boolean  True on success.
	 * @since   1.6
	 */
	public function publish(&$pks, $value = 1)
	{
		$result = parent::publish($pks, $value);

		// Clean extra cache for newsfeeds
		$this->cleanCache('feed_parser');

		return $result;
	}

	/**
	 * A protected method to get a set of ordering conditions.
	 *
	 * @param   object    A record object.
	 * @return  array  An array of conditions to add to add to ordering queries.
	 * @since   1.6
	 */
	protected function getReorderConditions($table)
	{
		$condition = array();
		$condition[] = 'category_id = ' . (int) $table->category_id;
		return $condition;
	}

	protected function preprocessForm(JForm $form, $data, $group = 'content')
	{
		// Association newsfeeds items
		$app = JFactory::getApplication();
		$assoc = isset($app->item_associations) ? $app->item_associations : 0;
		if ($assoc)
		{
			$languages = JLanguageHelper::getLanguages('lang_code');

			// force to array (perhaps move to $this->loadFormData())
			$data = (array) $data;

			$addform = new SimpleXMLElement('<form />');
			$fields = $addform->addChild('fields');
			$fields->addAttribute('title', 'associations');
			$fieldset = $fields->addChild('fieldset');
			$fieldset->addAttribute('title', 'item_associations');
			$fieldset->addAttribute('description', 'COM_ROOM_ITEM_ASSOCIATIONS_FIELDSET_DESC');
			$add = false;
			foreach ($languages as $tag => $language)
			{
				if (empty($data['language']) || $tag != $data['language'])
				{
					$add = true;
					$field = $fieldset->addChild('field');
					$field->addAttribute('title', $tag);
					$field->addAttribute('type', 'modal_room');
					$field->addAttribute('language', $tag);
					$field->addAttribute('label', $language->title);
					$field->addAttribute('translate_label', 'false');
				}
			}
			if ($add)
			{
				$form->load($addform, false);
			}
		}

		parent::preprocessForm($form, $data, $group);
	}

	/**
	 * Method to change the title & alias.
	 *
	 * @param   integer  $parent_id  The id of the parent.
	 * @param   string   $alias      The alias.
	 * @param   string   $title      The title.
	 *
	 * @return  array  Contains the modified title and alias.
	 *
	 * @since   3.1
	 */
	protected function generateNewTitle($category_id, $alias, $name)
	{
		// Alter the title & alias
		$table = $this->getTable();
		while ($table->load(array('alias' => $alias, 'catid' => $category_id)))
		{
			if ($name == $table->name)
			{
				$name = JString::increment($name);
			}
			$alias = JString::increment($alias, 'dash');
		}

		return array($name, $alias);
	}
}
