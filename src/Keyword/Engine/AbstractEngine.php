<?php
/**
 * Part of keyword project. 
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Keyword\Engine;

use GuzzleHttp\Client;
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
//		$options = [];
//		$options['transport.curl'] = [
//			CURLOPT_SSL_VERIFYPEER => 0,
//			CURLOPT_USERAGENT      => "Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/535.1 (KHTML, like Gecko) Chrome/14.0.835.163 Safari/535.1",
//			CURLOPT_HTTPHEADER => array(
//				'CLIENT-IP:8.8.8.8',
//				'X-FORWARDED-FOR:8.8.8.9',
//				'X-FORWARDED:8.8.8.10',
//				'X-CLUSTER-CLIENT_IP:8.8.8.11',
//				'FORWARDED-FOR:8.8.8.12',
//				'FORWARDED:8.8.8.13',
//				'REMOTE-ADDR:8.8.8.14' //REMOTE-ADDR 無法偽造
//			)
//		];
//
//		$http = HttpFactory::getHttp($options, 'curl');
//
//		$response = $http->get($url);

		$client = new Client([
			'verify' => false
		]);

		$response = $client->get($url);

		return $response->getBody();
	}
}
