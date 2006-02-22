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
 * Create html pages 
 *
 * You can easily generate an html page using this class. It extends the Writer class.
 * @package Writer
 * @version $Id$
 */
class WriterHTML extends Writer {
	
	/**
	 * Contains the chosen DocType
     * @access public
     * @var String  
     */
	public $sDocType;			

	/**
	 * Contains the chosen title for the html page
     * @access public
     * @var String  
     */
	public $sTitle;

	/**
	 * Contains the chosen base url
     * @access public
     * @var String  
     */
	public $sBase;				

	/**
	 * Contains all body elements 
     * @access public
     * @var String  
     */
	public $sBody; 				
	
	/**
	 * Contains all style elements of the page 
     * @access public
     * @var Array 
     */
	public $aCss = array();		
	
	/**
	 * Contains all the scripts elements of the page
     * @access public
     * @var Array  
     */
	public $aScripts = array(); 	
	
	/**
	 * Contains all the link elements of the page
	 * @access public
     * @var Array  
     */
	public $aLinks = array();	
	
	/**
	 * Contains all the meta elements of the page
	 * @access public
     * @var Array  
     */
	public $aMetas = array(); 	
	
	/**
	 * @access private
	 * @var Array $aDocTypes Contains all the DocTypes this class can use
	 */
	private $aDocTypes = array(	'HTML2.0' => '<!DOCTYPE html PUBLIC "-//IETF//DTD HTML 2.0//EN">',
								'HTML3.2' => '<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 3.2 Final//EN">',
								'HTML4.01 TRANSITIONAL' => '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
        													"http://www.w3.org/TR/1999/REC-html401-19991224/loose.dtd">', 
								'HTML4.01 FRAMESET' => '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN"
        												"http://www.w3.org/TR/1999/REC-html401-19991224/frameset.dtd">',
								'HTML4.01 STRICT' => '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
							   							"http://www.w3.org/TR/1999/REC-html401-19991224/strict.dtd">',
							   	'XHTML1.0 TRANSITIONAL' =>'<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
															"http://www.w3.org/TR/2000/REC-xhtml1-20000126/DTD/xhtml1-transitional.dtd">', 						
								'XHTML1.0 FRAMESET' =>'<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Frameset//EN"
															"http://www.w3.org/TR/2000/REC-xhtml1-20000126/DTD/xhtml1-frameset.dtd">',							
								'XHTML1.0 STRICT' =>'<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
															"http://www.w3.org/TR/2000/REC-xhtml1-20000126/DTD/xhtml1-strict.dtd">',					
								'XHTML1.1' => '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" 
															"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">'							
								); 
	
	
	/**
	 * Create the WriterHTML instance
	 * 
	 * The doctype default to XHTML1.0 TRANSITIONAL and if you need a different
	 * doctype than you should use on of the options below:
	 * 
	 * DocTypes (String)
	 * 
	 * - HTML2.0 (really old, only part of the list to be as complete as possible)
	 * - HTML3.2 (really old, only part of the list to be as complete as possible)
	 * - HTML4.01 TRANSITIONAL
	 * - HTML4.01 FRAMESET	
	 * - HTML4.01 STRICT
	 * - XHTML1.0 TRANSITIONAL (default)
	 * - XHTML1.0 FRAMESET
	 * - XHTML1.0 STRICT
	 * - XHTML1.1
	 *  
	 * @param String $sDocType Defaults to XHTML1.0 TRANSITIONAL
	 */
	function __construct($sDocType = 'XHTML1.0 TRANSITIONAL') 
	{
		$this->setDocType($sDocType);
	}
	
	/**
	 * Set the DocType of the HTML page
	 *
	 * This is usually not needed, because the constructor already sets the
	 * doctype automagically to XHTML. If you however don't want to use 
	 * this doctyp you need to set the specific doctype explicitly in the 
	 * constructor.
	 * @param String $sDocType 
	 */
	function setDocType($sDocType)
	{
		$this->sDocType = $aDocTypes[$sDocType]; 	
	}
	
