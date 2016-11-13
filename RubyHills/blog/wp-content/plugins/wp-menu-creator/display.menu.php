<?php
// Copyright: Copyright(c) 2008 - 2009 The UltimateIDX - All Rights Reserved
// Publisher: The UltimateIDX - Real Estate WordPress Solutions
// Plugin URL: http://www.ultimateidx.com/menu-creator/
// Version: 1.1.6 for WordPress 2.8+
// Support: http://www.ultimateidx.com/
// Support Contact: Jared Ritchey
?>
<link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.7.0/build/tabview/assets/skins/sam/tabview.css">
<!-- JavaScript Dependencies for Tabview: -->
<script type="text/javascript" src="http://yui.yahooapis.com/2.7.0/build/yahoo-dom-event/yahoo-dom-event.js"></script>
<script type="text/javascript" src="http://yui.yahooapis.com/2.7.0/build/element/element-min.js"></script>
<!-- OPTIONAL: Connection (required for dynamic loading of data) -->
<script type="text/javascript" src="http://yui.yahooapis.com/2.7.0/build/connection/connection-min.js"></script>
<!-- Source file for TabView -->
<script type="text/javascript" src="http://yui.yahooapis.com/2.7.0/build/tabview/tabview-min.js"></script>
<style type="text/css">
#msg {display:none; position:absolute; z-index:200; background:url(../wp-content/plugins/wp-menu-creator/images/msg_arrow.gif) left center no-repeat; padding-left:7px}
#msgcontent {display:block; background:#f3e6e6; border:2px solid #924949; border-left:none; padding:5px; min-width:150px; max-width:250px}
</style>
<script type="text/javascript" src="../wp-content/plugins/wp-menu-creator/messagesb.js"></script>
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
</script>

<div class="wrap">
<?php if ($msg != "") : ?> <div id="message" class="updated fade"><p><?php echo $msg; ?></p></div><br /><?php endif; ?>
<h2>WP Menu Manager</h2>
<!--<p>The following menus have been created, please see instructions below. Click <a href="#newmenu">here</a> to add a new menu.</p>-->
<br style="clear:both;" />
<table width="960" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td valign="top" width="510">
<!--[Begin Left Column Menu List]-->
<table class="widefat" style="width: 500px;">
	<thead>
	<tr>
    <th scope="col" style="text-align: center; width:20px">ID</th>
    <th scope="col" style="">Menu Title</th>
    <th scope="col" style="width: 100px; text-align: center;">Menu Items</th>
   	<th scope="col" colspan="1" style="text-align: center; width: 100px;">Action</th>
  	</tr>
	</thead>
	
    <tbody id="the-list">
<?php if ($posts): foreach ($posts as $p): ?>
	<tr id='page-10' class='alternate'>
	<td scope="row" style="text-align: center"><?php echo $p->id; ?></td>
	<td scope="row"><a class="edit" href="?page=mc-edit-menu&id=<?php echo $p->id?>"><?php echo $p->title; ?></a></td>
	<td style="text-align: center;"><?php echo getMenuCount($p->id); ?></td>
	<td style="text-align: center"><a class="edit" href="?page=mc-edit-menu&id=<?php echo $p->id?>">Edit</a>&nbsp;&nbsp;&nbsp;<a href='?page=wp-menu-creator&action=deletemenu&id=<?php echo $p->id?>' class="delete" onclick="return confirmDelete(this);">Delete</a></td>
	</tr>
<?php endforeach; endif; ?>
  </tbody>
</table>    
<div style="height: 5px;"></div>
<a name="newroom"></a>
<h2>Add New Menu</h2>
<div style="width:450px">
<form name="editmenu" id="editmenu" method="post" action="?page=mc-edit-menu" onsubmit="return validate(this)">
<input type="hidden" name="action" value="createmenu" />
<table class="form-table" width="400">
<tr class="form-field form-required">
<th width="103" valign="top" scope="row"><label for="menutitle">Menu Title</label></th>
<td width="285"><input name="menutitle" id="menutitle" type="text" size="40" /></td>
</tr>
</table>
<p class="submit"><input type="submit" class="button" name="submit" value="Create Menu" /></p>
</form>
</div>
<!--[END Left Column Menu List]-->
</td>
<td valign="top">
<div class="yui-skin-sam">
<script type="text/javascript">
var myTabs = new YAHOO.widget.TabView("menucreator");
</script> 

