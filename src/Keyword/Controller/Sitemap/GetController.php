<?php
/**
 * Part of keyword project. 
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Keyword\Controller\Sitemap;

use Asika\Sitemap\ChangeFreq;
use Asika\Sitemap\Sitemap;
use Keyword\Helper\Regular;
use Keyword\Table\Table;
use Windwalker\Core\Controller\Controller;
use Windwalker\Core\Router\RestfulRouter;
use Windwalker\DataMapper\DataMapper;

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
		$mapper = new DataMapper(Table::RESULTS);

		$items = $mapper->findAll(null, 0, 500);

		$sitemap = new Sitemap;

		$sitemap->addItem($this->app->get('uri.base.full'), '1.0', ChangeFreq::MONTHLY);

		foreach ($items as $item)
		{
			$link = $this->package->router->buildHtml('result', ['url' => Regular::encode(urlencode($item->url)), 'keyword' => urlencode($item->keyword)], RestfulRouter::TYPE_FULL);

			$sitemap->addItem($link, '0.8', ChangeFreq::MONTHLY, $item->last_search);
		}

		$this->app->response->setMimeType('text/xml');

		return $sitemap;
	}
}
