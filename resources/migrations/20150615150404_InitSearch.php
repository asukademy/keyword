<?php
/**
 * Part of Windwalker project.
 *
 * @copyright  Copyright (C) 2014 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

use Windwalker\Core\Migration\AbstractMigration;
use Windwalker\Database\Schema\Column;
use Windwalker\Database\Schema\Key;

/**
 * Migration class, version: 20150615150404
 */
class InitSearch extends AbstractMigration
{
	/**
	 * Migrate Up.
	 */
	public function up()
	{
		$this->db->getTable('results')
			->addColumn(new Column\Primary('id'))
			->addColumn(new Column\Varchar('url'))
			->addColumn(new Column\Varchar('keyword'))
			->addColumn(new Column\Integer('google'))
			->addColumn(new Column\Integer('yahoo'))
			->addIndex(Key::TYPE_INDEX, 'url_keyword', array('url', 'keyword'))
			->save();
	}

	/**
	 * Migrate Down.
	 */
	public function down()
	{
		$this->db->getTable('results')->drop();
	}
}
