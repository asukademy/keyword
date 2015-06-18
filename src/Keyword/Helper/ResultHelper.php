<?php
/**
 * Part of keyword project. 
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Keyword\Helper;

/**
 * The ResultHelper class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class ResultHelper
{
	/**
	 * getColorClass
	 *
	 * @param int $ordering
	 *
	 * @return  string
	 */
	public static function getColorClass($ordering)
	{
		if ($ordering <= 0)
		{
			return 'text-danger';
		}
		elseif ($ordering >= 1 && $ordering <=3)
		{
			return 'text-success';
		}
		elseif ($ordering >= 4 && $ordering <=10)
		{
			return 'text-warning';
		}
		elseif ($ordering >= 11)
		{
			return '';
		}
	}
}
