<?php
/**
 * Part of keyword project. 
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Keyword\Buffer;

/**
 * The JsonBuffer class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class JsonBuffer extends AbstractBuffer
{
	/**
	 * toString
	 *
	 * @return  string
	 */
	public function toString()
	{
		return json_encode($this->dump());
	}
}
