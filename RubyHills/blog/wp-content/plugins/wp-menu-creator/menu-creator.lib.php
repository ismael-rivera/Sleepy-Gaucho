<?php
// Copyright: Copyright(c) 2008 - 2009 The UltimateIDX - All Rights Reserved
// Publisher: The UltimateIDX - Real Estate WordPress Solutions
// Plugin URL: http://www.ultimateidx.com/menu-creator/
// Version: 1.1.6 for WordPress 2.8+
// Support: http://www.ultimateidx.com/
// Support Contact: Jared Ritchey

function getRSSData($num, $url)
{
	//include_once(get_bloginfo('url').'/wp-content/plugins/wp-menu-creator/simplepie/simplepie.inc');
	include_once('simplepie/simplepie.inc');
	$feed = new SimplePie();
	$feed->set_feed_url($url);
	$feed->enable_cache(false);
	$feed->init();
	// loop through items
	foreach($feed->get_items(0,$num) as $key=>$item)
	{
	$link = $item->get_link();
	// display item title and date    
	echo '<a href="' . $link . '" target="_blank">' . $item->get_title() . '</a>';
	echo ' <small>'.$item->get_date().'</small><br />';
	echo ' <small>'.substr($item->get_description(), 0, 100).'...</small><br />';
	echo '<br />';
	}
}

function getMenus($max = -1) {
	global $wpdb;
	$results = $wpdb->get_results("SELECT id, title FROM ".$wpdb->prefix."menus");
	return $results;
}

function getMenuInfo($id) {
	global $wpdb;
	$results = $wpdb->get_row("SELECT id, title FROM ".$wpdb->prefix."menus WHERE id=$id");
	return $results;
}

function getMenuItem($id) {
	global $wpdb;
	$results = $wpdb->get_row("SELECT * FROM " . $wpdb->prefix."menuitems WHERE id=$id");
	return $results;
}

function getMenuItems($id) {
	global $wpdb;
	$results = $wpdb->get_results("SELECT * FROM " . $wpdb->prefix."menuitems WHERE menu=$id AND parent = 0 ORDER BY `order`");
	$items = array();
	if ($results) {
		foreach ($results as $menuitem) {
			$mi = createMenuItem($menuitem->id);
			$items[] = $mi;
		}
	}
	return $items;
}

function getSubitems($id) {
	global $wpdb;
	$results = $wpdb->get_results("SELECT * FROM " . $wpdb->prefix."menuitems WHERE parent = $id ORDER BY `order`");
	return $results;
}

function createMenuItem($itemid) {
	global $wpdb;
	$item = $wpdb->get_row("SELECT * FROM " . $wpdb->prefix."menuitems WHERE id=$itemid ORDER BY `order`");
	$newitem["id"] = $item->id;
	$newitem["title"] = $item->title;
	$newitem["type"] = $item->type;
	$newitem["value"] = $item->value;
	$newitem["order"] = $item->order;
	$newitem["target"] = $item->target;
	$newitem["alttext"] = $item->alttext;
	$newitem["parent"] = $item->parent;
	$newitem["menu"] = $item->menu;
	$newitem["subitems"] = array();
	$subitems = getSubitems($item->id);
	if ($subitems) {
		foreach ($subitems as $subitem) {
			$newitem["subitems"][] = createMenuItem($subitem->id);
		}
	}
	return $newitem;
}

function createMenu($title) {
	global $wpdb;
	$wpdb->query("INSERT INTO " . $wpdb->prefix."menus (title) VALUES ('$title')");
	return $wpdb->insert_db;
}

function getMenuCount($id) {
	global $wpdb;
	$results = $wpdb->get_var("SELECT COUNT(*) FROM " . $wpdb->prefix."menuitems WHERE menu=$id");
	return (int)$results;
}

