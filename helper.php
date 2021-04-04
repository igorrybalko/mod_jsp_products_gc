<?php
defined( '_JEXEC' ) or die( 'Restricted access' );

class modJspProductsGcHelper{

    public static function getProducts($type, $sortBy, $orderBy, $catId, $prodId, $count){

        $lang = JFactory::getLanguage()->getTag();
        $db = JFactory::getDBO();
        $limit = '';

        if($orderBy == 'name'){
            $orderBy = 'p.'.$orderBy.'_'.$lang;
        }

        if($type == '1'){
            $limit = " LIMIT " . $count;
        }

        $query = "SELECT p.product_id, p.product_price, p.product_old_price, p.image, p.`name_$lang` as prod_name, 
        p.`short_description_$lang` as short_desc, c.`name_en-GB` as cat_name 
        FROM `#__jshopping_products` AS p 
        JOIN `#__jshopping_products_to_categories` AS pc ON pc.product_id = p.product_id 
        JOIN `#__jshopping_categories` AS c ON pc.category_id = c.category_id
        WHERE p.product_publish = '1' AND c.category_publish='1' AND pc.category_id IN (1, 2) 
        ORDER BY $orderBy $sortBy" . $limit . ";";

        $db->setQuery($query);
        $result = $db->loadObjectList();
        $products = array();
        
        return $result;
  
    }
}