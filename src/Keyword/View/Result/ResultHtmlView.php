<?php
/**
 * Part of keyword project. 
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Keyword\View\Result;

use Keyword\Engine\GoogleEngine;
use Keyword\Engine\YahooEngine;
use Keyword\Helper\ResultHelper;
use Windwalker\Core\Router\Router;
use Windwalker\Core\View\BladeHtmlView;

/**
 * The ResultHtmlView class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class ResultHtmlView extends BladeHtmlView
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
		$data->url = urldecode($data->url);
		$data->keyword = urldecode($data->keyword);
		$data->googleUrl = (new GoogleEngine)->prepareUri($data->keyword);
		$data->yahooUrl = (new YahooEngine)->prepareUri($data->keyword);

		// Color
		$data->googleText = ResultHelper::getColorClass($data->result->google);
		$data->yahooText = ResultHelper::getColorClass($data->result->yahoo);
	}
}