	/**
	 * Set the html page title
	 * @param String $sTitle 
	 */
	function setPageTitle($sTitle) 
	{
		$this->sTitle = $sTitle;
	}
	
	/**
	 * Set the html page base url
	 * @param String $sUrl 
	 */
	function setPageBaseURL($sURL) 
	{
		$this->sBase = $sURL;
	}
		
	// TODO: Tue Jan 03 22:36:18 CET 2006 BjornW think about Dublin Core metadat
	/**
	 * Add meta tags to the metas array of the html page  
	 * @param Array $aAttributes Use for the attributes of a meta tag 
	 * See also W3C on the meta element {@link http://www.w3.org/TR/html4/struct/global.html#h-7.4.4}
	 */
	function AddMeta($aAttributes)
	{
		$sMetaElement = '<meta ';
		foreach($aAttributes as $key => $value) {
			if(!empty($value)) {
				$sMetaElement .= "$key=\"$value\" "; 
			}
		}
		// close tag and add newline
		$sMetaElement .= '/>\n';
		// push new link element to the links array
		$this->aMetas[] = $sMetaElement; 
	}
	
	/**
	* Add a script element to the scripts array of the html page.  
	* @param String $sType Defines the mimetype of the script. Defaults to text/javascript
	* @param String $sLang Defines language type. Defaults to javascript
	* @param String $sSrc Defines the path to the external script. Defaults to empty
	* @param String $sInnerHTML Can be used to directly write a script within the script tags. Defaults to empty
	*/
	function AddScript($sType ='text/javascript', $sLang='javascript', $sSrc='', $sInnerHTML='') 
	{
		//push new script element to the scripts array
		$this->aScripts[] = "<script type=\"$sType\" language=\"$sLang\" src=\"$sSrc\">$sInnerHTML<script>\n"; 
	}
	
	/**
	 * Add a link element to the links array of the html page
	 * @param Array $aAttributes Use for the attributes of a link, such as href, rel, id etc 
	 * see also {@link http://www.w3.org/TR/html4/struct/links.html#h-12.3}
	 */
	function AddLink($aAttributes)
	{
		// create link element with attributes
		$sLinkElement = '<link ';
		foreach($aAttributes as $key => $value) {
			if(!empty($value)) {
				$sLinkElement .= "$key=\"$value\" "; 
			}
		}
		// close tag and add newline
		$sLinkElement .= '/>\n';
				
		// push new link element to the links array
		$this->aLinks[] = $sLinkElement; 
	}
	

	/**
	 * Add a style element to the styles array of the html page  
	 * @param String $sType Defines the type attribute. Defaults to text/css  
	 * @param String $sMedia Defines the media attribute. Defaults to all
	 * @param String $sTitle Define the title attribute. Usually not used and defaults to empty
	 * @param String $innerStyle Can be used to directly write style information between the style tags. Defaults to empty
	 * @param Boolean $bUseCompatibilityComments Used to encapsulate style information in comments in order to increase compatibility
	 * with older browsers. Defaults to true.	
	 */
	function AddStyle($sType = 'text/css' , $sMedia = 'all', $sTitle = '', $sInnerStyle, $bUseCompatibilityComments = true) 
	{
		$sStyleElement  = "<style type=\"$sType\" media=\"$sMedia\" ";
		if(!empty($sTitle)) {
			$sStyleElement .= " title=\"$sTitle\""; 
		} 
		
		// use comments around the style to ensure compatibility with older browsers
		if(!empty($sInnerStyle)) {
			if($bUseCompatibilityComments) {
				$sStyleElement .= ">\n<!-- $sInnerStyle -->\n</style>\n";
			} else {
				$sStyleElement .= ">\n<$sInnerStyle</style>\n";
			}
		}	
		
		$this->aCss[] = $sStyleElement; 
	}

	// css @import
	function AddStyleImport()
	{
	
	}
	
	// TODO: BjornW need to think about frames, html tag including namespace and encoding. Also we're not really using
	// the fact that this class is a extension of the Writer Class...
	
	
	
	
	
	
}
	





?>

