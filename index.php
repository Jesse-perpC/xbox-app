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
/**
 *
 * What happens here:
 *
 * 1. Setup constants and framework directories
 * 2. Setup a default configuration
 * 3. Load conf/default.php to override default configuration (first pass)
 * 4. Load conf/custom.php if exists to override default configuration (second pass)
 * 5. Render RPC or client
 *
 */

/////////////////////////////////////////////////////////////////
//
// 1. Core directories & defines, don't touch !
//
/////////////////////////////////////////////////////////////////

$ROOT_DIRECTORY_ABSOLUTE = realpath(dirname(__FILE__) . DIRECTORY_SEPARATOR);
$XAPP_SITE_DIRECTORY =  $ROOT_DIRECTORY_ABSOLUTE . DIRECTORY_SEPARATOR;
$XAPP_BASE_DIRECTORY =  $ROOT_DIRECTORY_ABSOLUTE . DIRECTORY_SEPARATOR . 'xapp' . DIRECTORY_SEPARATOR;

define('XAPP_BASEDIR',$XAPP_BASE_DIRECTORY);    //the most important constant

/////////////////////////////////////////////////////////////////
//
// 1.1 Default directories and variables
//
/////////////////////////////////////////////////////////////////

/**
 * CONF_DIRECTORY points to the configuration directory which contains our profile
 */
$CONF_DIRECTORY     =   $ROOT_DIRECTORY_ABSOLUTE . DIRECTORY_SEPARATOR . 'conf' . DIRECTORY_SEPARATOR;


/**
 * XF_PATH, the folder to browse; must be absolute and must have a trailing slash. This path can be outside of the web-server's httpdoc directory:
 */
$XF_PATH = realpath(dirname(__FILE__) . DIRECTORY_SEPARATOR);


/**
 * XF_DEFAULT_PROFILE is the filename to the default profile. It will be fully resolved by using CONF_DIRECTORY as prefix.
 * This profile will override the default profile. You can switch this profile also by appending the url with ('&profile=admin')
 *
 * There is also a guest profile : &profile=min
 */
$XF_DEFAULT_PROFILE =  'default';


/**
 * XF_DEFAULT_CUSTOM_PROFILE is the filename to the custom profile. It will be fully resolved by using CONF_DIRECTORY as prefix.
 * If this file exists, this profile is the last override. This pass enables you to run your own configuration with a developer distribution.
 * the problem is that git pull won't work anymore as soon you did change this file or the conf/default.php.
 */
$XF_CUSTOM_PROFILE = _getKey('profile','custom');


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


/////////////////////////////////////////////////////////////////
//
// 2. Setup default configuration
//
/////////////////////////////////////////////////////////////////

$XAPP_SALT_KEY       =  'k?Ur$0aE#9j1+7ui';     //Salt key to sign and verify client calls

// allowed upload extensions. this is also used when renaming files
$XF_ALLOWED_UPLOAD_EXTENSIONS = 'sh,php,js,css,less,bmp,csv,doc,gif,ico,jpg,jpeg,odg,odp,ods,odt,pdf,png,ppt,swf,txt,xcf,xls,mp3,xblox,cfhtml';


/***************************************************************************
 *
 * File & directory masks. This must be compatible with PHP glob, see http://www.cowburn.info/2010/04/30/glob-patterns/ for more
 * patterns.
 *
 */

/**
 * XF_VISIBLE_FILE_EXTENSIONS is a comma separated list of visible file extensions,ie: css,html,png
 * If you want to show 'hidden' folders or files, you need to add '.*'
 *
 */
$XF_VISIBLE_FILE_EXTENSIONS = '*';

/**
 * XF_VISIBLE_FILE_EXTENSIONS is a comma separated list of hidden file extensions,ie: php,sh
 */
$XF_HIDDEN_FILE_EXTENSIONS = '.svn,.git,.idea';

/****************************************************************************/

// prohibited plugins, comma separated : 'XShell,XImageEdit,XZoho,XHTMLEditor,XSandbox,XSVN,XLESS'
$XF_PROHIBITED_PLUGINS = _getKey('disabledPlugins','');

//jQuery theme, append the url by &theme=dot-luv ! You can choose from :
// black-tie, blitzer, cupertino, dark-hive, dot-luv,eggplant,excite-bike,flick,hot-sneaks,humanity,le-frog,mint-choc,overcast,pepper-grinder,redmond,smoothness,south-street,start,sunny,swanky-purse,trontastic,ui-darkness,ui-lightness,vader
// see http://jqueryui.com/themeroller/ for more!
$XF_THEME = _getKey('theme','blitzer');

