<?php
/**
 * Part of keyword project. 
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Engine;

use Joomla\Http\HttpFactory;
use Windwalker\Uri\Uri;

/**
 * The AbstractEngine class.
 * 
 * @since  {DEPLOY_VERSION}
 */
abstract class AbstractEngine
{
	/**
	 * Property host.
	 *
	 * @var  string
	 */
	protected $host = '';

	/**
	 * Property path.
	 *
	 * @var  string
	 */
	protected $path = '';

	/**
	 * Property query.
	 *
	 * @var  array
	 */
	protected $query = [];

	abstract public function getPage($keyword);

	abstract public function getOrdering($url, $keyword);

	/**
	 * prepareUri
	 *
	 * @return  Uri
	 */
	protected function prepareUri()
	{
		$uri = new Uri($this->host);

		$uri->setPath($this->path);
		$uri->setQuery($this->query);

		return $uri;
	}

	/**
	 * get
	 *
	 * @param string $url
	 *
	 * @return  string
	 */
	protected function get($url)
	{
		$http = HttpFactory::getHttp([], 'curl');

		$responce = $http->get($url);

		if ($responce->code != 200)
		{
			throw new \RuntimeException('Request error');
		}

		return $responce->body;
	}
}
