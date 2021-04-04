<?php
defined( '_JEXEC' ) or die( 'Restricted access' );

require_once (JPATH_SITE.'/components/com_jshopping/lib/factory.php'); 
require_once (JPATH_SITE.'/components/com_jshopping/lib/functions.php');

class JFormFieldCategories extends JFormField {

    protected $type = 'categories';

    public function getInput() {
        $categories = buildTreeCategory(1);
        $first_el = JHTML::_('select.option', 0, JText::_('JALL'), 'category_id', 'name' );
        array_unshift($categories, $first_el);
        return JHTML::_('select.genericlist', $categories, $this->name, 'size="10" multiple class = "inputbox" ', 'category_id', 'name', $this->value);
    }
}