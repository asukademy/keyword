<?php
/**
 * Part of keyword project. 
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Keyword\Model;

use Windwalker\Core\Model\Model;
use Windwalker\DataMapper\DataMapper;

/**
 * The ResultModel class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class ResultModel extends Model
{
	/**
	 * getResult
	 *
	 * @param string $url
	 * @param string $keyword
	 *
	 * @return  \Windwalker\Data\Data
	 */
	public function getResult($url, $keyword)
	{
		$url = urldecode($url);
		$keyword = urldecode($keyword);

		$data = (new DataMapper('results'))->findOne(['url' => $url, 'keyword' => $keyword]);

		if ($data->isNull())
		{
			throw new \RuntimeException('Result not found.');
		}

		return $data;
	}
}
