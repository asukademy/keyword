<?php
/**
 * Part of keyword project. 
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Keyword\Engine;

use PHPHtmlParser\Dom;

/**
 * The GoogleEngine class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class YahooEngine extends AbstractEngine
{
	/**
	 * Property host.
	 *
	 * @var  string
	 */
	protected $host = 'https://tw.search.yahoo.com';

	/**
	 * Property path.
	 *
	 * @var  string
	 */
	protected $path = '/search';

	/**
	 * Property query.
	 *
	 * @var  array
	 */
	protected $query = [
		'p' => null,
		'n' => 100
	];

	/**
	 * getPage
	 *
	 * @param string $keyword
	 *
	 * @return  string
	 */
	public function getPage($keyword)
	{
		$uri = $this->prepareUri();

		echo $uri->setVar('p', htmlspecialchars($keyword));

		return $this->get($uri->toString());
	}

	/**
	 * getOrdering
	 *
	 * @param string $url
	 * @param string $keyword
	 *
	 * @return  int|bool
	 */
	public function getOrdering($url, $keyword)
	{
		$body = $this->getPage($keyword);

		$dom = new Dom;
		$dom->load($body);

		$cites = $dom->find('#web ol li a.td-u');

		$url = urldecode($url);

		$i = 1;
		$found = false;

		if (!count($cites))
		{
			throw new \RuntimeException('Yahoo no response', 1201);
		}

		foreach ($cites as $k => $cite)
		{
			if (strpos($cite->href, $url) !== false)
			{
				$found = true;

				break;
			}

			$i++;
		}

		if (!$found)
		{
			$i = false;
		}

		return $i;
	}
}
