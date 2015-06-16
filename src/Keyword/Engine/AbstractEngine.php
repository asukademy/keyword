<?php
/**
 * Part of keyword project. 
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Keyword\Engine;

use Joomla\Http\HttpFactory;
use Windwalker\Registry\Registry;
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

	/**
	 * getPage
	 *
	 * @param string $keyword
	 *
	 * @return  string
	 */
	abstract public function getPage($keyword);

	/**
	 * getOrdering
	 *
	 * @param string $url
	 * @param string $keyword
	 *
	 * @return  string
	 */
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
		$options = [];
		$options['transport.curl'] = [
			CURLOPT_SSL_VERIFYPEER => 0,
			CURLOPT_USERAGENT      => "Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/535.1 (KHTML, like Gecko) Chrome/14.0.835.163 Safari/535.1",
		];

		$http = HttpFactory::getHttp($options, 'curl');

		$response = $http->get($url);

		return $response->body;
	}
}
