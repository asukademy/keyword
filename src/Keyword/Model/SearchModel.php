<?php
/**
 * Part of keyword project. 
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Keyword\Model;

use Joomla\Http\HttpFactory;
use Keyword\Helper\Regular;
use Windwalker\Core\Model\Model;
use Windwalker\Data\Data;
use Windwalker\DataMapper\DataMapper;
use Windwalker\Registry\Registry;

/**
 * The SearchModel class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class SearchModel extends Model
{
	/**
	 * search
	 *
	 * @param string $url
	 * @param string $keyword
	 *
	 * @return  bool
	 */
	public function search($url, $keyword)
	{
		$this->init($url, $keyword);

		$servers = $this['servers'];

		$server = $servers[array_rand($servers)];

		$server = ltrim($server, '/') . '/fetch/' . Regular::encode($url) . '/' . $keyword;

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

		$data->keyword = urldecode($keyword);
		$data->url     = urldecode($url);
		$data->google  = $result['data.google'];
		$data->yahoo   = $result['data.yahoo'];

		$mapper->updateOne($data, ['url', 'keyword']);

		return true;
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
		$url = urldecode($url);
		$keyword = urldecode($keyword);

		$mapper = new DataMapper('results');

		if ($mapper->findOne(['keyword' => $keyword, 'url' => $url])->notNull())
		{
			return true;
		}

		$mapper->createOne(['keyword' => $keyword, 'url' => $url]);

		return true;
	}
}
