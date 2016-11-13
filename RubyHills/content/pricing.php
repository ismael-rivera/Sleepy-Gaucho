<table width="456" cellpadding="5" cellspacing="0" class="shadowout">

	<!-- Table header -->

		<thead>
			<tr>
				<th width="58" id="..." scope="col">Lot#</th>
                <th width="58" id="..." scope="col">Price</th>
			</tr>
            
		</thead>

	<!-- Table body -->

		<tbody>
			
				<?php
$config->dbconnect();
$sql="SELECT * FROM lot_prices";
$result= mysql_query($sql) or die('Query failed:' . mysql_error());
if ($result) {
	while ($row = mysql_fetch_array($result, MYSQLI_ASSOC)){
		echo "<tr><td>{$row['id']}</td>
			  <td>{$row['price']}</td></tr>";
				}
	}
?>	
			
			
		</tbody>

</table>