$XAPP_COMPONENTS = array(
	'XBLOX' => true,
	'XIDE_VE' => _getKey('xide',false)
);

/**
 * Define extra variables for client rendering. This array will override existing variables (see xapp/commander/App near '$XAPP_RELATIVE_VARIABLES')
 * The resource variables go into the the client side resource manager 'xide.manager.ResourceManager'
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
	'FILLED_PASSWORD'           => 'asdasd',
	/**
	 * Pass the enabled components
	 */
	'COMPONENTS'                => json_encode($XAPP_COMPONENTS),

	/**
	 *  Adjust global font size
	 */
	'GLOBAL_FONT_SIZE'          =>'0.78em',
	/**
	 *  Adjust action button icon size
	 */
	'ACTION_BUTTON_SIZE'        =>'1.3em'

);

/**
 * Compose XFile configuration
 */
$XF_CONFIG = array(

	"DEFAULT_STORE_OPTIONS" => array(
		"fields" => 1663,
		"includeList" => $XF_VISIBLE_FILE_EXTENSIONS,
		"excludeList" => $XF_HIDDEN_FILE_EXTENSIONS
	),

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
		"ALLOW_COLUMN_HIDE"     =>  true,
		"ALLOW_MAIN_MENU"       =>  true,
		"ALLOW_ACTION_TOOLBAR"  =>  true
	),

	/**
	 * Allowed actions in UI and the server. Please check xapp/commander/App.php in the auth-delegate::authorize!
	 */
	"ALLOWED_ACTIONS" => array(
		/*0*/	0,  //none
		/*1*/	1,  //edit : not used!
		/*2*/	1,  //copy
		/*3*/   1,  //move
		/*4*/   1,  //info
		/*5*/   1,  //download: images and file content
		/*6*/   1,  //compress
		/*7*/   1,  //delete
		/*8*/   1,  //rename
		/*9*/   1,  //dnd
		/*10*/  1,  //copy &paste
		/*11*/  1,  //open
		/*12*/  1,  //reload
		/*13*/  1,  //preview
		/*14*/  1,  //reserved
		/*15*/  1,  //insert image
		/*16*/  1,  //new file
		/*17*/  1,  //new dir
		/*18*/  1,  //upload
		/*19*/  1,  //read //not used
		/*20*/  1,  //write
		/*21*/  1,  //plugins
		/*22*/  1,  //custom
		/*23*/  1,  //find
		/*24*/  1,  //perma link: not used
		/*25*/  1,  //add mount
		/*26*/  1,  //remove mount
		/*27*/  1,  //edit mount
		/*28*/  0   //perspective

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


/////////////////////////////////////////////////////////////////
//
//  3. First pass, override config with CONF_DIRECTORY/default.php
//
/////////////////////////////////////////////////////////////////
$XF_DEFAULT_PROFILE = realpath($CONF_DIRECTORY . DIRECTORY_SEPARATOR . $XF_DEFAULT_PROFILE . '.php');
if(file_exists($XF_DEFAULT_PROFILE)){
	require_once($XF_DEFAULT_PROFILE);
}

/////////////////////////////////////////////////////////////////
//
//  4. Second pass, override config with CONF_DIRECTORY/custom.php
//
/////////////////////////////////////////////////////////////////
$XF_CUSTOM_PROFILE = realpath($CONF_DIRECTORY . DIRECTORY_SEPARATOR . $XF_CUSTOM_PROFILE    .  '.php');
if(file_exists($XF_CUSTOM_PROFILE)){
	require_once($XF_CUSTOM_PROFILE);
}

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
    $ROOT_DIRECTORY_ABSOLUTE . DIRECTORY_SEPARATOR . 'log' . DIRECTORY_SEPARATOR,
    $ROOT_DIRECTORY_ABSOLUTE . DIRECTORY_SEPARATOR . 'conf' . DIRECTORY_SEPARATOR . 'settings.json',
    $XAPP_SALT_KEY,
    $XF_PROHIBITED_PLUGINS,
    $XF_RESOURCE_VARIABLES,
    $XAPP_COMPONENTS
);
/**
 * Punch it Scotty!
 *
 */
$commanderStruct['bootstrap']->handleRequest();



/////////////////////////////////////////////////////////////////
//
//  Url parameter helpers
//
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