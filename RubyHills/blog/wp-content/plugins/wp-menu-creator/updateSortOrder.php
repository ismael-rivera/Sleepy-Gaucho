<?php
// Copyright: Copyright(c) 2008 - 2009 The UltimateIDX - All Rights Reserved
// Publisher: The UltimateIDX - Real Estate WordPress Solutions
// Plugin URL: http://www.ultimateidx.com/menu-creator/
// Version: 1.1.6 for WordPress 2.8+
// Support: http://www.ultimateidx.com/
// Support Contact: Jared Ritchey

require_once("../../../wp-config.php");
$menu_id = $_GET['menu_id'];

function getLevel($it = null, $id = null){
	global $menu_id, $wpdb;
	$level = 1;
	if(!$it && $id)
	$it = $wpdb->get_row("SELECT * FROM " . $wpdb->prefix."menuitems WHERE id=$id AND menu = $menu_id");
	while($it->parent>0){
		$it = $wpdb->get_row("SELECT * FROM " . $wpdb->prefix."menuitems WHERE id=".$it->parent." AND menu = $menu_id");
		$level++;
	}
	return $level;
}

function getParent($id)
{
	global $menu_id,$wpdb;
	$sql = "SELECT * FROM " . $wpdb->prefix."menuitems WHERE id=$id AND menu = $menu_id";
	$par = $wpdb->get_row($sql);
	return $par->parent;
}

function getParentAtLevel($id, $lev = 1)
{
	global $menu_id, $wpdb;
	$par = $id;
	
	for($z=0;$z<$lev;$z++){

		$par = getParent($par);
		
	}
	return $par;
	
}

if(!$menu_id) die('failed!');
$menu_items = $_POST['the_list'];
$first_item = $wpdb->get_row("SELECT * FROM " . $wpdb->prefix."menuitems WHERE `order`=0 AND `parent`=0 AND menu = $menu_id");
$last_parent_id = $first_item->id;
$last_parent_level = 1;
$i = 0;
$pi = 0;
$orders = array();
for($p=0;$p<20;$p++) $orders[$p] = 0;
foreach($menu_items as $key => $value){
	$item = $wpdb->get_row("SELECT * FROM " . $wpdb->prefix."menuitems WHERE id=$value AND menu = $menu_id");
	$old_level = getLevel($item);
//	echo "<BR>old level: ".$old_level." last_parent_level: ".$last_parent_level.", last_parent_id: ".$last_parent_id."<BR>";
	if($old_level == $last_parent_level){
		$new_level = $old_level;
		$add_parent = '';
		$order = $i;
		$pi = 0;
		$orders[$new_level]++;
	}else if($old_level > $last_parent_level){
		$l = $old_level - $last_parent_level;
		$new_parent = $last_parent_id;
		$new_level = getLevel('',$new_parent)+1;
		$add_parent = ', parent = '.$new_parent;
		$order = $i;
		$pi = 0;
		$orders[$new_level] = 1;
	}else{
		$l = $last_parent_level - $old_level;
		$new_parent = getParentAtLevel($last_parent_id, $l+1);
		$new_level = getLevel('',$new_parent);
		$add_parent = ', parent = '.$new_parent;
		$order = $i;
		$pi = 0;
		$orders[$new_level]++;
	}
	if($new_parent) $add_parent = ', parent='.$new_parent;
//	echo "new level: ".$new_level." new_parent".$new_parent."<br>";
	$last_parent_id = $value;
	$last_parent_level = $new_level;
	$i++;


$query = "UPDATE " . $wpdb->prefix."menuitems SET `order` = ".$orders[$new_level]." $add_parent WHERE id = $value AND menu = $menu_id";
//echo $query."<br><br>";
$wpdb->query($query);
$wpdb->insert_db;
}

/*
if(!$menu_id) die('failed!');
$menu_items = $_POST['the_list'];
$first_item = $wpdb->get_row("SELECT * FROM " . $wpdb->prefix."menuitems WHERE `order`=0 AND `parent`=0 AND menu = $menu_id");
$last_parent_id = $first_item->id;
$i = 0;
$pi = 0;
foreach($menu_items as $key => $value){
	$item = $wpdb->get_row("SELECT * FROM " . $wpdb->prefix."menuitems WHERE id=$value AND menu = $menu_id");
	if($item->parent == '' || $item->parent == 0){
		$last_parent_id = $value;
		$add_parent = '';
		$order = $i;
		$pi = 0;
	}else{
		$add_parent = ', parent = '.$last_parent_id;
		$order = $pi;
	}
$query = "UPDATE " . $wpdb->prefix."menuitems SET `order` = $order $add_parent WHERE id = $value AND menu = $menu_id";
echo $query."<br>";
	$wpdb->query($query);
	$wpdb->insert_db;
if($item->parent == '' || $item->parent == 0){
$i++;	
}else{
$pi++;
}
}
*/
echo "<b>Menu Order Updated</b>";
?>