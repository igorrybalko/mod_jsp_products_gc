<?php 
/**
 * @package mod_jsp_products_gc
 * @author Rybalko Igor
 * @version 0.1.0
 * @copyright (C) 2021 https://greencomet.net
 * @license GNU/GPL: http://www.gnu.org/copyleft/gpl.html
*/

defined( '_JEXEC' ) or die( 'Restricted access' );

if (!file_exists(JPATH_SITE.'/components/com_jshopping/jshopping.php')){
    JError::raiseError(500,"Please install component \"joomshopping\"");
}

require_once dirname(__FILE__) . '/helper.php';

$moduleclass_sfx = htmlspecialchars($params->get('moduleclass_sfx'));

$jshopConfig = JSFactory::getConfig();
$doc = JFactory::getDocument();

$type = $params->get('type', '');
$prodId = htmlspecialchars($params->get('prodId', ''));
$catId = $params->get('catId', 0);
$count = $params->get('count', 4);
$orderBy = $params->get('orderBy','p.product_id');
$sortBy = $params->get('sortBy', 'ASC');
$showSd = $params->get('showSd', 0);
$showBuyLink = $params->get('showBuyLink', 1);
$showPrice = $params->get('showPrice', 1);
$offCss = $params->get('offCss', 0);

if(!$offCss){
    $doc->addStyleSheet(JURI::base() . 'modules/' . basename(dirname(__FILE__)) . '/css/default.css');
}

$products = modJspProductsGcHelper::getProducts($type, $sortBy, $orderBy, $catId, $prodId, $count);

$noimage = $jshopConfig->noimage ? $jshopConfig->noimage : 'noimage.gif';

require JModuleHelper::getLayoutPath('mod_jsp_products_gc', $params->get('layout', 'default'));