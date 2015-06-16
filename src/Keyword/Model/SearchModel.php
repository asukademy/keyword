<?php
/**
 * Part of keyword project. 
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Keyword\Model;

use Joomla\Http\HttpFactory;
use Keyword\Date\DateHelper;
use Keyword\Helper\Regular;
use Keyword\Table\Table;
use Windwalker\Core\Model\DatabaseModel;
use Windwalker\Core\Model\Model;
use Windwalker\Data\Data;
use Windwalker\DataMapper\DataMapper;
use Windwalker\Registry\Registry;

/**
 * The SearchModel class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class SearchModel extends DatabaseModel
{
	/**
	 * search
	 *
	 * @param string $url
	 * @param string $keyword
	 *
	 * @return  Data
	 */
	public function search($url, $keyword)
	{
		$this->init($url, $keyword);

		$servers = $this['servers'];

		$server = $servers[array_rand($servers)];

		$server = ltrim($server, '/') . '/fetch/' . Regular::encode(urlencode($url)) . '/' . urlencode($keyword);

		$http = HttpFactory::getHttp(array(), 'curl');

		$response = $http->get($server);

		if ($response->code != 200)
		{
			throw new \RuntimeException('Server no response.');
		}

		$result = new Registry($response->body);
		$mapper = new DataMapper('results');
		$data   = new Data;

		if (!$result['success'])
		{
			throw new \RuntimeException('Please try again');
		}

		$data->keyword = $keyword;
		$data->url     = $url;
		$data->google  = $result['data.google'];
		$data->yahoo   = $result['data.yahoo'];

		$mapper->updateOne($data, ['url', 'keyword']);

		return $data;
	}

	/**
	 * init
	 *
	 * @param string $url
	 * @param string $keyword
	 *
	 * @return  bool
	 */
	public function init($url, $keyword)
	{
		$mapper = new DataMapper('results');

		if ($mapper->findOne(['keyword' => $keyword, 'url' => $url])->notNull())
		{
			return true;
		}

		$data = ['keyword' => $keyword, 'url' => $url];

		$data['created'] = (new \DateTime('now', DateHelper::getTaipeiZone()))->format('Y-m-d H:i:s');

		$mapper->createOne($data);

		return true;
	}

	/**
	 * addSearchTimes
	 *
	 * @param string $url
	 * @param string $keyword
	 *
	 * @return  bool
	 */
	public function addSearchTimes($url, $keyword)
	{
		$query = $this->db->getQuery(true);

		$date = (new \DateTime('now', DateHelper::getTaipeiZone()))->format(DateHelper::FORMAT_SQL);

		$query->update(Table::RESULTS)
			->set('searches = searches + 1')
			->set('last_search = ' . $query->quote($date))
			->where('url = ' . $query->quote($url))
			->where('keyword = ' . $query->quote($keyword));

		$this->db->setQuery($query)->execute();

		return true;
	}
}
