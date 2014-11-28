<?php
/**
 * @version 1.7
 * @link https://github.com/mc007
 * @author mc007 mc007@pearls-media.com
 * @license : GPL v2. http://www.gnu.org/licenses/gpl-2.0.html
 */

/***
 *
 * Remarks  : - This file does UX rendering and handles/routes RPC calls
 *
 *
 * Server   : - RPC-JSON 2.0 + Dojo SMD (Service Method Definition)
 *            - All RPC calls go through here as well
 *            - see @link :http://localhost/xcom/index.php?view=rpc for the full service map. plugins are exposed through this entry point too
 *            - Plugins are exposed through the very same SMD based entry point too

 * Client   : - Is a large Dojo & XJS application.
 *            - Client resources are described in client/xfile/xbox/resources-release.json
 *
 * Security : - All RPC calls are signed upon its payload + md5(userName)=key + md5(sessionToken)=token
 *            - See component options to narrow it further for live stages.
 *            - See Xapp_Rpc_Gateway options, signing callbacks are possible as well
 *            - You can rename, wrap, move this component!
 *
 *
 * Support  :  write an email through the official site for this component.
 *
 *
 *

Example urls
<a target="_blank" href="../index.php?layout=single">Single panel</a>
<a target="_blank" href="../index.php?layout=dual">Dual panel</a>
<a target="_blank" href="../index.php?layout=preview">Preview layout (split view with media preview)</a>
<a target="_blank" href="../index.php?layout=preview&theme=dot-luv">Preview layout in dark theme (split view with media preview)</a>
<a target="_blank" href="../index.php?layout=preview&open=Pictures">Auto open picture folder in preview mode (split view with media preview)</a>
<a target="_blank" href="../index.php?layout=single&minimal=true">Minimal (for mobile devices)</a>
*/

/***
 * BASE DIRECTORIES, don't touch !
 */
$ROOT_DIRECTORY_ABSOLUTE = realpath(dirname(__FILE__) . DIRECTORY_SEPARATOR);

$XAPP_SITE_DIRECTORY =  $ROOT_DIRECTORY_ABSOLUTE . DIRECTORY_SEPARATOR;
$XAPP_BASE_DIRECTORY =  $ROOT_DIRECTORY_ABSOLUTE . DIRECTORY_SEPARATOR . 'xapp' . DIRECTORY_SEPARATOR;

//ugly, seems i cant get defines from stub into here
/*
if(isset($_SERVER['SCRIPT_FILENAME']) && strpos($_SERVER['SCRIPT_FILENAME'],'runphar')!==false){
	define('XAPP_PHAR', true);
	define('XAPP_PHAR_FILE_PREFIX', 'phar://xapp.phar');
}
*/

$XAPP_SALT_KEY       =  'k?Ur$0aE#9j1+7ui';     //Salt key to sign and verify client calls

define('XAPP_BASEDIR',$XAPP_BASE_DIRECTORY);    //the most important constant
define('_VALID_MOS',1);                         //bypass joomla php security
define('_JEXEC',1);                             //bypass joomla php security


/////////////////////////////////////////////////////////////////
// Url parameter helpers
/////////////////////////////////////////////////////////////////
/**
 * Sanitizes a string key.
 *
 * Keys are used as internal identifiers. Lowercase & uppercase alphanumeric characters, dashes, comma and underscores are allowed.
 *
 * @param string $key String key
 * @return string Sanitized key
 */
function _sanitize_key( $key ) {
	return preg_replace( '/[^A-Za-z0-9_\-]/', '', $key );
}

/**
 * Return a _GET key but sanitzed
 * @param $key
 * @param $default
 * @return string
 */
function _getKey($key,$default){
	if(isset($_GET[$key])){
		return _sanitize_key($_GET[$key]);
	}
	return $default;
}



/////////////////////////////////////////////////////////////////
// Base configuration
/////////////////////////////////////////////////////////////////
//  The folder to browse, must be absolute and must have a trailing slash. This path can be outside of the web-server's httpdoc directory:

$XF_PATH = realpath(dirname(__FILE__) . DIRECTORY_SEPARATOR);

// allowed upload extensions. this is also used when renaming files
$XF_ALLOWED_UPLOAD_EXTENSIONS = 'sh,php,js,css,less,bmp,csv,doc,gif,ico,jpg,jpeg,odg,odp,ods,odt,pdf,png,ppt,swf,txt,xcf,xls,mp3';

// prohibited plugins, comma separated : 'XShell,XImageEdit,XZoho,XHTMLEditor,XSandbox,XSVN,XLESS'
$XF_PROHIBITED_PLUGINS = _getKey('disabledPlugins','');

//jQuery theme, append the url by &theme=dot-luv ! You can choose from :
// black-tie, blitzer, cupertino, dark-hive, dot-luv,eggplant,excite-bike,flick,hot-sneaks,humanity,le-frog,mint-choc,overcast,pepper-grinder,redmond,smoothness,south-street,start,sunny,swanky-purse,trontastic,ui-darkness,ui-lightness,vader
// see http://jqueryui.com/themeroller/ for more!
$XF_THEME = _getKey('theme','blitzer');


///////////////////////////////////////////////////////////////////
//
//  Some constants for building a valid XFile configuration
//
///////////////////////////////////////////////////////////////////