<div id="menucreator" class="yui-navset">
    <ul class="yui-nav">
        <li class="selected"><a href="#tab1"><em>Introduction</em></a></li>
        <li><a href="#tab2"><em>Instructional Guides</em></a></li>
        <li><a href="#tab3"><em>Menu Code Examples</em></a></li>
    </ul>            
    <div class="yui-content">
        <div>
<h4 style="padding:0px; margin: 0 0 8px 0;">Menu Management Introduction</h4>
<p style="padding: 2px 0px; margin:0; font-size:11px;">To add menus to your template you simply follow these basic rules for inclusion.</p> 
<p style="padding: 2px 0px; margin:0; font-size:11px;">Before you begin, please keep in mind that although we have tested themes with a few dozen different menus to guage performance, it may become an issue for you to manage more than a select few. It would also be a good idea to name your menus for their intended function as opposed to <strong>"menu 1"</strong> or <strong>"my menu"</strong> etc.  Ideally naming menus as <strong>"Top Navigation"</strong> or <strong>"Main Menu"</strong> is the best policy and will save you time in managing them.</p>
<p style="padding: 2px 0px; margin:0; font-size:11px;">Once you create your menu, you want to take the <strong>menu ID</strong> which is displayed in the list to the left and add it to a template tag as follows;   <strong>&lt;?php displayMenu(1, 2); ?&gt;</strong> so if your menu ID is #1 and you have only two levels you would <strong>1 for the ID and 2 for the levels.</strong> This would produce the kind of results for making a cascading menu. You can however exclude the number of levels if your menu is a single group of unordered list itmes as follows; <strong>&lt;?php displayMenu(1); ?&gt;</strong></p>
<p style="padding: 2px 0px; margin:0; font-size:11px;"><a href="http://www.ultimateidx.com/menu-manager/" title="WordPress Menu Creator Instructions" target="_blank">Click here for an entire list of code snippets and instructions.</a></p>        
        </div>
        
        <div>
        <h4 style="padding:0px; margin: 0 0 8px 0;">Current Inventory of Videos</h4>
        <p>You can <a href="http://www.ultimateidx.com/menu-manager/" title="WordPress Menu Creator Instructions" target="_blank">visit the tutorials</a> to learn how to create truly powerful navigation for your blog.</p>
        <ol>
        <li>Getting Started (All the basics)</li>
        <li>Types of menus possible (Examination of menu types)</li>
        <li>Adding menus to your theme and configuring the display</li>
        <li>Converting your existing theme menu to work with this plugin</li>
        <li>CSS styling the menus, how to make them look and behave correctly.</li>
        <li>Using the REL option for NoFollow Links and open links in an External Window</li>
        <li>More...</li>
        </ol>
        </div>
        
        <div>
<div id='rss'>
<strong>Recent Updated Code Examples</strong><br />
<?php getRSSData(5, 'http://www.ultimateidx.com/blog/category/wp-menu-creator/feed/');?>
</div>        
        </div>
    </div>
</div>
</div>

<small>Menu Creator Copyright&copy; 2008 - 2009 UltimateIDX - All Rights Reserved</small>
</td>
</tr>
</table>


<!--
<div style="height: 5px;"></div>
<a name="newroom"></a>
<h2>Add New Menu</h2>
<div style="width:450px">
<form name="editmenu" id="editmenu" method="post" action="?page=mc-edit-menu" onsubmit="return validate(this)">
<input type="hidden" name="action" value="createmenu" />
<table class="form-table" width="400">
<tr class="form-field form-required">
<th width="103" valign="top" scope="row"><label for="menutitle">Menu Title</label></th>
<td width="285"><input name="menutitle" id="menutitle" type="text" size="40" /></td>
</tr>
</table>
<p class="submit"><input type="submit" class="button" name="submit" value="Create Menu" /></p>
</form>
</div>
-->

</div>
</div><!-- wpbody -->
</div><!-- wpcontent -->
</div>