<?php
/**
 * Part of keyword project. 
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Keyword\Controller\Search;

use Keyword\Date\DateHelper;
use Keyword\Helper\Regular;
use Keyword\Model\LogModel;
use Keyword\Model\SearchModel;
use Windwalker\Core\Controller\Controller;
use Windwalker\Data\Data;
use Windwalker\Ioc;
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
		if (!$this->checkCaptcha())
		{
			return $this->backToSearch('驗證碼錯誤');
		}

		$keyword = $this->input->getString('keyword');
		$url     = $this->input->getUrl('url');

		$url = strtolower(rtrim($url, '/'));
		$keyword = Regular::sanitize($keyword);

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

		$url = urldecode($url->toString());
		$keyword = urldecode($keyword);

		$model = new SearchModel;

		$model['servers'] = (array) $this->app->get('servers', array());

		try
		{
			$result = $model->search($url, $keyword);

			$model->addSearchTimes($url, $keyword);

			$logModel = new LogModel;

			$data = new Data;
			$data['url'] = $url;
			$data['keyword'] = $keyword;
			$data['google'] = $result->google;
			$data['yahoo'] = $result->yahoo;
			$data['time'] = (new \DateTime('now', DateHelper::getTaipeiZone()))->format(DateHelper::FORMAT_SQL);
			$data['ipv4'] = $this->input->server->get('REMOTE_ADDR');

			$logModel->save($data);
		}
		catch (\Exception $e)
		{
			if (WINDWALKER_DEBUG)
			{
				throw $e;
			}

			return $this->backToSearch('Something error', 'danger');
		}

		$session = Ioc::getSession();
		$session->set('search.query', null);

		$url = Regular::encode(urlencode($url));
		$keyword = urlencode($keyword);

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

		$session = Ioc::getSession();
		$session->set('search.query', $query);

		$this->setRedirect($this->package->router->buildHttp('home'), $msg);

		return false;
	}

	/**
	 * checkCaptcha
	 *
	 * @return  boolean
	 */
	protected function checkCaptcha()
	{
		if ($this->app->get('recaptcha.ignore', false))
		{
			return true;
		}

		$gRecaptchaResponse = $this->input->post->get('g-recaptcha-response');
		$remoteIp = $this->input->server->get('REMOTE_ADDR');

		$recaptcha = new \ReCaptcha\ReCaptcha($this->app->get('recaptcha.secret'));

		$response = $recaptcha->verify($gRecaptchaResponse, $remoteIp);

		return $response->isSuccess();
	}
}
