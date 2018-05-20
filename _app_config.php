<?php
/**
 * @package economic-analyzer
 *
 * APPLICATION-WIDE CONFIGURATION SETTINGS
 *
 * This file contains application-wide configuration settings.  The settings
 * here will be the same regardless of the machine on which the app is running.
 *
 * This configuration should be added to version control.
 *
 * No settings should be added to this file that would need to be changed
 * on a per-machine basic (ie local, staging or production).  Any
 * machine-specific settings should be added to _machine_config.php
 */

/**
 * APPLICATION ROOT DIRECTORY
 * If the application doesn't detect this correctly then it can be set explicitly
 */
if (!GlobalConfig::$APP_ROOT) GlobalConfig::$APP_ROOT = realpath("./");

/**
 * check is needed to ensure asp_tags is not enabled
 */
if (ini_get('asp_tags')) 
	die('<h3>Server Configuration Problem: asp_tags is enabled, but is not compatible with Savant.</h3>'
	. '<p>You can disable asp_tags in .htaccess, php.ini or generate your app with another template engine such as Smarty.</p>');

/**
 * INCLUDE PATH
 * Adjust the include path as necessary so PHP can locate required libraries
 */
set_include_path(
		GlobalConfig::$APP_ROOT . '/libs/' . PATH_SEPARATOR .
		GlobalConfig::$APP_ROOT . '/../phreeze/libs' . PATH_SEPARATOR .
		GlobalConfig::$APP_ROOT . '/vendor/phreeze/phreeze/libs/' . PATH_SEPARATOR .
		get_include_path()
);

/**
 * COMPOSER AUTOLOADER
 * Uncomment if Composer is being used to manage dependencies
 */
// $loader = require 'vendor/autoload.php';
// $loader->setUseIncludePath(true);

/**
 * SESSION CLASSES
 * Any classes that will be stored in the session can be added here
 * and will be pre-loaded on every page
 */
require_once "App/ExampleUser.php";

/**
 * RENDER ENGINE
 * You can use any template system that implements
 * IRenderEngine for the view layer.  Phreeze provides pre-built
 * implementations for Smarty, Savant and plain PHP.
 */
require_once 'verysimple/Phreeze/SavantRenderEngine.php';
GlobalConfig::$TEMPLATE_ENGINE = 'SavantRenderEngine';
GlobalConfig::$TEMPLATE_PATH = GlobalConfig::$APP_ROOT . '/templates/';

/**
 * ROUTE MAP
 * The route map connects URLs to Controller+Method and additionally maps the
 * wildcards to a named parameter so that they are accessible inside the
 * Controller without having to parse the URL for parameters such as IDs
 */
