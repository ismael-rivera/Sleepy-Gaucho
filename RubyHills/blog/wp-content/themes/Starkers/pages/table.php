<?php
if ( ! isset($wpdb) ) {
    $wpdb = new wpdb(DB_USER, DB_PASSWORD, DB_NAME, DB_HOST);
}
?>

<table class="prices" cellspacing="0" cellpadding="5" width="750">
<thead>
<tr>
<th id="..." width="58" scope="col">Lot#</th>
<th id="..." width="58" scope="col">Location</th>
<th id="..." width="58" scope="col">Description</th>
<th id="..." width="58" scope="col">Price</th>
</tr>
</thead>
<tbody>
<?php
/*$sql="SELECT * FROM wp_lot_prices_table";*/

global $wpdb;
$res = $wpdb->get_results( "SELECT * FROM wp_lot_prices_table" );
/*$result = $wpdb->query($sql) or die('Query failed:' . mysql_error());*/
$tot = $wpdb->num_rows;
?>
<h3> Pricing</h3><br/>
<?php
foreach ($res as $row) {
    echo "
<tr>
<td>" . $row->id . "</td>
<td>" . $row->location . "</td>
<td>" . $row->description . "</td>
<td>" . "$" . $row->price . "</td>
</tr>";

}
 ?>

</tbody>
</table>
