<?php defined( '_JEXEC' ) or die( 'Restricted access' );
require_once dirname(__FILE__) . '/helper.php';

$moduleclass_sfx = htmlspecialchars($params->get('moduleclass_sfx'));
$lang = JFactory::getLanguage()->getTag();
$app         = JFactory::getApplication();
$option   = $app->input->getCmd('option', '');

if( $option == 'com_jshopping'){
    $category_id = JRequest::getInt('category_id');
    $description = modJspDescCatHelper::getDescriptionCategory($category_id, $lang);
}else{
    echo '<p>JoomShopping is not current component</p>';
}
    require JModuleHelper::getLayoutPath('mod_jsp_products_gc', $params->get('layout', 'default'));

