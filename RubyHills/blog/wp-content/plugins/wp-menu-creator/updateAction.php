<?php
// Copyright: Copyright(c) 2008 - 2009 The UltimateIDX - All Rights Reserved
// Publisher: The UltimateIDX - Real Estate WordPress Solutions
// Plugin URL: http://www.ultimateidx.com/menu-creator/
// Version: 1.1.6 for WordPress 2.8+
// Support: http://www.ultimateidx.com/
// Support Contact: Jared Ritchey

require_once("../../../wp-config.php");
if($_GET['level']){
	switch($_GET['level']){
		
		case 'down':
			$item = $wpdb->get_row("SELECT * FROM " .$wpdb->prefix."menuitems WHERE id=".$_GET['item_id']." AND menu=".$_GET["id"]);
			$item_above = $wpdb->get_row("SELECT * FROM ".$wpdb->prefix."menuitems WHERE parent=".$item['parent']." AND `order`<".$item['order']." AND menu=".$_GET['id']." ORDER BY `order` DESC LIMIT 1");
			$item_above_last_subitem = $wpdb->get_row("SELECT * FROM ".$wpdb->prefix."menuitems WHERE parent=".$item_above['id']." AND menu=".$_GET['id']." ORDER BY `order` DESC LIMIT 1");
			$sql = "UPDATE ".$wpdb->prefix."menuitems SET parent=".$item_above['id'].", `order`=".($item_above_last_subitem['order']+1)." WHERE id=".$item['id']." AND menu=".$_GET['id'];
			echo $sql."<BR>";
			$res = $wpdb->query($sql);
			$sql = "UPDATE ".$wpdb->prefix."menuitems set `order`= `order`-1 WHERE parent=".$item['parent']." AND `order` > ".$item['order']." AND menu=".$_GET['id'];
			echo $sql."<BR>";
			$update = $wpdb->query($sql);
			
		break;
		case 'up':
			$item = $wpdb->get_row("SELECT * FROM " .$wpdb->prefix."menuitems WHERE id=".$_GET['item_id']." AND menu=".$_GET['id']);
			$parent_item = $wpdb->get_row("SELECT * FROM ".$wpdb->prefix."menuitems WHERE id=".$item['parent']." AND menu=".$_GET['id']);
			$update = $wpdb->query("UPDATE ".$wpdb->prefix."menuitems SET `order` = `order`+1 WHERE parent=".$parent_item['parent']." AND `order` > ".$parent_item['order']." AND menu=".$_GET['id']);
			$res = $wpdb->query("UPDATE ".$wpdb->prefix."menuitems SET parent=".$parent_item['parent']." AND `order` =".($parent_item['order']+1)." WHERE id=".$item['id']." AND menu=".$_GET['id']);
			$update = $wpdb->query("UPDATE ".$wpdb->prefix."menuitems SET `order`=`order`-1 WHERE `order` > ".$item['order']." AND parent=".$item['parent']." AND menu=".$_GET['id']);
		break;
	}
}
?>