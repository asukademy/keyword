<?php
/**
 * Part of keyword project. 
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Keyword\Controller\Result;

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
	 */
	protected function doExecute()
	{
		if ($this->app->get('proxy', true))
		{
			return null;
		}

		$url = $this->input->getUrl('url');
		$keyword = $this->input->getString('keyword');

		$keyword = Regular::sanitize($keyword);
		$url = Regular::decode($url);

		if (!$keyword)
		{
			return $this->backToSearch('關鍵字未輸入');
		}

		if (!$url)
		{
			return $this->backToSearch('網址未輸入');
		}

		$view = $this->getView();
		$model = $this->getModel();

		$view['url'] = $url;
		$view['keyword'] = $keyword;
		$view['result'] = $model->getResult($url, $keyword);

		return $view->render();
	}

	/**
	 * backToSearch
	 *
	 * @param string $msg
	 *
	 * @return  boolean
	 */
	protected function backToSearch($msg)
	{
		$query = [
			'keyword' => $this->input->getVar('keyword'),
			'url' => $this->input->getVar('url'),
		];

		$this->setRedirect($this->package->router->buildHttp('home', $query), $msg);

		return false;
	}
}
