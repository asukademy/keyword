<?php
/**
 * Part of keyword project. 
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Keyword\Controller\Search;

use Windwalker\Core\Controller\Controller;
use Windwalker\Data\Data;
use Windwalker\Ioc;
use Windwalker\Utilities\ArrayHelper;

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
		$view = $this->getView();

		$session = Ioc::getSession();
		$query = $session->get('search.query', []);
		$query = new Data($query);

		$view['keyword'] = $query->keyword;
		$view['url'] = $query->url;

		$session->set('search.query', null);

		return $view->render();
	}
}
