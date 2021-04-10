<?php
/**
 * @package mod_jsp_products_gc
 * @author Rybalko Igor
 * @version 0.1.0
 * @copyright (C) 2021 https://greencomet.net
 * @license GNU/GPL: http://www.gnu.org/copyleft/gpl.html
*/

defined('_JEXEC') or die;
?>

<div class="gc-jsp-prods <?php echo $moduleclass_sfx;?>">
    <?php foreach ($products as $prod){ 
            $prodLink = SEFLink('index.php?option=com_jshopping&controller=product&task=view&category_id='.$prod->category_id.'&product_id='.$prod->product_id, 1);
			$buyLink = SEFLink('index.php?option=com_jshopping&controller=cart&task=add&category_id='.$prod->category_id.'&product_id='.$prod->product_id, 1);
        ?>
        <div class="gc-jsp-prod">
            <div class="gc-jsp-prod__inner">
                <div class="gc-jsp-prod__img">
                    <a href="<?php echo $prodLink?>">
                        <img src="<?php echo $jshopConfig->image_product_live_path?>/<?php echo $prod->image ? $prod->image : $noimage?>" alt="" />
                    </a>
                </div>
                <div class="gc-jsp-prod__name">
                    <a href="<?php echo $prodLink?>">
                        <?php echo $prod->prod_name?>
                    </a>
                </div>
                <?php if($showSd){ ?>
                    <div class="gc-jsp-prod__sd">
                        <?php echo $prod->short_desc?>
                    </div>
                <?php } ?>
                <?php if($showPrice){ ?>
                    <div class="gc-jsp-prod__price">
                        <?php echo formatprice($prod->product_price);?>
                    </div>
                <?php } ?>
                <?php if ($showBuyLink) { ?>
                    <div class="gc-jsp-prod__buy">
                        <a class="btn btn-primary" href="<?php echo $buyLink?>"><?php echo _JSHOP_ADD_TO_CART?></a>
                    </div>
                <?php } ?>
            </div>
        </div>
    <?php }?>
</div>