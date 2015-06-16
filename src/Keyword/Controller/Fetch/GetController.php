<?php
/**
 * Part of keyword project. 
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Keyword\Controller\Fetch;

use Keyword\Buffer\JsonBuffer;
use Keyword\Engine\GoogleEngine;
use Keyword\Engine\YahooEngine;
use Keyword\Helper\Regular;
use Windwalker\Core\Controller\Controller;

/**
 * The GetController class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class GetController extends Controller
{
	/**
	 * doExecute
	 *
	 * @return  mixed
	 * @throws \Exception
	 */
	protected function doExecute()
	{
		$keyword = $this->input->getString('keyword');
		$url     = $this->input->getUrl('url');

		$keyword = Regular::sanitize($keyword);
		$url = Regular::decode($url);

		$keyword = trim($keyword);
		$url = trim($url);

		if (!$keyword)
		{
			throw new \Exception('關鍵字未輸入');
		}

		if (!$url)
		{
			throw new \Exception('網址未輸入');
		}

		try
		{
			$engine = new GoogleEngine;
			$gOrdering = $engine->getOrdering($url, $keyword);

			$engine = new YahooEngine;
			$yOrdering = $engine->getOrdering($url, $keyword);
		}
		catch (\Exception $e)
		{
			$buffer = new JsonBuffer;
			$buffer->code = $e->getCode();
			$buffer->success = false;
			$buffer->message = $e->getMessage();

			$this->app->response->setMimeType('text/json');

			return $buffer;
		}

		$buffer = new JsonBuffer;
		$buffer->data['google'] = $gOrdering;
		$buffer->data['yahoo'] = $yOrdering;

		$this->app->response->setMimeType('text/json');

		return $buffer;
	}
}