GlobalConfig::$ROUTE_MAP = array(

	// default controller when no route specified
	'GET:' => array('route' => 'Default.Home'),
		
	// example authentication routes
	'GET:loginform' => array('route' => 'SecureExample.LoginForm'),
	'POST:login' => array('route' => 'SecureExample.Login'),
	'GET:secureuser' => array('route' => 'SecureExample.UserPage'),
	'GET:secureadmin' => array('route' => 'SecureExample.AdminPage'),
	'GET:logout' => array('route' => 'SecureExample.Logout'),
		
	// TbAction
	'GET:tbactions' => array('route' => 'TbAction.ListView'),
	'GET:tbaction/(:num)' => array('route' => 'TbAction.SingleView', 'params' => array('idAction' => 1)),
	'GET:api/tbactions' => array('route' => 'TbAction.Query'),
	'POST:api/tbaction' => array('route' => 'TbAction.Create'),
	'GET:api/tbaction/(:num)' => array('route' => 'TbAction.Read', 'params' => array('idAction' => 2)),
	'PUT:api/tbaction/(:num)' => array('route' => 'TbAction.Update', 'params' => array('idAction' => 2)),
	'DELETE:api/tbaction/(:num)' => array('route' => 'TbAction.Delete', 'params' => array('idAction' => 2)),
		
	// TbBeneficiaries
	'GET:tbbeneficiarieses' => array('route' => 'TbBeneficiaries.ListView'),
	'GET:tbbeneficiaries/(:num)' => array('route' => 'TbBeneficiaries.SingleView', 'params' => array('idBeneficiaries' => 1)),
	'GET:api/tbbeneficiarieses' => array('route' => 'TbBeneficiaries.Query'),
	'POST:api/tbbeneficiaries' => array('route' => 'TbBeneficiaries.Create'),
	'GET:api/tbbeneficiaries/(:num)' => array('route' => 'TbBeneficiaries.Read', 'params' => array('idBeneficiaries' => 2)),
	'PUT:api/tbbeneficiaries/(:num)' => array('route' => 'TbBeneficiaries.Update', 'params' => array('idBeneficiaries' => 2)),
	'DELETE:api/tbbeneficiaries/(:num)' => array('route' => 'TbBeneficiaries.Delete', 'params' => array('idBeneficiaries' => 2)),
		
	// TbCity
	'GET:tbcities' => array('route' => 'TbCity.ListView'),
	'GET:tbcity/(:num)' => array('route' => 'TbCity.SingleView', 'params' => array('idCity' => 1)),
	'GET:api/tbcities' => array('route' => 'TbCity.Query'),
	'POST:api/tbcity' => array('route' => 'TbCity.Create'),
	'GET:api/tbcity/(:num)' => array('route' => 'TbCity.Read', 'params' => array('idCity' => 2)),
	'PUT:api/tbcity/(:num)' => array('route' => 'TbCity.Update', 'params' => array('idCity' => 2)),
	'DELETE:api/tbcity/(:num)' => array('route' => 'TbCity.Delete', 'params' => array('idCity' => 2)),
		
	// TbFiles
	'GET:tbfileses' => array('route' => 'TbFiles.ListView'),
	'GET:tbfiles/(:num)' => array('route' => 'TbFiles.SingleView', 'params' => array('idFile' => 1)),
	'GET:api/tbfileses' => array('route' => 'TbFiles.Query'),
	'POST:api/tbfiles' => array('route' => 'TbFiles.Create'),
	'GET:api/tbfiles/(:num)' => array('route' => 'TbFiles.Read', 'params' => array('idFile' => 2)),
	'PUT:api/tbfiles/(:num)' => array('route' => 'TbFiles.Update', 'params' => array('idFile' => 2)),
	'DELETE:api/tbfiles/(:num)' => array('route' => 'TbFiles.Delete', 'params' => array('idFile' => 2)),
		
	// TbFunctions
	'GET:tbfunctionses' => array('route' => 'TbFunctions.ListView'),
	'GET:tbfunctions/(:num)' => array('route' => 'TbFunctions.SingleView', 'params' => array('idFunction' => 1)),
	'GET:api/tbfunctionses' => array('route' => 'TbFunctions.Query'),
	'POST:api/tbfunctions' => array('route' => 'TbFunctions.Create'),
	'GET:api/tbfunctions/(:num)' => array('route' => 'TbFunctions.Read', 'params' => array('idFunction' => 2)),
	'PUT:api/tbfunctions/(:num)' => array('route' => 'TbFunctions.Update', 'params' => array('idFunction' => 2)),
	'DELETE:api/tbfunctions/(:num)' => array('route' => 'TbFunctions.Delete', 'params' => array('idFunction' => 2)),
		
	// TbPayments
	'GET:tbpaymentses' => array('route' => 'TbPayments.ListView'),
	'GET:tbpayments/(:num)' => array('route' => 'TbPayments.SingleView', 'params' => array('idPayment' => 1)),
	'GET:api/tbpaymentses' => array('route' => 'TbPayments.Query'),
	'POST:api/tbpayments' => array('route' => 'TbPayments.Create'),
	'GET:api/tbpayments/(:num)' => array('route' => 'TbPayments.Read', 'params' => array('idPayment' => 2)),
	'PUT:api/tbpayments/(:num)' => array('route' => 'TbPayments.Update', 'params' => array('idPayment' => 2)),
	'DELETE:api/tbpayments/(:num)' => array('route' => 'TbPayments.Delete', 'params' => array('idPayment' => 2)),
		
	// TbProgram
	'GET:tbprograms' => array('route' => 'TbProgram.ListView'),
	'GET:tbprogram/(:num)' => array('route' => 'TbProgram.SingleView', 'params' => array('idProgram' => 1)),
	'GET:api/tbprograms' => array('route' => 'TbProgram.Query'),
	'POST:api/tbprogram' => array('route' => 'TbProgram.Create'),
	'GET:api/tbprogram/(:num)' => array('route' => 'TbProgram.Read', 'params' => array('idProgram' => 2)),
	'PUT:api/tbprogram/(:num)' => array('route' => 'TbProgram.Update', 'params' => array('idProgram' => 2)),
	'DELETE:api/tbprogram/(:num)' => array('route' => 'TbProgram.Delete', 'params' => array('idProgram' => 2)),
		
	// TbRegion
	'GET:tbregions' => array('route' => 'TbRegion.ListView'),
	'GET:tbregion/(:num)' => array('route' => 'TbRegion.SingleView', 'params' => array('idRegion' => 1)),
	'GET:api/tbregions' => array('route' => 'TbRegion.Query'),
	'POST:api/tbregion' => array('route' => 'TbRegion.Create'),
	'GET:api/tbregion/(:num)' => array('route' => 'TbRegion.Read', 'params' => array('idRegion' => 2)),
	'PUT:api/tbregion/(:num)' => array('route' => 'TbRegion.Update', 'params' => array('idRegion' => 2)),
	'DELETE:api/tbregion/(:num)' => array('route' => 'TbRegion.Delete', 'params' => array('idRegion' => 2)),
		
	// TbSource
	'GET:tbsources' => array('route' => 'TbSource.ListView'),
	'GET:tbsource/(:num)' => array('route' => 'TbSource.SingleView', 'params' => array('idSource' => 1)),
	'GET:api/tbsources' => array('route' => 'TbSource.Query'),
	'POST:api/tbsource' => array('route' => 'TbSource.Create'),
	'GET:api/tbsource/(:num)' => array('route' => 'TbSource.Read', 'params' => array('idSource' => 2)),
	'PUT:api/tbsource/(:num)' => array('route' => 'TbSource.Update', 'params' => array('idSource' => 2)),
	'DELETE:api/tbsource/(:num)' => array('route' => 'TbSource.Delete', 'params' => array('idSource' => 2)),
		
	// TbState
	'GET:tbstates' => array('route' => 'TbState.ListView'),
	'GET:tbstate/(:num)' => array('route' => 'TbState.SingleView', 'params' => array('idState' => 1)),
	'GET:api/tbstates' => array('route' => 'TbState.Query'),
	'POST:api/tbstate' => array('route' => 'TbState.Create'),
	'GET:api/tbstate/(:num)' => array('route' => 'TbState.Read', 'params' => array('idState' => 2)),
	'PUT:api/tbstate/(:num)' => array('route' => 'TbState.Update', 'params' => array('idState' => 2)),
	'DELETE:api/tbstate/(:num)' => array('route' => 'TbState.Delete', 'params' => array('idState' => 2)),
		
	// TbSubfunctions
	'GET:tbsubfunctionses' => array('route' => 'TbSubfunctions.ListView'),
	'GET:tbsubfunctions/(:num)' => array('route' => 'TbSubfunctions.SingleView', 'params' => array('idSubfunction' => 1)),
	'GET:api/tbsubfunctionses' => array('route' => 'TbSubfunctions.Query'),
	'POST:api/tbsubfunctions' => array('route' => 'TbSubfunctions.Create'),
	'GET:api/tbsubfunctions/(:num)' => array('route' => 'TbSubfunctions.Read', 'params' => array('idSubfunction' => 2)),
	'PUT:api/tbsubfunctions/(:num)' => array('route' => 'TbSubfunctions.Update', 'params' => array('idSubfunction' => 2)),
	'DELETE:api/tbsubfunctions/(:num)' => array('route' => 'TbSubfunctions.Delete', 'params' => array('idSubfunction' => 2)),

	// catch any broken API urls
	'GET:api/(:any)' => array('route' => 'Default.ErrorApi404'),
	'PUT:api/(:any)' => array('route' => 'Default.ErrorApi404'),
	'POST:api/(:any)' => array('route' => 'Default.ErrorApi404'),
	'DELETE:api/(:any)' => array('route' => 'Default.ErrorApi404')
);

