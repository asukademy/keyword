<?php
/**
 * Part of keyword project. 
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Keyword\View\Search;

use Windwalker\Core\Router\Router;
use Windwalker\Core\View\BladeHtmlView;

/**
 * The SearchHtmlView class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class SearchHtmlView extends BladeHtmlView
{
	/**
	 * prepareData
	 *
	 * @param \Windwalker\Data\Data $data
	 *
	 * @return  void
	 */
	protected function prepareData($data)
	{
		$data->action = Router::buildHtml('keyword:home');
	}
}
