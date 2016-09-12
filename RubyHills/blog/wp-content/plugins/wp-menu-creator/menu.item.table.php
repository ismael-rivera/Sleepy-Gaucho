<?php
// Copyright: Copyright(c) 2008 - 2009 The UltimateIDX - All Rights Reserved
// Publisher: The UltimateIDX - Real Estate WordPress Solutions
// Plugin URL: http://www.ultimateidx.com/menu-creator/
// Version: 1.1.6 for WordPress 2.8+
// Support: http://www.ultimateidx.com/
// Support Contact: Jared Ritchey
?>
<style type="text/css">
#msg {display:none; position:absolute; z-index:200; background:url(../wp-content/plugins/wp-menu-creator/images/msg_arrow.gif) left center no-repeat; padding-left:7px}
#msgcontent {display:block; background:#f3e6e6; border:2px solid #924949; border-left:none; padding:5px; min-width:150px; max-width:250px}
</style>
<script type="text/javascript" src="../wp-content/plugins/wp-menu-creator/messages.js"></script>
<table class="form-table" style="width: 500px;">
<tr class="form-field form-required">
<th scope="row" valign="top"><label for="name">Title:</label></th>
<td><input name="title" id="title" type="text" value="<?php echo $mi->title;?>" size="40" /></td>
</tr>

<tr class="form-field form-required">
<th scope="row" valign="top"><label for="name">Type:</label></th>
<td>
<select name="type" id="type">
<option <?php echo ($mi->type=="external" ? "SELECTED" : ""); ?> value="external">External Link</option>
<option <?php echo ($mi->type=="wordpress" ? "SELECTED" : ""); ?> value="wordpress">Page or Post</option>
</select>
</td>
</tr>

<tr class="form-field form-required">
<th scope="row" valign="top"><label for="name">Value:</label></th>
<td>
<input name="value" id="value" type="text" value="<?php echo $mi->value;?>" size="40" />
<p style="padding: 2px 0px; margin:0; font-size:11px;">If you've selected an External Link item then this box should contain the full url (including http://) of the path you wish to link to, if you've selected a "Page or Post" item then supply the <b>Post or Page ID number</b> of the location you want to link to. The menu link can also include <strong>javascript: void(0);</strong> if you are creating a parent item with no link target. Please see documentation for more details. <a href="http://www.ultimateidx.com/menu-creator/" title="Menu Manager Documentation" target="_blank">DOCUMENTATION</a></p>			   
</td>
</tr>

<tr class="form-field">
<th scope="row" valign="top"><label for="name">REL Options:</label></th>
<td>
<select name="target" id="target">
<option value=""></option>
<option value="external">Target External Window</option>
<option value="nofollow">No Follow</option>
<option value="external nofollow">External + No Follow</option>
</select>
</td>
</tr>

<tr class="form-field">
<th scope="row" valign="top"><label for="name">Alt Text:</label></th>
<td><input name="alttext" id="alttext" type="text" value="<?php echo $mi->alttext;?>" size="10" /></td>
</tr>

<tr class="form-field">
<th scope="row" valign="top"><label for="name">Order:</label></th>
<td><input name="order" id="order" type="text" value="<?php echo $mi->order;?>" size="10" /></td>
</tr>

<tr class="form-field">
<th scope="row" valign="top"><label for="name">Parent:</label></th>
<td><input name="parent" id="parent" type="text" value="<?php echo $mi->parent;?>" size="10" /></td>
</tr>
</table>