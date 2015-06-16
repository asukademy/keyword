<?php
/**
 * Part of keyword project. 
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Keyword\Date;

/**
 * The DateHelper class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class DateHelper
{
	const FORMAT_SQL = 'Y-m-d H:i:s';

	const ZONE_TAIPEI = 'Asia/Taipei';

	const ZONE_UTC = 'UTC';

	/**
	 * getTaipeiZone
	 *
	 * @return  \DateTimeZone
	 */
	public static function getTaipeiZone()
	{
		return new \DateTimeZone(static::ZONE_TAIPEI);
	}

	/**
	 * getUTCZone
	 *
	 * @return  \DateTimeZone
	 */
	public static function getUTCZone()
	{
		return new \DateTimeZone(static::ZONE_UTC);
	}
}
