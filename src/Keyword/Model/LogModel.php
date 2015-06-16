<?php
/**
 * Part of keyword project. 
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Keyword\Model;

use Keyword\Table\Table;
use Windwalker\Core\Model\DatabaseModel;
use Windwalker\Data\Data;

/**
 * The LogModel class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class LogModel extends DatabaseModel
{
	/**
	 * save
	 *
	 * @param Data $data
	 *
	 * @return  void
	 */
	public function save(Data $data)
	{
		$this->db->getWriter()->insertOne(Table::LOGS, $data, 'id');
	}
}
