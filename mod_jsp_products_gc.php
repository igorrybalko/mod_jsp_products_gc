<?php defined( '_JEXEC' ) or die( 'Restricted access' );

if (!file_exists(JPATH_SITE.'/components/com_jshopping/jshopping.php')){
    JError::raiseError(500,"Please install component \"joomshopping\"");
}

//jimport('joomla.application.component.model');
//require_once (JPATH_SITE.'/components/com_jshopping/lib/factory.php'); 
//require_once (JPATH_SITE.'/components/com_jshopping/lib/functions.php');

require_once dirname(__FILE__) . '/helper.php';

$moduleclass_sfx = htmlspecialchars($params->get('moduleclass_sfx'));

$type = $params->get('type', '');
$prodId = $params->get('prodId', '');
$catId = $params->get('catId', 0);
$count = $params->get('count', 5);
$orderBy = $params->get('orderBy','p.product_id');
$sortBy = $params->get('sortBy', 'ASC');
$showSd = $params->get('showSd', 0);
$showLink = $params->get('showLink', 1);

$products = modJspProductsGcHelper::getProducts($type, $sortBy, $orderBy, $catId, $prodId, $count);

require JModuleHelper::getLayoutPath('mod_jsp_products_gc', $params->get('layout', 'default'));