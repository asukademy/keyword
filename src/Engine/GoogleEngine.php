<?php
/**
 * Part of keyword project. 
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Engine;

use PHPHtmlParser\Dom;

/**
 * The GoogleEngine class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class GoogleEngine extends AbstractEngine
{
	/**
	 * Property host.
	 *
	 * @var  string
	 */
	protected $host = 'https://www.google.com.tw';

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
		'q' => null,
		'num' => 100,
		'ie' => 'UTF-8'
	];

	public function getPage($keyword)
	{
		$uri = $this->prepareUri();

		$uri->setVar('q', htmlspecialchars($keyword));

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

		$cites = $dom->find('.g .s .kv cite');

		$url = urldecode($url);

		$i = 1;
		$found = false;

		foreach ($cites as $k => $cite)
		{
			if (strpos($cite->text, $url) !== false)
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
