<?php
/*
* Copyright 2006 V. Weevers
* This file is part of Simuze.
* Simuze is free software; you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation; either version 2 of the License, or (at your option) any later version.
* Simuze is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU General Public License for more details.
* You should have received a copy of the GNU General Public License along with Simuze; if not, write to the Free Software Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
* The latest source code is available at simuze.berlios.de
* Contact V. Weevers <email@t22.nl>
* 
* Description: This file is part of the Simuze music system
*
* Version: $Id: Validator.class.php 3 2006-03-03 15:22:00Z t22 $ 
*/

/**
* @package Simuze	
*/
/**
* Validator class
*
* Multiple types of variables can be validated using this class.	
* @package Validator	
* @author V. Weevers <email@t22.nl> 
* @copyright V. Weevers 2006
* @version $Id: Validator.class.php 3 2006-03-03 15:22:00Z t22 $ 
*/

class Validator
{
	/**
	 * Validate an email-address
	 * @param String $sEmail
	 * @return Boolean
	 */
	function Email ($sEmail)
	{
		return (preg_match('/^[A-Za-z0-9\+._-]+@[A-Za-z0-9._-]+\.[A-Za-z]{2,6}$/', $sEmail)) ? true : false;
	}

	/**
	 * Validate a URL
	 * @param String $sUrl
	 * @param String $sProtocol Optional, choose which protocols are allowed, seperated by '|'.
	 * @return Boolean
	 */
	function URL ($sUrl, $sProtocol = 'http|https')
	{
		//should ip's be allowed?
		return (preg_match("/^(($sProtocol):\\/\\/{1})((\w+\.)+)\w{2,}(\/?)$/i", $sUrl)) ? true : false;
	}

	/**
	 * Validate string length
	 * @param String $sString
	 * @return Boolean
	 */
	function Length ($sString, $iMin = 0, $iMax = 32)
	{
		return strlen($sString)<=$iMax && strlen($sString)>$iMin;
	}
	
	function File () {}
}

?>