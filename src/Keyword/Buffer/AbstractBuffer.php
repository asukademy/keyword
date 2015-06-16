<?php
/**
 * Part of keyword project. 
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Keyword\Buffer;

use Windwalker\Data\Data;

/**
 * The AbstractBuffer class.
 * 
 * @since  {DEPLOY_VERSION}
 */
abstract class AbstractBuffer extends Data
{
	/**
	 * Property message.
	 *
	 * @var  string
	 */
	public $message = '';

	/**
	 * Property code.
	 *
	 * @var  string
	 */
	public $code = 200;

	/**
	 * Property success.
	 *
	 * @var  boolean
	 */
	public $success = true;

	/**
	 * Property data.
	 *
	 * @var  array
	 */
	public $data = [];

	/**
	 * @param string $message
	 * @param string $code
	 * @param array  $data
	 */
	public function __construct($message = '', $code = null, $data = [])
	{
		$this->message = $message;
		$this->code    = $code ? : $this->code;
		$this->data    = $data;
	}

	/**
	 * __toString
	 *
	 * @return  string
	 */
	public function __toString()
	{
		return $this->toString();
	}

	/**
	 * toString
	 *
	 * @return  string
	 */
	abstract public function toString();
}
