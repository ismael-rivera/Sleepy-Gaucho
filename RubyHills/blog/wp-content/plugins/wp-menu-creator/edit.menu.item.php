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
<form name="editcat" id="editcat" method="post" action="?page=mc-edit-menu&id=<?php echo $mi->menu; ?>" onsubmit="return validate(this)">
<input type="hidden" name="action" value="updatemenuitem" />
<input type="hidden" name="id" value="<?php echo $_GET["id"]; ?>" />
<h2>Edit Menu Item</h2>
<?php include("menu.item.table.php"); ?>
<p class="submit"><input type="submit" class="button" name="submit" value="Update Menu Item" /></p>
</form>
</div>
</div><!-- wpbody -->
</div><!-- wpcontent -->
</div><!-- wpwrap -->