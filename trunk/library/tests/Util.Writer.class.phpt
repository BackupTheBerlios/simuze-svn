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
* Description: This file is part of the Simuze music system and is a PHPUnit2 testfile
*
* Version: $Id$
*/

require_once "../Util.Writer.class.php";
require_once 'PHPUnit2/Framework/TestSuite.php';
require_once 'PHPUnit2/TextUI/TestRunner.php';


class WriterTestCase extends PHPUnit2_Framework_TestCase {
	
	public function __constructor($name) {
		parent::__constructor($name);
	}
	
	public function testAppend() {
		$sTestString1 = 'A small step for man, ';
		$sTestString2 = 'a gigant leap for mankind';
		
		$writer = new Writer();
		$writer->Append($sTestString1);
		$writer->Append($sTestString2);
			
		//check that the append function truly appends
		$this->assertTrue($writer->Get() == 'A small step for man, a gigant leap for mankind');
	}
}

if(realpath($PHP_SELF) == __FILE__) {
	$suite = new PHPUnit_Framework_TestSuite('WriterTestCase');
	PHPUnit_TextUI_TestRunner::run($suite);
}
?>