const XF_PANEL_MODE_TREE                =1;     //Tree
const XF_PANEL_MODE_LIST                =2;     //List
const XF_PANEL_MODE_THUMB               =3;     //Thumbnails
const XF_PANEL_MODE_PREVIEW             =4;     //Preview mode
const XF_PANEL_MODE_COVER               =5;     //Image Cover Flow
const XF_PANEL_MODE_SPLIT_VERTICAL      =6;     //Split Vertical
const XF_PANEL_MODE_SPLIT_HORIZONTAL    =7;     //Split Horizontal

const XF_LAYOUT_PRESET_DUAL             =1;     //Dual View ala Midnight commander or similar
const XF_LAYOUT_PRESET_SINGLE           =2;     //Single View only
const XF_LAYOUT_PRESET_BROWSER          =3;     //Classic Explorer like layout : left: tree, center : thumbs
const XF_LAYOUT_PRESET_PREVIEW          =4;     //Split view : top : preview window, bottom : thumbs
const XF_LAYOUT_PRESET_GALLERY          =5;     //Split view : top : image cover flow window, bottom : thumbs


/**
 * Define extra variables for client rendering. This array will override existing variables (see xapp/commander/App near '$XAPP_RELATIVE_VARIABLES')
 */
$XF_RESOURCE_VARIABLES                  = array(
	/**
	 * This is the user name automatically filled into the login form(client/xfile/xbox/login.html) , you may set this to ''
	 * Notice: this isn't setting the user name in the user database (xapp/commander/Users.php)
	 *
	 */
	'FILLED_USER_NAME'          => 'admin',
	/**
	 * this is the password automatically filled into the login form(client/xfile/xbox/login.html), you may set this to ''
	 * Notice: this isn't setting the user password in the user database (xapp/commander/Users.php)
	 */
	'FILLED_PASSWORD'           => 'asdasd'
);

/**
 * Compose XFile configuration
 */
$XF_CONFIG = array(
	"LAYOUT_PRESET" => XF_LAYOUT_PRESET_SINGLE,
	"PANEL_OPTIONS" => array(
		"ALLOW_NEW_TABS"        =>  true,
		"ALLOW_MULTI_TAB"       =>  false,
		"ALLOW_INFO_VIEW"       =>  true,
		"ALLOW_LOG_VIEW"        =>  true,
		"ALLOW_BREADCRUMBS"     =>  true,
		"ALLOW_CONTEXT_MENU"    =>  true,
		"ALLOW_LAYOUT_SELECTOR" =>  true,
		"ALLOW_SOURCE_SELECTOR" =>  true,
		"ALLOW_COLUMN_RESIZE"   =>  true,
		"ALLOW_COLUMN_REORDER"  =>  true,
		"ALLOW_COLUMN_HIDE"     =>  true
	),

	/**
	 * Allowed actions in UI and the server. Please check xapp/commander/App.php in the auth-delegate::authorize!
	 */
	"ALLOWED_ACTIONS" => array(
		0,  //none
		1,  //edit
		1,  //copy
		1,  //move
		1,  //info
		1,  //download  : remote download, needed by Aviary-Image-Editor or dropping links into file panels
		1,  //compress
		1,  //delete
		1,  //rename
		1,  //dnd
		1,  //copy &paste
		1,  //open
		1,  //reload
		1,  //preview
		1,  //insert image
		1,  //new file
		1,  //new dir
		1,  //upload
		1,  //read
		1,  //write
		1,  //plugins
		1,  //custom
		1,  //find
		1,  //perma link
		1,  //add mount
		1,  //remove mount
		1,  //edit mount
		1   //perspective

	),
	"FILE_PANEL_OPTIONS_LEFT" => array( //left panel
		"LAYOUT" => XF_PANEL_MODE_LIST, //when using tree, its target is then the main panel
		"AUTO_OPEN" => "true"
	),
	"FILE_PANEL_OPTIONS_MAIN" => array( //main panel
		"LAYOUT" => XF_PANEL_MODE_LIST,
		"AUTO_OPEN" => "true"
	),
	"FILE_PANEL_OPTIONS_RIGHT" => array( //info panel on the right
		"LAYOUT" => XF_PANEL_MODE_LIST,  //has no mean!
		"AUTO_OPEN" => "true"
	)
);

/**
 * Run xfile with config above
 */


require_once(XAPP_BASEDIR . 'commander/App.php');
$commanderStruct = xapp_commander_render_standalone(
    $XAPP_SITE_DIRECTORY.DIRECTORY_SEPARATOR.'xapp'.DIRECTORY_SEPARATOR,//xapp php directory
    'xbox',
    $XAPP_SITE_DIRECTORY.DIRECTORY_SEPARATOR.'client'.DIRECTORY_SEPARATOR .'src' . DIRECTORY_SEPARATOR,//client abs directory
    $XF_PATH,//the root folder to use
    '',//additional folder suffix (important to split it from above)
	$XF_ALLOWED_UPLOAD_EXTENSIONS,
	json_encode($XF_CONFIG),
    $XF_THEME,//see client/themes/jQuery and pick the folder name
    $ROOT_DIRECTORY_ABSOLUTE . DIRECTORY_SEPARATOR . 'server' . DIRECTORY_SEPARATOR,//service directory
    $ROOT_DIRECTORY_ABSOLUTE . DIRECTORY_SEPARATOR . 'log' . DIRECTORY_SEPARATOR,
    $ROOT_DIRECTORY_ABSOLUTE . DIRECTORY_SEPARATOR . 'conf' . DIRECTORY_SEPARATOR . 'settings.json',
    $XAPP_SALT_KEY,
    $XF_PROHIBITED_PLUGINS,
    $XF_RESOURCE_VARIABLES
);
//punch it
$commanderStruct['bootstrap']->handleRequest();
