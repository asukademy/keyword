<?php
/**
 * Part of keyword project. 
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Keyword\Controller\Search;

use Keyword\Model\SearchModel;
use Windwalker\Core\Controller\Controller;
use Windwalker\Uri\Uri;

/**
 * The SaveController class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class SaveController extends Controller
{
	/**
	 * doExecute
	 *
	 * @return  mixed
	 */
	protected function doExecute()
	{
		$keyword = $this->input->getString('keyword');
		$url     = $this->input->getUrl('url');

		$keyword = trim($keyword);
		$url = trim($url);

		if (!$keyword)
		{
			return $this->backToSearch('關鍵字未輸入');
		}

		if (!$url)
		{
			return $this->backToSearch('網址未輸入');
		}

		$url = new Uri($url);

		$url->setScheme(null);

		$url = urlencode($url->toString());
		$keyword = urlencode($keyword);

		$model = new SearchModel;

		$model['servers'] = (array) $this->app->get('servers', array());

		try
		{
			$model->search($url, $keyword);
		}
		catch (\Exception $e)
		{
			if (WINDWALKER_DEBUG)
			{
				throw $e;
			}

			return $this->backToSearch('Some thing error', 'danger');
		}

		$this->setRedirect($this->package->router->buildHttp('result', ['keyword' => $keyword, 'url' => $url]));

		return true;
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
