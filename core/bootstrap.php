<?php

/*
 * This file is part of the miniCMS package.
 * (c) 2005-2012 BATMUNKH Moltov <contact@batmunkh.com>
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

define('DS', DIRECTORY_SEPARATOR);
define('DIR_ABS',__DIR__.DS.'../');


define('DIR_TEMPLATE', DIR_ABS . 'templates' . DS);
define('DIR_CORE', DIR_ABS . 'core' . DS);
define('DIR_LIB', DIR_CORE . 'library' . DS);
define('DIR_PLUGIN', DIR_CORE . 'plugins' . DS);
define('DIR_TMP', DIR_CORE . 'tmp' . DS);
define('DIR_CACHE', DIR_CORE . 'cache' . DS);
define('DIR_LOG', DIR_CORE . 'log' . DS);
//session_save_path(DIR_TMP.'sessions'.DS);

//media folders. relative to domain
define('DIR_CSS', DS . 'css' . DS);
define('DIR_JS', DS . 'js' . DS);
define('DIR_IMAGE', DS . 'images' . DS);

//system iin undsen APP
define('SYSTEM_APP_NAME', 'system');
define('SYSTEM_APP_DIR', DIR_ABS . 'app' . DS . 'system' . DS);
//system iin undsen APP-d hamaaragdah aldaa medeeleh module
define('ERROR_MODULE_NAME', 'error');
define('ERROR_MODULE_DIR', SYSTEM_APP_DIR . 'modules' . DS . ERROR_MODULE_NAME . DS);
//system iin undsen APP-d hamaaragdah error module iin action
define('PAGE_NOT_FOUND_ACTION', '404');

require_once (DIR_LIB . 'includes' . DS . 'common.php');

require_once (DIR_CORE . 'config' . DS . 'main.php');

//load autoloader
require DIR_CORE.'library/vendor/autoload.php';

$core = new Core($mbm_config);
$db = new DB();

date_default_timezone_set(TIME_ZONE);
//include_files(DIR_LIB.'functions'.DS);

