<?php
/**
 * Part of Windwalker project.
 *
 * @copyright  Copyright (C) 2014 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

use Keyword\Table\Table;
use Windwalker\Core\Migration\AbstractMigration;
use Windwalker\Database\Schema\Column;
use Windwalker\Database\Schema\Key;

/**
 * Migration class, version: 20150616132809
 */
class AddLogs extends AbstractMigration
{
	/**
	 * Migrate Up.
	 */
	public function up()
	{
		$this->db->getTable(Table::RESULTS, true)
			->addColumn(new Column\Integer('pagerank'))
			->addColumn(new Column\Datetime('created'))
			->addColumn(new Column\Datetime('last_search'))
			->addColumn(new Column\Integer('searches'))
			->addColumn(new Column\Integer('hits'))
			->update();

		$this->db->getTable(Table::LOGS, true)
			->addColumn(new Column\Primary('id'))
			->addColumn(new Column\Datetime('time'))
			->addColumn(new Column\Varchar('url'))
			->addColumn(new Column\Varchar('keyword'))
			->addColumn(new Column\Integer('google'))
			->addColumn(new Column\Integer('yahoo'))
			->addColumn(new Column\Integer('pagerank'))
			->addColumn(new Column\Char('ipv4', 16))
			->addColumn(new Column\Char('ipv6', 45))
			->addIndex(Key::TYPE_INDEX, 'url_keyword', ['url', 'keyword'])
			->addIndex(Key::TYPE_INDEX, 'time', 'time')
			->create();
	}

	/**
	 * Migrate Down.
	 */
	public function down()
	{
		$this->db->getTable(Table::RESULTS, true)
			->dropColumn('pagerank')
			->dropColumn('created')
			->dropColumn('last_search')
			->dropColumn('searches')
			->dropColumn('hits');

		$this->db->getTable(Table::LOGS, true)->drop();
	}
}
