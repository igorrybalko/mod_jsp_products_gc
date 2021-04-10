<?php
/**
 * @package mod_jsp_products_gc
 * @author Rybalko Igor
 * @version 0.1.0
 * @copyright (C) 2021 https://greencomet.net
 * @license GNU/GPL: http://www.gnu.org/copyleft/gpl.html
*/

defined( '_JEXEC' ) or die( 'Restricted access' );

require_once (JPATH_SITE.'/components/com_jshopping/lib/factory.php'); 
require_once (JPATH_SITE.'/components/com_jshopping/lib/functions.php');

class modJspProductsGcHelper{

    public static function getProducts($type, $sortBy, $orderBy, $catId, $prodId, $count = 5){

        if(!$catId || in_array(0, $catId) ){
            $catId = buildTreeCategory(1);

            $ids = array_map('self::prepCatIds', $catId);

            $cats = implode(', ', $ids);

        }else{
            $cats = implode(', ', $catId);
        }

        $lang = JFactory::getLanguage()->getTag();
        $db = JFactory::getDBO();
        $limit = '';
        $catQuery = '';
        $prods = [];
        $prodIds = [];

        if($orderBy == 'name'){
            $orderBy = "p.`name_$lang`";
        }

        if(!strlen($prodId)){
            $type = '1';
        }else{
            
            $prArrId = explode(',', $prodId);

            foreach($prArrId as $val){

                $val = (int) trim($val);
                if($val > 0){
                    $prods[] = $val;
                }
            }

            if(!count($prods)){
                $type = '1';
            }else{
                $prodIds = implode(', ', $prods);
            }
        }

        if($type == '1'){
            $limit = " LIMIT " . $count;
            $addQuery = "AND pc.category_id IN ($cats)";
        }

        if($type == 2){
            $addQuery = "AND p.product_id IN ($prodIds)"; 
        }

        $query = "SELECT p.product_id, p.product_price, p.product_old_price, p.image, p.`name_$lang` as prod_name, 
        p.`short_description_$lang` as short_desc, c.`name_$lang` as category_name, c.category_id 
        FROM `#__jshopping_products` AS p 
        JOIN `#__jshopping_products_to_categories` AS pc ON pc.product_id = p.product_id 
        JOIN `#__jshopping_categories` AS c ON pc.category_id = c.category_id
        WHERE p.product_publish = '1' AND c.category_publish='1' $addQuery 
        ORDER BY $orderBy $sortBy $limit;";

        $db->setQuery($query);
        $result = $db->loadObjectList();
        
        return $result;
  
    }

    public static function prepCatIds($el){
        return $el->category_id;
    }
}