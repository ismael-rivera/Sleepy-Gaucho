<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?php include "functions/main.php";
$main= new main;
 ?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Untitled Document</title>
<style type="text/css">
.shadowout {
	-moz-box-shadow: 3px 3px 8px #ccc;
	-webkit-box-shadow: 3px 3px 8px #ccc;
	box-shadow: 3px 3px 8px #ccc;
	/* For IE 8 */
	-ms-filter: "progid:DXImageTransform.Microsoft.Shadow(Strength=4, Direction=135, Color='#000000')";
	/* For IE 5.5 - 7 */
	filter: progid:DXImageTransform.Microsoft.Shadow(Strength=4, Direction=135, Color='#000000');
}
table {
	border: 1px solid #8CB7BD;	
	}
td {
	text-align: center;
}
thead tr th {
	border-bottom-width: 1px;
	border-bottom-style: solid;
	border-bottom-color: #066;
	background-color: #92CCCC;
	}
tbody tr td {
	border-bottom-width: 1px;
	border-bottom-style: solid;
	border-bottom-color: #9ED7D9;
	}
</style>
</head>

<body>



<!-- Table markup-->

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
        </tbody>
			
				<?php			
				
$main->dbconnect();
$sql="SELECT * FROM lot_prices";
$result= mysql_query($sql) or die('Query failed:' . mysql_error());
if ($result) {
	while ($row = mysql_fetch_array($result, MYSQLI_ASSOC)){
		echo ("<tr><td>{$row['id']}</td>
			  <td>{$row['price']}</td></tr>");
				}
	}

?>	
			
			
		</tbody>

</table>

</body>
</html>