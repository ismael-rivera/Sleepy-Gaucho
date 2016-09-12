<?php
// Copyright: Copyright(c) 2008 - 2009 The UltimateIDX - All Rights Reserved
// Publisher: The UltimateIDX - Real Estate WordPress Solutions
// Plugin URL: http://www.ultimateidx.com/menu-creator/
// Version: 1.1.6 for WordPress 2.8+
// Support: http://www.ultimateidx.com/
// Support Contact: Jared Ritchey

function hasFriendAbove($parent_id, $order)
{
	global $wpdb;
	$sql = "SELECT * FROM " .$wpdb->prefix."menuitems WHERE parent=$parent_id AND `order` < $order AND menu=".$_GET["id"];
//	echo $sql."<BR>";
	$item = $wpdb->get_row($sql);

	if($item) return true;
	
	return false;
	
}

function hasChild($id)
{
	global $wpdb;
	
	$item = $wpdb->get_row("SELECT * FROM " .$wpdb->prefix."menuitems WHERE parent=$id AND menu=".$_GET["id"]);
	
	if($item) return true;
	
	return false;
	
}

	global $wpdb;
if($_GET['level']){
	
	switch($_GET['level']){
		
		case 'down':
			$item = $wpdb->get_row("SELECT * FROM " .$wpdb->prefix."menuitems WHERE id=".$_GET['item_id']." AND menu=".$_GET["id"]);
			$item_above = $wpdb->get_row("SELECT * FROM ".$wpdb->prefix."menuitems WHERE parent=".$item->parent." AND `order`<".$item->order." AND menu=".$_GET['id']." ORDER BY `order` DESC LIMIT 1");
			$item_above_last_subitem = $wpdb->get_row("SELECT * FROM ".$wpdb->prefix."menuitems WHERE parent=".$item_above->id." AND menu=".$_GET['id']." ORDER BY `order` DESC LIMIT 1");
			$sql = "UPDATE ".$wpdb->prefix."menuitems SET parent=".$item_above->id.", `order`=".($item_above_last_subitem->order+1)." WHERE id=".$item->id." AND menu=".$_GET['id'];
	//		echo $sql."<BR>";
			$res = $wpdb->query($sql);
			$sql = "UPDATE ".$wpdb->prefix."menuitems set `order`= `order`-1 WHERE parent=".$item->parent." AND `order` > ".$item->order." AND menu=".$_GET['id'];
	//		echo $sql."<BR>";
			$update = $wpdb->query($sql);
			
		break;
		case 'up':
			$item = $wpdb->get_row("SELECT * FROM " .$wpdb->prefix."menuitems WHERE id=".$_GET['item_id']." AND menu=".$_GET['id']);
			$parent_item = $wpdb->get_row("SELECT * FROM ".$wpdb->prefix."menuitems WHERE id=".$item->parent." AND menu=".$_GET['id']);
			
			$sql = "UPDATE ".$wpdb->prefix."menuitems SET `order` = `order`+1 WHERE parent=".$parent_item->parent." AND `order` > ".$parent_item->order." AND menu=".$_GET['id'];
	//		echo $sql."<BR>";
			$update = $wpdb->query($sql);
			
			$sql = "UPDATE ".$wpdb->prefix."menuitems SET parent=".$parent_item->parent.", `order` =".($parent_item->order+1)." WHERE id=".$item->id." AND menu=".$_GET['id'];
	//		echo $sql."<BR>";
			$res = $wpdb->query($sql);
			
			
			$sql = "UPDATE ".$wpdb->prefix."menuitems SET `order`=`order`-1 WHERE `order` > ".$item->order." AND parent=".$item->parent." AND menu=".$_GET['id'];
	//		echo $sql;
			$update = $wpdb->query($sql);
		
		break;
		
	}
	
	
}


?>
<script type='text/javascript' src='<?php bloginfo('wpurl') ?>/wp-includes/js/prototype.js'></script>
<script type='text/javascript' src='<?php bloginfo('wpurl') ?>/wp-includes/js/scriptaculous/scriptaculous.js'></script>
<script language="JavaScript" type="text/javascript">
  function confirmDelete(anchor)
  {
    if (confirm('You are about to delete this item and you will not be able to undo, are you sure?'))
    {
      anchor.href += '&confirm=1';
      return true;
    }
    return false;
  }

