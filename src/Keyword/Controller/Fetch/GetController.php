<?php
/**
 * Part of keyword project. 
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Keyword\Controller\Fetch;

use Engine\GoogleEngine;
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

		$engine = new GoogleEngine;
		$engine->getOrdering($url, $keyword);
	}
}
