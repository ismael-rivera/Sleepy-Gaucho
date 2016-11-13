<?php
// Copyright: Copyright(c) 2008 - 2009 The UltimateIDX - All Rights Reserved
// Publisher: The UltimateIDX - Real Estate WordPress Solutions
// Plugin URL: http://www.ultimateidx.com/menu-creator/
// Version: 1.1.6 for WordPress 2.8+
// Support: http://www.ultimateidx.com/
// Support Contact: Jared Ritchey
?>
<div class="wrap">
<?php if ($msg != "") : ?> <div id="message" class="updated fade"><p><?php echo $msg; ?></p></div><br /><?php endif; ?>
<h2>Edit This Menu - <?php echo $menu->title; ?></h2>
<?php 
$menuitems = getMenuItems($_GET["id"]);
include("menu.item.list.php");
?>
<div style="height: 10px;"></div>
<form name="editcat" id="editcat" method="post" action="?page=mc-edit-menu&id=<?php echo $_GET["id"]; ?>" onsubmit="return validate(this)">
<input type="hidden" name="action" value="createmenuitem" />
<input type="hidden" name="id" value="<?php echo $_GET["id"]; ?>" />
<h2>Create New Menu Item</h2>
<?php include("menu.item.table.php"); ?>
<p class="submit"><input type="submit" class="button" name="submit" value="Create Menu Item" /></p>
</form>
</div>
</div><!-- wpbody -->
</div><!-- wpcontent -->
</div><!-- wpwrap -->