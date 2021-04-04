<?php
	defined('_JEXEC') or die;
?>
<?php if(trim($description)){ ?>
    <div class="mod_jsp_desc_cat<?php echo $moduleclass_sfx;?>">
        <?php echo $description; ?>
    </div>
<?php } ?>