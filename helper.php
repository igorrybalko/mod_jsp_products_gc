<?php
defined( '_JEXEC' ) or die( 'Restricted access' );

class modJspDescCatHelper{

    public static function getDescriptionCategory($cat_id, $lang){

        if((int)$cat_id > 0) {
            $db = JFactory::getDBO();
            $query = "SELECT `description_" . $lang . "` FROM #__jshopping_categories WHERE category_id = $cat_id";
            $db->setQuery($query);
            $description = $db->loadResult();
            return $description;
        }else{
            return '<p>A category ID is missing </p>';
        }
    }
}