/**
 * FETCHING STRATEGY
 * You may uncomment any of the lines below to specify always eager fetching.
 * Alternatively, you can copy/paste to a specific page for one-time eager fetching
 * If you paste into a controller method, replace $G_PHREEZER with $this->Phreezer
 */
// $GlobalConfig->GetInstance()->GetPhreezer()->SetLoadType("TbCity","fk_tb_city_tb_state",KM_LOAD_EAGER); // KM_LOAD_INNER | KM_LOAD_EAGER | KM_LOAD_LAZY
// $GlobalConfig->GetInstance()->GetPhreezer()->SetLoadType("TbPayments","fk_tb_payments_tb_action1",KM_LOAD_EAGER); // KM_LOAD_INNER | KM_LOAD_EAGER | KM_LOAD_LAZY
// $GlobalConfig->GetInstance()->GetPhreezer()->SetLoadType("TbPayments","fk_tb_payments_tb_beneficiaries1",KM_LOAD_EAGER); // KM_LOAD_INNER | KM_LOAD_EAGER | KM_LOAD_LAZY
// $GlobalConfig->GetInstance()->GetPhreezer()->SetLoadType("TbPayments","fk_tb_payments_tb_city1",KM_LOAD_EAGER); // KM_LOAD_INNER | KM_LOAD_EAGER | KM_LOAD_LAZY
// $GlobalConfig->GetInstance()->GetPhreezer()->SetLoadType("TbPayments","fk_tb_payments_tb_files1",KM_LOAD_EAGER); // KM_LOAD_INNER | KM_LOAD_EAGER | KM_LOAD_LAZY
// $GlobalConfig->GetInstance()->GetPhreezer()->SetLoadType("TbPayments","fk_tb_payments_tb_functions1",KM_LOAD_EAGER); // KM_LOAD_INNER | KM_LOAD_EAGER | KM_LOAD_LAZY
// $GlobalConfig->GetInstance()->GetPhreezer()->SetLoadType("TbPayments","fk_tb_payments_tb_program1",KM_LOAD_EAGER); // KM_LOAD_INNER | KM_LOAD_EAGER | KM_LOAD_LAZY
// $GlobalConfig->GetInstance()->GetPhreezer()->SetLoadType("TbPayments","fk_tb_payments_tb_source1",KM_LOAD_EAGER); // KM_LOAD_INNER | KM_LOAD_EAGER | KM_LOAD_LAZY
// $GlobalConfig->GetInstance()->GetPhreezer()->SetLoadType("TbPayments","fk_tb_payments_tb_subfunctions1",KM_LOAD_EAGER); // KM_LOAD_INNER | KM_LOAD_EAGER | KM_LOAD_LAZY
// $GlobalConfig->GetInstance()->GetPhreezer()->SetLoadType("TbState","fk_tb_state_tb_region1",KM_LOAD_EAGER); // KM_LOAD_INNER | KM_LOAD_EAGER | KM_LOAD_LAZY
?>