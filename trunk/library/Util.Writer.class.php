<?php
/*
* Copyright 2006 Bjorn Wijers
* This file is part of Simuze.
* Simuze is free software; you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation; either version 2 of the License, or (at your option) any later version.
* Simuze is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU General Public License for more details.
* You should have received a copy of the GNU General Public License along with Simuze; if not, write to the Free Software Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
* The latest source code is available at simuze.berlios.de
* Contact Bjorn Wijers <bwijers [at] bdisfunctional [dot] net> 
* 
* Description: This file is part of the Simuze music system
*
* Version: $Id$ 
*/

/**
* @package Simuze	
*/
/**
* Small base class for creating output 
*
* Use this base class to extend into specialized output classes such as 
* a HTML writer class or a RSS writer class	
* @package Writer	
* @author Bjorn Wijers <bwijers[at]bdisfunctional[dot]net> 
* @copyright Bjorn Wijers 2006
* @version $Id$
*/
class Writer {

	/**
	 * @access public
	 * @var String 
	 */
	public $sOutput;
		
	/**
	 * Constructor
	 *
	 */
	function __construct() 
	{
			
	}
	
	/**
	 * Append a string to the output string 
	 * @param String $sString
	 */
	function Append($sString) 
	{
		$this->sOutput .= $sString; 
	}
	
	/** 
 	 * Get a string
	 * @return String $sOutput
	 */ 
	function Get() 
	{
		return $this->sOutput;
	}
}
?>