function updateMenuItem($data) {
	global $wpdb;
	$SQL  = "UPDATE " . $wpdb->prefix."menuitems SET ";
	$SQL .= "title = '" . $data["title"] . "', ";
	$SQL .= "type = '" . $data["type"] . "', ";
	$SQL .= "value = '" . $data["value"] . "', ";
	$SQL .= "target = '" . $data["target"] . "', ";
	$SQL .= "alttext = '" . $data["alttext"] . "', ";
	$SQL .= "`order` = " . $data["order"] . ", ";
	$SQL .= "`parent` = " . $data["parent"];
	$SQL .= " WHERE id=" . $data["id"];
	$wpdb->query($SQL);
}

function createNewMenuItem($menuid, $data) {
	global $wpdb;
	$SQL  = "INSERT INTO " . $wpdb->prefix."menuitems (title, type, value, target, alttext, `order`, `parent`, menu) VALUES (";
	$SQL .= "'" . $data["title"] . "', ";
	$SQL .= "'" . $data["type"] . "', ";
	$SQL .= "'" . $data["value"] . "', ";
	$SQL .= "'" . $data["target"] . "', ";
	$SQL .= "'" . $data["alttext"] . "', ";
	$SQL .= (int)$data["order"] . ", ";
	$SQL .= (int)$data["parent"] . ", ";
	$SQL .= $menuid . ")";
	$wpdb->query($SQL);
}

function deleteMenuItem($id) {
	$mi = createMenuItem($id);
	foreach ($mi["subitems"] as $si) {
		deleteMenuItem($si["id"]);
	}
	global $wpdb;
	$SQL = "DELETE FROM " . $wpdb->prefix."menuitems WHERE id=$id";
	$wpdb->query($SQL);
}

function deleteMenu($id) {
	$items = getMenuItems($id);
	foreach ($items as $i) {
		deleteMenuItem($i["id"]);
	}
	global $wpdb;
	$SQL = "DELETE FROM ". $wpdb->prefix."menus WHERE id=$id";
	$wpdb->query($SQL);
}

/* Display Functions */
function displayMenu($id, $depth = 0) {
	$items = getMenuItems($id);
	displayMenuFromItems($items, $depth, $id, true);
}

function displayRandomizedMenu($menuID, $numItems)
{
	$items = getMenuItems($menuID);
	shuffle($items);
	$i=0; $newitems = array();
	foreach ($items as $item) {
		if ($i>=$numItems) continue;
		$newitems[] = $item;
		$i++;
	}
	displayMenuFromItems($newitems, 6, $menuID, true);
}

function displayMenuFromItems($items, $depth, $parent, $ismenu) {
	if ($items) :
		echo "\n".'<ul id="' . ($ismenu ? "mc_menu_".$parent : "mc_submenu_" . $parent) . '" class="mc_menu mc_depth_' . $depth . '">'."\n";
		foreach ($items as $item) :
		$class="";
		if ($item["type"] == "wordpress") {
			if (is_page($item["value"])) {
				$class="current_page_item";
			}
		} else {
			if (curPageURL() == $item["value"] || curPageURL() == $item["value"] . "/") {
				$class="current_page_item";
			}
		}
		echo '<li id="menu_item_' . $item["id"] . '" class="mc_menu_item ' . ($item["type"] == "wordpress" ? "wordpress_link" : "external_link") . ' ' . $class . '"><a href="' . resolveURL($item) . '" title="' . $item["alttext"] . '" rel="' . $item["target"] . '" >' . $item["title"] . '</a>';
			if ($depth>0) displayMenuFromItems($item["subitems"], $depth-1, $item["id"], false);
		echo '</li>'."\n";
		endforeach;
		echo '</ul>'."\n";
	endif;
}

function resolveURL($item) {
	if ($item["type"] == "wordpress") {
		$id = $item["value"];
// Updated May 14th
		$perma =  get_permalink($id);	
	if(strpos($_SERVER["REQUEST_URI"], "wp-admin")){
	$url = explode("/",$perma, 4);
	if(count($url)>2)
	return $url[3];
	}
	return $perma;
// End Updated May 14th
	} else {
		return $item["value"];
	}
}

function curPageURL() {
 $pageURL = 'http';
 if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
 $pageURL .= "://";
 if ($_SERVER["SERVER_PORT"] != "80") {
  $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
 } else {
  $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
 }
 return $pageURL;
}
?>