function refreshSortableList()
{
	var url =  "<?php bloginfo('wpurl') ?>/wp-content/plugins/wp-menu-creator/updateSortOrder.php?menu_id=<?php echo $_GET['id'];?>";
Sortable.create('the_list', {onUpdate:function(){new Ajax.Updater('status', url, {asynchronous:true, evalScripts:false, parameters:Sortable.serialize('the_list')})}, only:'alternate', tag:'li'})
}
</script>
<?php //bloginfo('wpurl'); ?>
<style type="text/css">
.mclist{border-bottom: 1px solid #ccc; display:block; height:28px;}
.itemrows{height:28px !Important;}
#wpmenucreatorw li{padding:0px; margin:0px; line-height:100% !Important;}
#wpmenucreatorw td{margin:0; padding:3px 5px; overflow:hidden;}
.verticalback{}
span.urlvalue{width:310px; overflow:hidden; display:block; height:24px;}
</style>
<div style="width:780px" id="wpmenucreatorw">
<span id='status' style="color: green;"></span>

<table class="widefat" width="780" cellpadding="0" cellspacing="0">
<thead>
<tr>
<th scope="col" width="30">ID</th>
<th scope="col" width="220">Link Name</th>
<th scope="col" width="60">Type</th>
<th scope="col" width="320">URL Value</th>
<th scope="col" width="80" align="center">Level</th>
<th scope="col" width="70" align="center">Edit / Del</th>
</tr>
</thead>
<!--
<tfoot>
<tr>
<th scope="col" style="width: 40px; text-align:center">ID</th>
<th scope="col" style="width: 240px; text-align: left;">Title</th>
<th scope="col" style="width: 50px; text-align: left;">Type</th>
<th scope="col" style="width: 240px; text-align: center;">Value</th>
<th scope="col" style="width: 50px; text-align: center;">Order</th>
<th scope="col" style="width: 100px; text-align: center;" colspan="1">Action</th>
</tr>
</tfoot>
-->
</table>


<ul id="the_list" style="list-style-type:none; padding:0; margin:0;">

<?php	
    $menuitems = getMenuItems($_GET["id"]);
	if ($menuitems) :
	  	foreach ($menuitems as $menuitem) :
			processRow($menuitem, 0);
		endforeach;
	endif;
	function processRow($menuitem, $indent) {
		printRow($menuitem, $indent);
		if (count($menuitem["subitems"]) > 0) {
			foreach($menuitem["subitems"] as $item) {
				processRow($item, $indent+1);
			}
		}
	}
	function printRowTest($menuitem, $indent=0){
	}
	function printRow($menuitem, $indent=0) {
// Updated code May 14th 2009
$title = $menuitem["title"];
if((strpos($menuitem["title"],"<img") || strpos($menuitem["title"],"< img")) >= 0){
	$title = str_replace(">", " \"height=16\">", $menuitem["title"]);
}
// End Updated code May 14th 2009
?>
<?php //$thepluginurl = bloginfo('wpurl');?>

<li id='item_<?php echo $menuitem["id"]; ?>' class='alternate mclist'>
<table width="780" cellpadding="3" cellspacing="0">
<tr class="itemrows">
<td scope="row" width="30" valign="top" align="center"><?php echo $menuitem["id"]; ?></td>
<td scope="row" width="220" valign="top" align="left" ><?php for($i=0; $i<$indent; $i++) { echo "&rArr; "; } ?><a class="edit" href="?page=mc-edit-menuitem&id=<?php echo $menuitem["id"]; ?>"><?php echo $title; ?></a></td>
<td scope="row" width="60" valign="top" align="left"><?php echo $menuitem["type"]; ?></td>
<td scope="row" width="320" valign="top" align="left"><span class="urlvalue"><?php echo ($menuitem["type"] == "wordpress" ? "(" . $menuitem["value"] . ") " : ""); echo resolveURL($menuitem); ?></span></td>
<td scope="row" width="80" valign="top" align="left"><?php //echo $menuitem['order']."&nbsp;&nbsp;";
if(!hasChild($menuitem['id']) && $menuitem['parent'] > 0) echo "<a href='?page=mc-edit-menu&id=".$menuitem['menu']."&level=up&item_id=".$menuitem['id']."'><img src='../wp-content/plugins/wp-menu-creator/images/up.gif' />"."</a>&nbsp;";
if(hasFriendAbove($menuitem['parent'], $menuitem['order'])) echo "<a href='?page=mc-edit-menu&id=".$menuitem['menu']."&level=down&item_id=".$menuitem['id']."'><img src='../wp-content/plugins/wp-menu-creator/images/down.gif' />"."</a>"; 
?> &nbsp;</td>
<td scope="row" width="5" valign="top" class="verticalback">&nbsp;</td>
<td scope="row" valign="top" width="65" align="left"><a class="edit" href="?page=mc-edit-menuitem&id=<?php echo $menuitem["id"]; ?>"><img src="<?php bloginfo('wpurl') ?>/wp-content/plugins/wp-menu-creator/images/edit.gif" /></a>&nbsp;&nbsp;&nbsp;<a href='?page=mc-edit-menu&action=deletemenuitem&id=<?php echo $menuitem["menu"]; ?>&target=<?php echo $menuitem["id"]; ?>' class="delete" onclick="return confirmDelete(this);"><img src="<?php bloginfo('wpurl') ?>/wp-content/plugins/wp-menu-creator/images/delete.gif" /></a></td>
</tr>
</table>
</li>
<?php }  ?>

</ul>

<div id="lis"></div>
<script language="JavaScript" type="text/javascript">
refreshSortableList();
</script>
</div>