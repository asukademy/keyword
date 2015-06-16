<?php
/**
 * Part of keyword project. 
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Keyword\Helper;

/**
 * The Regular class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class Regular
{
	/**
	 * sanitize
	 *
	 * @param string $text
	 *
	 * @return  string
	 */
	public static function sanitize($text)
	{
		return str_replace(['/', '\\'], '', $text);
	}

	/**
	 * encode
	 *
	 * @param string $text
	 *
	 * @return  string
	 */
	public static function encode($text)
	{
		return str_replace('%2F', '@S@', $text);
	}

	/**
	 * decode
	 *
	 * @param string $text
	 *
	 * @return  string
	 */
	public static function decode($text)
	{
		return str_replace('@S@', '%2F', $text);
	}
}
